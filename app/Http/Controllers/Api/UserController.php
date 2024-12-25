<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get(Request $request)
    {
        $input = $request->all();
        $morePages = false;

        if (!empty($input['query'])) {
            $data = User::where("firstname", "LIKE", "%{$input['query']}%")->get();
        } else {
            $data = User::orderBy('firstname')->simplePaginate(10);

            $pagination_obj = json_encode($data);

            if ($data->nextPageUrl() !== null) {
                $morePages = true;
            }
        }

        $users['results'] = [];
        if (count($data) > 0) {
            foreach ($data as $user) {
                $users['results'][] = array(
                    "id" => $user->id,
                    "text" => $user->firstname,
                );
            }
        }

        $users['pagination'] = array(
            "more" => $morePages
        );

        return response()->json($users);
    }
}