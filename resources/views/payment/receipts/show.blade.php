<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">


<div class="bg-white border rounded-lg shadow-lg px-6 py-8 max-w-md mx-auto mt-8">
    <h1 class="font-bold text-2xl my-4 text-center text-blue-600">E-Ticket</h1>
    <hr class="mb-2">
    <div class="flex justify-between mb-6">
        <h1 class="text-lg font-bold">Payment Receipt</h1>
        <div class="text-gray-700">
            <div>Date Paid: {{$paymentDate}}</div>
            <div>Invoice #: {{$receiptNumber}}</div>
            <div>Ticket ID: {{ $ticketId }}</div>
        </div>
    </div>
    <div class="mb-8">
        <h2 class="text-lg font-bold mb-4">Driver Details:</h2>
        <div class="text-gray-700 mb-2">{{ $driverName}}</div>
        <div class="text-gray-700 mb-2">{{ $driverPhoneNumber }}.</div>
        <div class="text-gray-700 mb-2">{{ $driverIdNumber }}</div>
        <div class="text-gray-700">{{ $driverLicenceNumber }}</div>
    </div>
    <table class="w-full mb-8">
        <thead>
            <tr>
                <th class="text-left font-bold text-gray-700">Description</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-left text-gray-700">Transaction ID</td>
                <td class="text-right text-gray-700">{{ $transactionId }}</td>
            </tr>
            <tr>
                <td class="text-left text-gray-700">Offence Committed</td>
                <td class="text-right text-gray-700">{{$OffenceCommited}}</td>
            </tr>
            <tr>
                <td class="text-left text-gray-700">Amount Paid</td>
                <td class="text-right text-gray-700">{{ $amount }}</td>
            </tr>
            <tr>
                <td class="text-left text-gray-700">Issued By:</td>
                <td class="text-right text-gray-700">{{$InspectorBadgeNumber }}</td>
            </tr>
        </tbody>
        {{-- <tfoot>
            <tr>
                <td class="text-left font-bold text-gray-700">Total</td>
                <td class="text-right font-bold text-gray-700">$225.00</td>
            </tr>
        </tfoot> --}}
    </table>
    <div class="text-gray-700 mb-2">Thank you for being honest!</div>
    <div class="text-gray-700 text-sm">Say No To Corruption.</div>
</div>

<div class="text-center mt-8">
    {{-- <a href="{{ route('receipt.download', $ticketId) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Download Receipt
    </a> --}}
    {{-- <a href="/receipts/{{ $ticketId }}/download">Download Receipt</a> --}}
    <style>
        .download-link {
            display: inline-block;
            background-color: #4a86e8;
            color: #ffffff;
            font-weight: bold;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
    
        .download-link:hover {
            background-color: #357bd8;
        }
    </style>
    
    <a href="/receipts/{{ $ticketId }}/download" class="download-link">Download Receipt</a>
    
</div>
</x-app-layout>