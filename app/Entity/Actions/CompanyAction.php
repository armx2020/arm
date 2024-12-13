<?php

namespace App\Entity\Actions;

use App\Entity\Actions\Traits\GetCity;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class CompanyAction
{
    use GetCity;

    public function store($request, $user_id = null, $isActive = true): Company
    {
        $city = $this->getCity($request);

        $company = new Company();

        if (isset($isActive) || $isActive == false) {
            $company->activity = $isActive;
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
        $company->user_id = $user_id ?: $request->user;

        if ($request->image) {
            $company->image = $request->file('image')->store('companies', 'public');
            Image::make('storage/' . $company->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $company->save();

        if ($request->categories) {
            foreach ($request->categories as $categoryID => $val) {
                $categoryBD = Category::find($categoryID);

                if ($categoryBD) {
                    $categoryMain = $categoryBD->category_id;

                    if ($company->category_id == null) {
                        $company->category_id = $categoryMain;
                        $company->save();
                    }
                    $company->categories()->attach($categoryID, ['main_category_id' => $categoryMain]);
                }
            }
        }

        return $company;
    }

    public function update($request, $company, $user_id = null): Company
    {
        $city = $this->getCity($request);

        if ($request->image_remove == 'delete') {
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
        $company->user_id = $user_id ?: $request->user;

        $company->categories()->detach();

        $company->update();

        if ($request->categories) {
            foreach ($request->categories as $categoryID => $val) {
                $categoryBD = Category::find($categoryID);

                if ($categoryBD) {
                    $categoryMain = $categoryBD->category_id;

                    if ($company->category_id == null) {
                        $company->category_id = $categoryMain;
                        $company->save();
                    }
                    $company->categories()->attach($categoryID, ['main_category_id' => $categoryMain]);
                }
            }
        }

        return $company;
    }

    public function destroy($company): void
    {
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

        if ($company->image !== null) {
            Storage::delete('public/' . $company->image);
        }

        $company->categories()->detach();
        $company->delete();
    }
}
