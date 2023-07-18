<?php

namespace App\Http\Controllers;

use App\Models\Offence;
use App\Models\Offencelist;
use App\Models\Receipt;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\STKPush;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
class PaymentController extends Controller
{
   
    public function create(Request $request, $ticketid)
    {
        $offence = Offence::where('TicketId', $ticketid)->with('offencelist')->first();
        
        if (!$offence) {
            abort(404);
        }
    
        $offencefine = $offence->offencelist->offencefine;
        $driver = Auth::user();
        $phoneNumber = $driver->phonenumber;
    
        return view('payment.create', compact('ticketid', 'phoneNumber', 'offencefine'));
    }
    
    public function processPayment(Request $request)
    {
        // Get the payment details from the request
        $amount = $request->input('amount');
        $phone = $request->input('phone');
        $shortcode = '174379'; // Replace with your shortcode
        $consumerKey = 'ZBFA2YdYj62BzHkwuBYGRHCDxGOXzLPS'; // Replace with your consumer key
        $consumerSecret = 'xvdd7ZFtamOx7jDe'; // Replace with your consumer secret
        $passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919'; // Replace with your Daraja passkey
    
        // Generate a unique transaction ID
        $transactionId = uniqid();
    
        // Calculate the Lipa Na M-Pesa online passkey
        $timestamp = date('YmdHis');
        $passkeyEncoded = base64_encode($shortcode . $passkey . $timestamp);
    
        // Make an API request to Daraja 2.0
        $endpointUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest'; // Replace with the actual Daraja API endpoint
    
        $client = new Client();
        $response = $client->post($endpointUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->generateAccessToken($consumerKey, $consumerSecret),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'BusinessShortCode' => $shortcode,
                'Password' => $passkeyEncoded,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $phone,
                'PartyB' => $shortcode,
                'PhoneNumber' => $phone,
                'CallBackURL' => route('payment.callback'),
                'AccountReference' => $transactionId,
                'TransactionDesc' => 'Payment for Order ' . $transactionId,
            ],
        ]);
    
        // Process the API response
        $statusCode = $response->getStatusCode();
        $responseData = $response->getBody()->getContents();
    
        // Handle the API response based on the status code and response data
        if ($statusCode === 200) {
            // Payment request successful
            // Store the STK Push details in your database
            $stkPush = new STKPush();
            $stkPush->transaction_id = $transactionId;
            $stkPush->amount = $amount;
            $stkPush->phone = $phone;
            $stkPush->TicketId = $request->input('ticketId'); // Add the ticket ID
            $stkPush->save();
    
            // Store the transaction details in your database
            $transaction = new Transaction();
            $transaction->transaction_id = $transactionId;
            $transaction->amount = $amount;
            $transaction->status = 'pending'; // Set an initial status
            $transaction->TicketId = $request->input('ticketId'); // Add the ticket ID
            $transaction->save();
            $ticketId = $request->input('ticketId');
            $offence = Offence::where('TicketId', $ticketId)->with('offencelist')->first();
            $OffenceCommited =$offence->OffenceCommited;
            $InspectorBadgeNumber = $offence->InspectorBadgeNumber;
        
    
            // Save the receipt information to the "receipts" table
            $receipt = new Receipt();
            $receipt->receipt_number = 'ETCK-' . uniqid();
            $receipt->transaction_id = $transactionId;
            $receipt->payment_date = now();
            $receipt->amount = $amount;
            $receipt->ticket_id = $request->input('ticketId'); // Add the ticket ID
            $receipt->driver_name = Auth::user()->name;
            $receipt->driver_phone_number = Auth::user()->phonenumber;
            $receipt->driver_email = Auth::user()->email;
            $receipt->driver_id_number = Auth::user()->idnumber;
            $receipt->driver_licence_number = Auth::user()->licencenumber;
            $receipt->OffenceCommited=$OffenceCommited;
            $receipt->InspectorBadgeNumber=$InspectorBadgeNumber;
            // Add any other receipt details you want to save
            $receipt->save();
    
            return redirect()->route('payment.success', $request->input('ticketId'));
        } else {
            // Payment request failed
            // Handle the failure scenario
            return redirect()->route('payment.failure');
        }
    }
    
    private function generateAccessToken($consumerKey, $consumerSecret)
    {
        $credentials = base64_encode($consumerKey . ':' . $consumerSecret);
        $endpointUrl = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'; // Replace with the actual Daraja OAuth endpoint

        $client = new Client();
        $response = $client->get($endpointUrl, [
            'headers' => [
                'Authorization' => 'Basic ' . $credentials,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);

        $statusCode = $response->getStatusCode();
        $responseData = json_decode($response->getBody()->getContents(), true);

        if ($statusCode === 200 && isset($responseData['access_token'])) {
            return $responseData['access_token'];
        } else {        
            // Handle the error scenario
            return null;
        }
    }


public function callback(Request $request)
{
    // Verify the authenticity of the request (optional but recommended)

    // Retrieve the transaction details from the request
    $transactionId = $request->input('Body.stkCallback.CheckoutRequestID');
    $resultCode = $request->input('Body.stkCallback.ResultCode');
    $resultDesc = $request->input('Body.stkCallback.ResultDesc');

    // Find the transaction record based on the transaction ID
    $transaction = Transaction::where('transaction_id', $transactionId)->first();

    if ($transaction) {
        // Update the transaction status based on the result code
        if ($resultCode == 0) {
            $transaction->status = 'paid';
        } else {
            $transaction->status = 'cancelled';
        }

        // Update any other relevant transaction details
        // ...

        $transaction->save();

        // Perform additional actions based on the payment status
        if ($resultCode == 0) {
            // Payment success
            // ...
        } else {
            // Payment failure or cancellation
            // ...
        }
    }

    // Return an appropriate response (Safaricom expects an HTTP 200 response)
    return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Success']);
}


public function showPaymentSuccess(Request $request, $ticketId)
{
    // Retrieve the payment and driver details from the database
    $payment = Transaction::where('TicketId', $ticketId)->first();
    $receipt = Receipt::where('ticket_id', $ticketId)->first();
    $driver = Auth::user();
    $offence = Offence::where('TicketId', $ticketId)->with('offencelist')->first();
    $OffenceCommited =$offence->OffenceCommited;
    $InspectorBadgeNumber = $offence->InspectorBadgeNumber;


    // Check if the payment and driver exist
    if (!$payment || !$driver) {
        abort(404);
    }

    // Pass the payment and driver details to the view
    return view('payment.success', [
        'transactionId' => $payment->transaction_id,
        'paymentDate' => $payment->created_at,
        'amount' => $payment->amount,
        'ticketId' => $payment->TicketId,
        'driverName' => $driver->name,
        'driverPhoneNumber' => $driver->phonenumber,
        'driverEmail' => $driver->email,
        'driverIdNumber' => $driver->idnumber,
        'driverLicenceNumber' => $driver->licencenumber,
        'receiptNumber'=>$receipt->receipt_number,
        'OffenceCommited'=>$OffenceCommited,
        'InspectorBadgeNumber'=>$InspectorBadgeNumber,
    ]);

}
public function downloadReceipt($ticketId)
{
    $receipt = Receipt::where('ticket_id', $ticketId)->first();
    $driver = Auth::user();

    // Check if the receipt and driver exist
    if (!$receipt || !$driver) {
        abort(404);
    }

    // Generate the HTML for the receipt using your view template
    $receiptHtml = view('payment.success', [
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

    // Save the PDF file to a temporary location
    $pdfFilePath = public_path('tmp\\' . $filename);
    file_put_contents($pdfFilePath, $dompdf->output());

    // Create a BinaryFileResponse to send the PDF for download
    $response = new BinaryFileResponse($pdfFilePath);

    // Set appropriate headers for download
    $response->headers->set('Content-Type', 'application/pdf');
    $response->setContentDisposition(
        ResponseHeaderBag::DISPOSITION_ATTACHMENT,
        $filename
    );

    // Return the BinaryFileResponse for download
    return $response;

}
}





