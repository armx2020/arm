<?php

namespace App\Services;

use App\Models\City;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class CompanyService
{
    public function store($request): Company
    {
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $company = new Company();

        $company->name = $request->name;
        $company->address = $request->address;
        $company->description = $request->description;
        $company->city_id = $city->id;
        $company->region_id = $city->region->id;
        $company->phone = $request->phone;
        $company->web = $request->web;
        $company->viber = $request->viber;
        $company->whatsapp = $request->whatsapp;
        $company->telegram = $request->telegram;
        $company->instagram = $request->instagram;
        $company->vkontakte = $request->vkontakte;
        $company->user_id = $request->user ? $request->user : 1;

        if ($request->image) {
            $company->image = $request->file('image')->store('companies', 'public');
            Image::make('storage/' . $company->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        } else {
            $company->image = 'group/groups.png';
        }

        $company->save();

        return $company;
    }

    public function update($request, $company): Company
    {
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

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
        } else {
            $company->image = 'group/groups.png';
        }

        $company->name = $request->name;
        $company->address = $request->address;
        $company->description = $request->description;
        $company->city_id = $city->id;
        $company->region_id = $city->region->id;
        $company->phone = $request->phone;
        $company->web = $request->web;
        $company->viber = $request->viber;
        $company->whatsapp = $request->whatsapp;
        $company->telegram = $request->telegram;
        $company->instagram = $request->instagram;
        $company->vkontakte = $request->vkontakte;
        $company->user_id = $request->user;

        $company->update();

        return $company;
    }
}
