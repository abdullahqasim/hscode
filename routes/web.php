<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('fetch-hscode', [\App\Http\Controllers\HSCodeController::class, 'fetchHSCode'])->name('fetch-hscode');

Route::get('/', function () {

    $client = new Client();
//    dd(urlencode('	Paintings, drawing and pastels'));

    try {
//        $response = $client->request('GET', 'https://www.trade-tariff.service.gov.uk/uk/api/beta/search?q=Live+horses%2C+asses%2C+mules+and+hinnies', [
        $response = $client->request('GET', 'https://www.trade-tariff.service.gov.uk/uk/api/beta/search?q=Paintings%2C+drawing+and+pastels', [
            'headers' => [
                'User-Agent' => 'product / product-version'
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        foreach($data['included'] as $d){
            dump($d);
        }
        dd($data['included'][0]);
        return response()->json($data);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }

    $response = Http::get('https://www.trade-tariff.service.gov.uk/api/v2/sections');
    $response = Http::get('https://www.trade-tariff.service.gov.uk/api/v2/commodities/9701910000');
    $jsonData = $response->json();
    return $jsonData;
//    return view('welcome');
});
