<?php

namespace App\Entity\Actions;

use App\Models\Company;
use App\Models\CompanyOffer;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class OfferAction
{
    public function store($request, $user_id = null): CompanyOffer
    {
        $company = Company::query();

        if ($user_id) {
            $company = $company->where('user_id', '=', $user_id);
        }

        $company = $company->find($request->company);

        if ($company) {
            $categoryBD = Category::find($request->category);

            if ($categoryBD) {
                $categoryMain = $categoryBD->category_id;

                if ($company->category_id == null) {
                    $company->category_id = $categoryMain;
                    $company->save();
                }

                $company->categories()->syncWithoutDetaching([$request->category => ['main_category_id' => $categoryMain]]);
            }
        } else {
            return redirect()->route('myoffers.index');
        }

        $offer = new CompanyOffer();
        $offer->name = $request->name;
        $offer->address = $request->address;
        $offer->description = $request->description;
        $offer->phone = $request->phone;
        $offer->city_id = $company->city_id;
        $offer->region_id = $company->region_id;
        $offer->phone = $company->phone;
        $offer->web = $company->web;
        $offer->viber = $company->viber;
        $offer->whatsapp = $company->whatsapp;
        $offer->telegram = $company->telegram;
        $offer->instagram = $company->instagram;
        $offer->vkontakte = $company->vkontakte;
        $offer->company_id = $request->company;
        $offer->user_id = $user_id ?: $company->user_id;
        $offer->category_id = $request->category;

        if ($request->image) {
            $offer->image = $request->file('image')->store('offers', 'public');
            Image::make('storage/' . $offer->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image1) {
            $offer->image1 = $request->file('image1')->store('offers', 'public');
            Image::make('storage/' . $offer->image1)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image2) {
            $offer->image2 = $request->file('image2')->store('offers', 'public');
            Image::make('storage/' . $offer->image2)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image3) {
            $offer->image3 = $request->file('image3')->store('offers', 'public');
            Image::make('storage/' . $offer->image3)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image4) {
            $offer->image4 = $request->file('image4')->store('offers', 'public');
            Image::make('storage/' . $offer->image4)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $offer->save();

        return $offer;
    }

    public function update($request, $offer, $user_id = null): CompanyOffer
    {
        $company = Company::query();

        if ($user_id) {
            $company = $company->where('user_id', '=', $user_id);
        }

        $company = $company->find($request->company);

        if ($company) {
            $company->categories()->detach($offer->category_id);

            $categoryBD = Category::find($request->category);

            if ($categoryBD) {
                $categoryMain = $categoryBD->category_id;

                if ($company->category_id == null) {
                    $company->category_id = $categoryMain;
                    $company->save();
                }

                $company->categories()->syncWithoutDetaching([$request->category => ['main_category_id' => $categoryMain]]);
            }
        } else {
            return redirect()->route('myoffers.index');
        }


        if ($request->image_remove == 'delete') {
            Storage::delete('public/' . $offer->image);
            $offer->image = null;
        }

        if ($request->image_remove1 == 'delete') {
            Storage::delete('public/' . $offer->image1);
            $offer->image1 = null;
        }

        if ($request->image_remove2 == 'delete') {
            Storage::delete('public/' . $offer->image2);
            $offer->image2 = null;
        }

        if ($request->image_remove3 == 'delete') {
            Storage::delete('public/' . $offer->image3);
            $offer->image3 = null;
        }

        if ($request->image_remove4 == 'delete') {
            Storage::delete('public/' . $offer->image4);
            $offer->image4 = null;
        }

        if ($request->image) {
            Storage::delete('public/' . $offer->image);
            $offer->image = $request->file('image')->store('offers', 'public');
            Image::make('storage/' . $offer->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image1) {
            Storage::delete('public/' . $offer->image1);
            $offer->image1 = $request->file('image1')->store('offers', 'public');
            Image::make('storage/' . $offer->image1)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image2) {
            Storage::delete('public/' . $offer->image2);
            $offer->image2 = $request->file('image2')->store('offers', 'public');
            Image::make('storage/' . $offer->image2)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image3) {
            Storage::delete('public/' . $offer->image3);
            $offer->image3 = $request->file('image3')->store('offers', 'public');
            Image::make('storage/' . $offer->image3)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image4) {
            Storage::delete('public/' . $offer->image4);
            $offer->image4 = $request->file('image4')->store('offers', 'public');
            Image::make('storage/' . $offer->image4)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $offer->name = $request->name;
        $offer->address = $request->address;
        $offer->description = $request->description;
        $offer->category_id = $request->category;
        $offer->company_id = $company->id;
        $offer->city_id = $company->city_id;
        $offer->region_id = $company->region_id;
        $offer->phone = $company->phone;
        $offer->web = $company->web;
        $offer->viber = $company->viber;
        $offer->whatsapp = $company->whatsapp;
        $offer->telegram = $company->telegram;
        $offer->instagram = $company->instagram;
        $offer->vkontakte = $company->vkontakte;
        $offer->user_id = $user_id ?: $company->user_id;

        $offer->update();

        return $offer;
    }

    public function destroy($offer): void
    {
        if ($offer->image !== null) {
            Storage::delete('public/' . $offer->image);
        }
        if ($offer->image1 !== null) {
            Storage::delete('public/' . $offer->image1);
        }
        if ($offer->image2 !== null) {
            Storage::delete('public/' . $offer->image2);
        }
        if ($offer->image3 !== null) {
            Storage::delete('public/' . $offer->image3);
        }
        if ($offer->image4 !== null) {
            Storage::delete('public/' . $offer->image4);
        }

        $offer->delete();
    }
}
