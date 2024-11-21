<?php

namespace App\Services;

use App\Models\City;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class NewsService
{
    public function store($request): News
    {
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $news = new News();

        $news->name = $request->name;
        $news->date = $request->date;
        $news->city_id = $city->id;
        $news->region_id = $city->region->id;
        $news->description = $request->description;

        if ($request->parent == 'User') {
            $news->parent_type = 'App\Models\User';
            $news->parent_id = $request->user;
        } elseif ($request->parent == 'Company') {
            $news->parent_type = 'App\Models\Company';
            $news->parent_id = $request->company;
        } elseif ($request->parent == 'Group') {
            $news->parent_type = 'App\Models\Group';
            $news->parent_id = $request->group;
        } else {
            $news->parent_type = 'App\Models\Admin';
            $news->parent_id = 1;
        }

        if ($request->image) {
            Storage::delete('public/' . $news->image);
            $news->image = $request->file('image')->store('news', 'public');
            Image::make('storage/'.$news->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image1) {
            Storage::delete('public/' . $news->image1);
            $news->image1 = $request->file('image1')->store('news', 'public');
            Image::make('storage/'.$news->image1)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image2) {
            Storage::delete('public/' . $news->image2);
            $news->image2 = $request->file('image2')->store('news', 'public');
            Image::make('storage/'.$news->image2)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image3) {
            Storage::delete('public/' . $news->image3);
            $news->image3 = $request->file('image3')->store('news', 'public');
            Image::make('storage/'.$news->image3)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image4) {
            Storage::delete('public/' . $news->image4);
            $news->image4 = $request->file('image4')->store('news', 'public');
            Image::make('storage/'.$news->image4)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $news->save();

        return $news;
    }

    public function update($request, $news): News
    {
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $news->name = $request->name;
        $news->date = $request->date;
        $news->city_id = $request->city;
        $news->region_id = $city->region->id;
        $news->description = $request->description;

        if ($request->parent == 'User') {
            $news->parent_type = 'App\Models\User';
            $news->parent_id = $request->user;
        } elseif ($request->parent == 'Company') {
            $news->parent_type = 'App\Models\Company';
            $news->parent_id = $request->company;
        } elseif ($request->parent == 'Group') {
            $news->parent_type = 'App\Models\Group';
            $news->parent_id = $request->group;
        } else {
            $news->parent_type = 'App\Models\Admin';
            $news->parent_id = 1;
        }

        if ($request->image_r == 'delete') {
            Storage::delete('public/' . $news->image);
            $news->image = null;
        }

        if ($request->image_r1 == 'delete') {
            Storage::delete('public/' . $news->image1);
            $news->image1 = null;
        }

        if ($request->image_r2 == 'delete') {
            Storage::delete('public/' . $news->image2);
            $news->image2 = null;
        }

        if ($request->image_r3 == 'delete') {
            Storage::delete('public/' . $news->image3);
            $news->image3 = null;
        }

        if ($request->image_r4 == 'delete') {
            Storage::delete('public/' . $news->image4);
            $news->image4 = null;
        }

        if ($request->image) {
            Storage::delete('public/' . $news->image);
            $news->image = $request->file('image')->store('news', 'public');
            Image::make('storage/'.$news->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image1) {
            Storage::delete('public/' . $news->image1);
            $news->image1 = $request->file('image1')->store('news', 'public');
            Image::make('storage/'.$news->image1)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image2) {
            Storage::delete('public/' . $news->image2);
            $news->image2 = $request->file('image2')->store('news', 'public');
            Image::make('storage/'.$news->image2)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image3) {
            Storage::delete('public/' . $news->image3);
            $news->image3 = $request->file('image3')->store('news', 'public');
            Image::make('storage/'.$news->image3)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image4) {
            Storage::delete('public/' . $news->image4);
            $news->image4 = $request->file('image4')->store('news', 'public');
            Image::make('storage/'.$news->image4)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $news->update();

        return $news;
    }
}
