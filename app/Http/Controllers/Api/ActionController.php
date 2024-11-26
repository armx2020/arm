<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function get(Request $request)
    {
        $input = $request->all();

        if (!empty($input['query'])) {
            $data = Action::where("name", "LIKE", "%{$input['query']}%")->get();
        } else {
            $data = Action::get();
        }

        $actions = [];

        if (count($data) > 0) {
            foreach ($data as $action) {
                $actions[] = array(
                    "id" => $action->id,
                    "text" => $action->name,
                );
            }
        }
        return response()->json($actions);
    }
}