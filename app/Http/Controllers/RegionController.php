<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function getRegions(Request $request)
    {
        $input = $request->all();
       
        if (!empty($input['query'])) {
            $data = Region::where("name", "LIKE", "%{$input['query']}%")->get();
        } else {
            $data = Region::get();
        }

        $regions = [];

        if (count($data) > 0) {
            foreach ($data as $region) {
                $regions[] = array(
                    "id" => $region->id,
                    "text" => $region->name,
                );
            }
        }
        return response()->json($regions);
    }
}
