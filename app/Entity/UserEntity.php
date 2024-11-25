<?php

namespace App\Entity;

use App\Contracts\EntityColumnsInterface;
use App\Contracts\EntityFiltersInterface;
use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class UserEntity implements EntityColumnsInterface, EntityFiltersInterface
{
    protected $allColumns = [
        'id',
        'firstname',
        'email',
        'phone',
        'last_active_at',
        'activity',
        'created_at',
        'updated_at',
        'viber',
        'whatsapp',
        'instagram',
        'vkontakte',
        'telegram',
        'city_id',
        'region_id',
    ];

    protected $selectedColumns = [
        'id',
        'firstname',
        'email',
        'phone',
        'city_id',
        'region_id',
    ];

    protected $filters = [
        'created_at' => 'date',
        'updated_at' => 'date',
        'last_active_at' => 'date',
        'activity' => 'bool',
        'city_id' => 'select',
        'region_id' => 'select',
    ];

    protected $selectedFilters = [];

    public function getAllColumns(): array
    {
        return $this->allColumns;
    }

    public function getSelectedColumns(): array
    {
        return $this->selectedColumns;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getSelectedFilters(): array
    {
        return $this->selectedFilters;
    }

    public function store($request): User
    {
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

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
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

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

        if ($request->image_r == 'delete') {
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
