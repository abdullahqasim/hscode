<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;

class HSCodeController extends Controller
{
    public function fetchHSCode(Request $request)
    {
        $results = Chapter::where(function ($query)use($request) {
            $query->where('formatted_description', 'LIKE', '%'.$request->keywords.'%')
                ->orWhere('description', 'LIKE', '%'.$request->keywords.'%');
        })->pluck('goods_nomenclature_item_id')->toArray();

        $uniqueResults = array_unique($results);

        if (empty($uniqueResults)) {
            $response = [
                'success' => false,
                'message' => 'No results found for keyword ' .$request->keywords,
                'data' => [],
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Search results for keyword '.$request->keywords,
                'data' => $uniqueResults,
            ];
        }

        return response()->json($response, 200);
    }
}
