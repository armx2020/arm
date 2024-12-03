<?php

namespace App\Services;

use App\Services\Traits\GetCity;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class UserService
{
    use GetCity;

    public function store($request): User
    {
        $city = $this->getCity($request);

        $user = new User();

        $user->firstname = $request->firstname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->city_id = $request->city;
        $user->region_id = $city->region->id;
        $user->viber = $request->viber;
        $user->whatsapp = $request->whatsapp;
        $user->telegram = $request->telegram;
        $user->instagram = $request->instagram;
        $user->vkontakte = $request->vkontakte;

        if ($request->image) {
            $user->image = $request->file('image')->store('users', 'public');
            Image::make('storage/' . $user->image)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $user->save();

        return $user;
    }

    public function update($request, $user): User
    {
        $city = $this->getCity($request);

        $user->firstname = $request->firstname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->city_id = $city->id;
        $user->region_id = $city->region->id;
        $user->viber = $request->viber;
        $user->whatsapp = $request->whatsapp;
        $user->telegram = $request->telegram;
        $user->instagram = $request->instagram;
        $user->vkontakte = $request->vkontakte;

        if ($request->image_remove == 'delete') {
            Storage::delete('public/' . $user->image);
            $user->image = null;
        }
        if ($request->image) {
            Storage::delete('public/' . $user->image);
            $user->image = $request->file('image')->store('users', 'public');
            Image::make('storage/' . $user->image)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $user->update();

        return $user;
    }
}
