<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    //
    public function fetchWebhookDetails()
    {
        $client = new Client();
        $response = $client->get('https://webhook.site/bea79782-df41-4c2c-8473-1b35ef11ba63');

        $contents = $response->getBody()->getContents();

        // Process the contents as needed
        // ...

        return response()->json(['contents' => $contents]);
    }
}
