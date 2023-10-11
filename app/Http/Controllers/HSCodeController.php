<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class HSCodeController extends Controller
{
    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function fetchHSCode(Request $request)
    {
        $searchQuery = urldecode($request->keywords);
//        dd($searchQuery);

        try {
            $response = $this->httpClient->request('GET', config('app.api.commodities'), [
                'query' => $searchQuery,
//                'query' => ['q' => $searchQuery],
                'headers' => array(
                    'User-Agent' => 'product / product-version'
                )
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                return response()->json($data['included']);
            } else {
                return response()->json(['error' => 'Unexpected response from the API'], $response->getStatusCode());
            }
        } catch (RequestException $e) {
            return response()->json(['error' => 'API request failed: ' . $e->getMessage()], 500);
        }
    }
}
