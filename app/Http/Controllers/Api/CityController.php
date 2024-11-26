<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function get(Request $request)
    {
        $input = $request->all();

        if (!empty($input['query'])) {
            $data = City::where("name", "LIKE", "%{$input['query']}%")->get();
        } else {
            $data = City::get();
        }

        $cities = [];

        if (count($data) > 0) {
            foreach ($data as $city) {
                $cities[] = array(
                    "id" => $city->id,
                    "text" => $city->name,
                );
            }
        }
        return response()->json($cities);
    }
}