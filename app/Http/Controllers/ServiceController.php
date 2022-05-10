<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\Stripe;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['only'=>['create','store','paymentsHistory','invoices','invoice']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->with('user')->get();
        return view('service.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
        ]);
        $authed_user= auth()->user();
        $amount = 1000;
        if($request->filled('premium')) $amount += 500;
        if($request->filled('premium')) $premuim = "premuim";
        try {
            $authed_user->createOrGetStripeCustomer();
            $authed_user->charge(
                $amount, $request->payment_method
            );
            
            $authed_user->services()->create([
                'title'=>$request->title,
                'slug'=>Str::slug($request->title),
                'content'=>$request->title,
                'premium'=>$request->filled('premium'),
            ]);

            $authed_user->invoicePrice($request->title, 1);
            return redirect()->route('service.index')->with('success','Item created successfully!');
        } catch (Exception $exception) {
            $message = $exception->getMessage();
            return back()->with('failed',$message);
        }
    }

    public function invoices()
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $user = auth()->user();
        
            $invoices = $user->invoices();
            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
              );
            $payments = $stripe->balanceTransactions->all();
            
            return view('service.invoices', compact('invoices'));

        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }

    public function invoice($invoice_id)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $user = auth()->user();

            return $user->downloadInvoice($invoice_id, [
                'vendor'  => 'Your Company',
                'product' => 'Your Product',
            ]);

        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }

    public function paymentsHistory()
    {
        try {
            $user = auth()->user();
            // $stripe = new \Stripe\StripeClient(
            //     env('STRIPE_SECRET')
            // );
            // $payments = $stripe->balanceTransactions->all();

            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
            $payments =  $stripe->paymentIntents->all(['customer' => $user->stripe_id]);
            dd($payments);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
