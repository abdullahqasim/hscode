<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HSCode;
use GuzzleHttp\Client;
use App\Models\Chapter;

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
        echo "hi";
        $hscode = HSCode::whereNull('flag')->first();

        // Make sure you've got the Page model
        if($hscode) {
            $hscode->flag = 1;
            $hscode->save();
        }

        try {
            $client = new Client(['base_uri' => config('app.api.commodities')]);
            $response = $client->request('GET', $hscode->hscode_id, [
                'headers' => array(
                    'User-Agent' => 'product / product-version'
                )
            ]);

            if ($response->getStatusCode() === 200) {
                $d = json_decode($response->getBody(), true);
                print_r( $d['included'] );
                $d = $d['included'];
                $NewHSCode = new Chapter();
                $NewHSCode->hs_codes_id = $d['id'];
                $NewHSCode->data_id = $hscode->id;
                $NewHSCode->numeral = $d['numeral'];
                $NewHSCode->title = $d['title'];
                $NewHSCode->chapter_id = $d['attributes']['chapter_id'];
                $NewHSCode->type = $d['type'];
                $NewHSCode->goods_nomenclature_item_id = $d['attributes']['goods_nomenclature_item_id'];
                $NewHSCode->producline_suffix = $d['attributes']['producline_suffix'];
                $NewHSCode->formatted_description = $d['attributes']['formatted_description'];
                $NewHSCode->description = $d['attributes']['description'];
                $NewHSCode->description_indexed = $d['attributes']['description_indexed'];
                $NewHSCode->search_references = $d['attributes']['search_references'];
                $NewHSCode->validity_start_date = $d['attributes']['validity_start_date'];
                $NewHSCode->declarable = $d['attributes']['declarable'];
                $NewHSCode->save();
                return response()->json($data['included']);
                
            } else {
                return response()->json(['error' => 'Unexpected response from the API'], $response->getStatusCode());
            }
        } catch (RequestException $e) {
            return response()->json(['error' => 'API request failed: ' . $e->getMessage()], 500);
        }

        // echo $hscode;
        // print_r($hscode);
    }
}
