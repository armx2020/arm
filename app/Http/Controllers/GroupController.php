<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Group;

class GroupController extends Controller
{
    public function index(Request $request)
    {   
        $city = City::where('InEnglish', '=', $request->session()->get('city'))->First();
      
        $cityName = null;

        if ($city !== null) {
            $cityName = $city->name;
        }  

        return view('pages.group.groups', ['city' => $cityName]);
    }

    public function show(Request $request, $id)
    {
        $city = City::where('InEnglish', '=', $request->session()->get('city'))->First();

        if (empty($city)) {
            $cityName = City::find(1);
        } else {
            $cityName = $city->name;
        } 

        $group = Group::with('events', 'projects', 'vacancies')->findOrFail($id);

            $sum =  ($group->address ? 10 : 0) +
                    ($group->description ? 10 : 0) +
                    ($group->image ? 10 : 0) +
                    ($group->phone ? 5 : 0) +
                    ($group->web ? 5 : 0) +
                    ($group->viber ? 5 : 0) +
                    ($group->whatsapp ? 5 : 0) +
                    ($group->instagram ? 5 : 0) +
                    ($group->vkontakte ? 5 : 0) +
                    ($group->telegram ? 5 : 0);

            $fullness = (round(($sum / 65)*100));
            
        return view('pages.group.group', ['city' => $cityName, 'group' => $group, 'fullness' => $fullness]);
    }
}
