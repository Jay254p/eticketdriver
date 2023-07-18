<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Safaricom\Mpesa\Mpesa;

class MpesaController extends Controller
{
    //
    public function generateToken()
    {
        $mpesa = new Mpesa();

        try {
            $response = $mpesa->generateToken();
            $access_token = $response['access_token'];
            return $access_token;
        } catch (\Exception $e) {
            Log::error('M-Pesa token generation failed: ' . $e->getMessage());
            // Handle error gracefully
        }
    }

    public function stkPush(Request $request)
    {
        $mpesa = new Mpesa();

        $amount = $request->input('amount');
        $phone_number = $request->input('phone_number');
        $callback_url = route('mpesa.callback'); // Replace with your callback URL

        try {
            $response = $mpesa->stkPush($amount, $phone_number, 'Online Payment', $callback_url);
            // Process the response as needed
        } catch (\Exception $e) {
            Log::error('M-Pesa STK push failed: ' . $e->getMessage());
            // Handle error gracefully
        }
    }

    public function callback(Request $request)
    {
        // Process the M-Pesa callback here
    }


}
