<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function guzzleapi()
    {
        $base_url = 'https://shopify.rewardssandbox.zithara.com/api/v2';
        $api_endpoint = '/customer/pointsLedger';

        $headers = [
            'Authorization' => 'MHBRaFBxT0RhbHlabTkvMFdYdXJvdz09',
            'Key' => 'bthzca6di5',
            'Content-Type' => 'application/json', // Set the Content-Type header
        ];

        $data = [
            'customer_id' => '123',
            'customerPhone' => '8688859854',
            'customerEmail' => 'info@zithara.in',
        ];

        $response = Http::withHeaders($headers)
            ->post($base_url . $api_endpoint, $data);

        $statusCode = $response->status();
        $responseBody = $response->json();
        return $responseBody;
        if ($statusCode === 200) {
            // Handle success response
            return response()->json($responseBody);
        } elseif ($statusCode === 404) {
            // Handle Not Found error
            return response()->json(['Errorcode' => '404', 'message' => 'Customer Does Not Exist']);
        } elseif ($statusCode === 401) {
            // Handle Unauthorized error
            return response()->json(['Errorcode' => '401', 'message' => 'Unauthorized Access']);
        } elseif ($statusCode === 500) {
            // Handle Internal Server error
            return response()->json(['Errorcode' => '500', 'message' => 'Something went wrong']);
        } else { 
            // Handle other error responses
            return response()->json($responseBody, $statusCode);
        }
    }
   
    //PHP cURL
    public function curlapi()
    {
        $base_url = 'https://shopify.rewardssandbox.zithara.com/api/v2';
        $api_endpoint = '/customer/pointsLedger';

        $headers = [
            'Authorization: MHBRaFBxT0RhbHlabTkvMFdYdXJvdz09',
            'Key: bthzca6di5',
            'Content-Type: application/json', // Set the Content-Type header
        ];

        $data = [
            'customer_id' => '123',
            'customerPhone' => '8688859854',
            'customerEmail' => 'info@zithara.in',
        ];

        $ch = curl_init($base_url . $api_endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        
        $responseBody = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);
        
        if ($statusCode === 200) {
            // Handle success response
            return response()->json(json_decode($responseBody));
        } elseif ($statusCode === 404) {
            // Handle Not Found error
            return response()->json(['Errorcode' => '404', 'message' => 'Customer Does Not Exist']);
        } elseif ($statusCode === 401) {
            // Handle Unauthorized error
            return response()->json(['Errorcode' => '401', 'message' => 'Unauthorized Access']);
        } elseif ($statusCode === 500) {
            // Handle Internal Server error
            return response()->json(['Errorcode' => '500', 'message' => 'Something went wrong']);
        } else {
            // Handle other error responses
            return response()->json(json_decode($responseBody), $statusCode);
        }
    }

}