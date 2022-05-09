<x-app-layout>
    <div  class="container mx-auto flex justify-center mt-6 ">
        <table class="w-1/2" style="border: 2px solid black">
            <thead>
            <tr>
                <th style="border: 2px solid black">Date</th>
                <th style="border: 2px solid black">Amount</th>
                <th style="border: 2px solid black">Download</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td style="border: 2px solid black">{{ $invoice->date()->toFormattedDateString() }}</td>
                        <td style="border: 2px solid black">{{ $invoice->total() }}</td>
                        <td style="border: 2px solid black">
                            <a class="py-2 px-4 bg-pink-300 rounded-lg" href="/invoice/{{ $invoice->id }}">Download</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="text-center" style="border: 2px solid black">test gg</td>
                    <td class="text-center" style="border: 2px solid black">test gg</td>
                    <td class="text-center" style="border: 2px solid black">
                        <a class="py-2 px-4 bg-pink-300 rounded-lg" >Download</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>