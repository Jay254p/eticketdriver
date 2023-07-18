<?php

namespace App\Http\Controllers;

use App\Models\Offence;
use App\Models\Receipt;
use App\Models\Transaction;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;
class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    
        $user = Auth::user();
        $receipts = Receipt::where('driver_email', $user->email)->get();

        return view('payment.receipts.index', compact('receipts'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Receipt $receipt, $ticketId)
    {
        // Retrieve the payment, receipt, and driver details from the database or any other source
        $payment = Transaction::where('TicketId', $ticketId)->first();
        $receipt = Receipt::where('ticket_id', $ticketId)->first();
        $driver = Auth::user();
    
        // Check if the payment, receipt, and offence exist
       
    
        // Retrieve the necessary data from the offence
      
    
        return view('payment.receipts.show', [
            'transactionId' => $payment->transaction_id,
            'paymentDate' => $payment->created_at,
            'amount' => $payment->amount,
            'ticketId' => $payment->TicketId,
            'driverName' => $driver->name,
            'driverPhoneNumber' => $driver->phonenumber,
            'driverEmail' => $driver->email,
            'driverIdNumber' => $driver->idnumber,
            'driverLicenceNumber' => $driver->licencenumber,
            'receiptNumber' => $receipt->receipt_number,
            'OffenceCommited' => $receipt->OffenceCommited,
            'InspectorBadgeNumber' => $receipt->InspectorBadgeNumber,
        ]);

        
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function download($ticketId)
{
    $receipt = Receipt::where('ticket_id', $ticketId)->first();
    $driver = Auth::user();

    // Check if the receipt and driver exist
    if (!$receipt || !$driver) {
        abort(404);
    }

    // Generate the HTML for the receipt using your view template
    $receiptHtml = View::make('payment.receipts.show', [
        'transactionId' => $receipt->transaction_id,
        'paymentDate' => $receipt->payment_date,
        'amount' => $receipt->amount,
        'ticketId' => $receipt->ticket_id,
        'driverName' => $driver->name,
        'driverPhoneNumber' => $driver->phonenumber,
        'driverEmail' => $driver->email,
        'driverIdNumber' => $driver->idnumber,
        'driverLicenceNumber' => $driver->licencenumber,
        'receiptNumber' => $receipt->receipt_number,
        'OffenceCommited' => $receipt->OffenceCommited,
        'InspectorBadgeNumber' => $receipt->InspectorBadgeNumber,
    ])->render();

    // Initialize Dompdf
    $dompdf = new Dompdf();

    // Load HTML content
    $dompdf->loadHtml($receiptHtml);

    // (Optional) Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the PDF
    $dompdf->render();

    // Generate a random filename for the PDF
    $filename = 'receipt_' . uniqid() . '.pdf';

    // Get the output of the PDF
    $output = $dompdf->output();

    // Save the PDF file to the "public/receipts" directory
    $path = public_path('tmp/' . $filename);
    file_put_contents($path, $output);

    // Return the PDF file as a download response
    return response()->download($path, $filename);
}
}
