<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        return view('admin.company.index');
    }

    public function create()
    {
        $users = User::all();     
        return view('admin.company.create', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'phone' => ['string', 'max:36'],
            'web' => ['max:250'],
            'viber' => ['max:36'],
            'whatsapp' => ['max:36'],
            'telegram' => ['max:36'],
            'instagram' => ['max:36'],
            'vkontakte' => ['max:36'],
            'logo' => ['image', 'max:2048'],
        ]);

        $city = City::with('region')->findOrFail($request->city);

        $company = new Company();

        $company->name = $request->name;
        $company->address = $request->address;
        $company->description = $request->description;
        $company->city_id = $request->city;
        $company->region_id = $city->region->id; // add to region key
        $company->phone = $request->phone;
        $company->web = $request->web;
        $company->viber = $request->viber;
        $company->whatsapp = $request->whatsapp;
        $company->telegram = $request->telegram;
        $company->instagram = $request->instagram;
        $company->vkontakte = $request->vkontakte;
        $company->user_id = $request->user;

        if ($request->logo) {
            $company->logo = $request->file('logo')->store('companies', 'public');
        }

        $company->save();

        return redirect()->route('admin.company.index')->with('success', 'The company added');

    
    }

    public function show(string $id)
    {
        $company = Company::with('user')->findOrFail($id);
        return view('admin.company.show', ['company' => $company]);
    }

    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        $users = User::all();
        
        return view('admin.company.edit', ['company' => $company, 'users' => $users]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'phone' => ['string', 'max:36'],
            'web' => ['max:250'],
            'viber' => ['max:36'],
            'whatsapp' => ['max:36'],
            'telegram' => ['max:36'],
            'instagram' => ['max:36'],
            'vkontakte' => ['max:36'],
            'logo' => ['image', 'max:2048'],
        ]);

        $company = Company::findOrFail($id);

        $city = City::with('region')->findOrFail($request->city);

        if ($request->logo) {
            Storage::delete('public/'.$company->logo);
            $company->logo = $request->file('logo')->store('companies', 'public');
        }

        $company->name = $request->name;
        $company->address = $request->address;
        $company->description = $request->description;
        $company->city_id = $request->city;
        $company->region_id = $city->region->id; // add to region key
        $company->phone = $request->phone;
        $company->web = $request->web;
        $company->viber = $request->viber;
        $company->whatsapp = $request->whatsapp;
        $company->telegram = $request->telegram;
        $company->instagram = $request->instagram;
        $company->vkontakte = $request->vkontakte;
        $company->user_id = $request->user;

        $company->update();

        return redirect()->route('admin.company.show', ['company' => $company->id])
            ->with('success', "The company saved");
    }

    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);

        if($company->logo !== null) {
            Storage::delete('public/'.$company->logo);
        }

        $company->delete();

        return redirect()->route('admin.company.index')->with('success', 'The company deleted');
    }
}
