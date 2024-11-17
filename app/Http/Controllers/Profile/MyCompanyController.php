<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CompanyRequest;
use App\Models\City;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CompanyService;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class MyCompanyController extends BaseController
{
    public function __construct(private CompanyService $companyService)
    {
        parent::__construct();
        $this->companyService = $companyService;
    }


    public function index(Request $request)
    {
        $companies = Auth::user()->companies;

        return view('profile.pages.company.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'companies' => $companies,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function create(Request $request)
    {
        return view('profile.pages.company.create', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function store(CompanyRequest $request)
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
            'image' => ['image'],
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
            Image::make('storage/' . $company->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $company->save();

        return redirect()->route('mycompanies.index')->with('success', 'Компания "' . $company->name . '" добавлена');
    }

    public function show(Request $request, $id)
    {
        $company = Company::where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($company)) {
            return redirect()->route('mycompanies.index')->with('alert', 'Компания не найдена');
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
            ($company->telegram ? 5 : 0) +
            ($company->name ? 5 : 0);

        $fullness = (round(($sum / 70) * 100));

        return view('profile.pages.company.show', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'company' => $company,
            'fullness' => $fullness,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function edit(Request $request, $id)
    {
        $company = Company::where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($company)) {
            return redirect()->route('mycompanies.index')->with('alert', 'Компания не найдена');
        }

        return view('profile.pages.company.edit', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'company' => $company,
            'regionCode' => $request->session()->get('regionId')
        ]);
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
            'image' => ['image'],
        ]);

        $city = City::with('region')->find($request->company_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $company = Company::where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($company)) {
            return redirect()->route('mycompanies.index')->with('alert', 'Компания не найдена');
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


        if ($request->image_r == 'delete') {
            Storage::delete('public/' . $company->image);
            $company->image = null;
        }

        if ($request->image) {
            Storage::delete('public/' . $company->image);
            $company->image = $request->file('image')->store('companies', 'public');
            Image::make('storage/' . $company->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $company->update();

        return redirect()->route('mycompanies.show', ['mycompany' => $company->id])->with('success', 'Компания "' . $company->name . '" обнавлена');
    }

    public function destroy($id)
    {
        $company = Company::with('events', 'projects', 'vacancies', 'news', 'offers')->where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($company)) {
            return redirect()->route('mycompanies.index')->with('alert', 'Компания не найдена');
        }

        if (count($company->offers) > 0) {
            return redirect()->route('mycompanies.index')->with('alert', 'У компании есть товары, необходимо удалить сначало их');
        }

        foreach ($company->events as $event) {
            if ($event->image) {
                Storage::delete('public/' . $event->image);
            }
            $event->delete();
        }

        foreach ($company->news as $news) {
            if ($news->image) {
                Storage::delete('public/' . $news->image);
            }
            $news->delete();
        }

        foreach ($company->projects as $project) {
            if ($project->image !== null) {
                Storage::delete('public/' . $project->image);
            }
           $project->delete();
        }

        foreach ($company->vacancies as $vacancy) {
            $vacancy->delete();
        }

        if ($company->image !== null) {
            Storage::delete('public/' . $company->image);
        }

        $company->delete();

        return redirect()->route('mycompanies.index')->with('success', 'Компания удалена');
    }
}
