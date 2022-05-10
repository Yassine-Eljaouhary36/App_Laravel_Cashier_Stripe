<x-app-layout>
    <div  class="container mx-auto flex justify-center mt-6 ">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Download</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invoices as $invoice)
                <tr>
                    <th scope="row">{{$index}}</th>
                    <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                    <td>{{ $invoice->total() }}</td>
                    <td>
                        <a class="btn btn-primary" href="/invoice/{{ $invoice->id }}">Download</a>
                    </td>
                </tr>
                @empty
                <td colspan="5">
                    <div class="alert alert-primary" role="alert">
                        <strong>No Invoice Yet</strong>
                    </div>
                </td>
                @endforelse
            </tbody>
          </table>
    </div>
</x-app-layout>