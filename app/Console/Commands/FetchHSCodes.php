<?php

namespace App\Console\Commands;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use App\Models\HSCode;
use GuzzleHttp\Client;
use App\Models\Chapter;
use Illuminate\Support\Facades\Log;


class FetchHSCodes extends Command
{
    // public function __construct(){
    //     echo "abdullah boss";
    // }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:hscodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Keywords related to hs codes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hscode = HSCode::whereNull('flag')->first();
        if($hscode) {
            $hscode->flag = 1;
            $hscode->save();
        }

        try {
            Log::channel('console')->info('API Started. HS code = '.$hscode->hscode_id.' with ID = '.$hscode->id);
            $client = new Client(['base_uri' => config('app.api.commodities')]);
            $response = $client->request('GET', $hscode->hscode_id, [
                'headers' => array(
                    'User-Agent' => 'product / product-version'
                )
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                foreach ($data['included'] as $d ){
                    if(isset($d['attributes']['goods_nomenclature_item_id'])){
                        $NewHSCode = new Chapter();
                        $NewHSCode->hs_codes_id = $d['id'];
                        $NewHSCode->data_id = $hscode->id;
                        $NewHSCode->numeral = $d['attributes']['numeral']??null;
                        $NewHSCode->title = $d['attributes']['title']??null;
                        $NewHSCode->position = $d['attributes']['position']??null;
                        $NewHSCode->chapter_id = $d['attributes']['chapter_id']??null;
                        $NewHSCode->type = $d['type'];
                        $NewHSCode->goods_nomenclature_item_id = $d['attributes']['goods_nomenclature_item_id']??null;
                        $NewHSCode->producline_suffix = $d['attributes']['producline_suffix']??null;
                        $NewHSCode->formatted_description = $d['attributes']['formatted_description']??null;
                        $NewHSCode->description = $d['attributes']['description']??null;
                        $NewHSCode->description_indexed = $d['attributes']['description_indexed']??null;
                        $NewHSCode->search_references = $d['attributes']['search_references']??null;
                        $NewHSCode->validity_start_date = isset($d['attributes']['validity_start_date'])? date('Y-m-d H:i:s', strtotime($d['attributes']['validity_start_date'])): null;
                        $NewHSCode->declarable = $d['attributes']['declarable']??null;
                        $NewHSCode->save();
                    }
                }
                Log::channel('console')->info('API completed successfully.');
            } else {
                Log::channel('console')->error('API encountered an error: ' . $response->getStatusCode());
            }
        } catch (RequestException $e) {
            // Capture the response body for logging
//            $responseBody = $e->getResponse()->getBody()->getContents();

            // Log the response body
//            Log::channel('console')->error('Response: ' . $responseBody);
            Log::channel('console')->error('Record not found against HS Code '. $hscode->hscode_id);
            Log::channel('console')->error('Something went wrong: ' . $e->getMessage());
        }
    }
}
