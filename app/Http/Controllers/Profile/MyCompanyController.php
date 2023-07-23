<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyCompanyController extends Controller
{
    public function index(Request $request)
    {
        $city = City::where('InEnglish', '=', $request->session()->get('city'))->First();

        if (empty($city)) {
            $cityName = City::find(1);
        } else {
            $cityName = $city->name;
        }

        $companies = Auth::user()->companies;

        return view('profile.pages.company.index', ['city' => $cityName, 'companies' => $companies]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
            'phone' => ['max:36'],
            'web' => ['max:250'],
            'viber' => ['max:36'],
            'whatsapp' => ['max:36'],
            'telegram' => ['max:36'],
            'instagram' => ['max:36'],
            'vkontakte' => ['max:36'],
            'image' => ['image', 'max:2048'],
        ]);

        $city = City::with('region')->find($request->company_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $company = new Company();

        $company->name = $request->name;
        $company->address = $request->address;
        $company->description = $request->description;
        $company->city_id = $request->company_city;
        $company->region_id = $city->region->id;
        $company->phone = $request->phone;
        $company->web = $request->web;
        $company->viber = $request->viber;
        $company->whatsapp = $request->whatsapp;
        $company->telegram = $request->telegram;
        $company->instagram = $request->instagram;
        $company->vkontakte = $request->vkontakte;
        $company->user_id = Auth::user()->id;

        if ($request->image) {
            $company->image = $request->file('image')->store('companies', 'public');
        }

        $company->save();

        return redirect()->route('mycompany.index')->with('success', 'Компания "' .$company->name. '" добавлена');
    }

    public function show(Request $request, $id)
    {
        $city = City::where('InEnglish', '=', $request->session()->get('city'))->First();

        if (empty($city)) {
            $cityName = City::find(1);
        } else {
            $cityName = $city->name;
        }

        $company = Company::where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($company)) {
            return redirect()->route('mycompany.index')->with('alert', 'Группа не найдена');
        }

        $sum =  ($company->address ? 10 : 0) +
                    ($company->description ? 10 : 0) +
                    ($company->image ? 10 : 0) +
                    ($company->phone ? 5 : 0) +
                    ($company->web ? 5 : 0) +
                    ($company->viber ? 5 : 0) +
                    ($company->whatsapp ? 5 : 0) +
                    ($company->instagram ? 5 : 0) +
                    ($company->vkontakte ? 5 : 0) +
                    ($company->telegram ? 5 : 0);

        $fullness = (round(($sum / 65)*100));


        return view('profile.pages.company.show', ['city' => $cityName, 'company' => $company, 'fullness' => $fullness]);
    }

    public function edit(Request $request, $id)
    {
        $city = City::where('InEnglish', '=', $request->session()->get('city'))->First();

        if (empty($city)) {
            $cityName = City::find(1);
        } else {
            $cityName = $city->name;
        }
        $company = Company::where('user_id', '=', Auth::user()->id)->find($id);

        return view('profile.pages.company.edit', ['city' => $cityName, 'company' => $company]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
            'phone' => ['max:36'],
            'web' => ['max:250'],
            'viber' => ['max:36'],
            'whatsapp' => ['max:36'],
            'telegram' => ['max:36'],
            'instagram' => ['max:36'],
            'vkontakte' => ['max:36'],
            'image' => ['image', 'max:2048'],
        ]);

        $city = City::with('region')->find($request->company_city);

        if (empty($city)) {
            $city = City::find(1);
        }
        
        $company = Company::where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($company)) {
            return redirect()->route('mycompany.index')->with('alert', 'Группа не найдена');
        }

        $company->name = $request->name;
        $company->address = $request->address;
        $company->description = $request->description;
        $company->city_id = $request->company_city;
        $company->region_id = $city->region->id;
        $company->phone = $request->phone;
        $company->web = $request->web;
        $company->viber = $request->viber;
        $company->whatsapp = $request->whatsapp;
        $company->telegram = $request->telegram;
        $company->instagram = $request->instagram;
        $company->vkontakte = $request->vkontakte;
        $company->user_id = Auth::user()->id;

        if ($request->image) {
            Storage::delete('public/'.$company->image);
            $company->image = $request->file('image')->store('companies', 'public');
        }

        $company->update();

        return redirect()->route('mycompany.show', ['id' => $company->id])->with('success', 'Группа "' .$company->name. '" обнавлена');
    }

    public function destroy($id)
    {
        $company = Company::where('user_id', '=', Auth::user()->id)->find($id);

        if($company->image !== null) {
            Storage::delete('public/'.$company->image);
        }

        $company->delete();

        return redirect()->route('mycompany.index')->with('success', 'Группа удалена');
    }
}
