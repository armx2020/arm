<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\BaseController;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class MyOfferController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $companies = Company::with('offers')->where('user_id', '=', Auth::user()->id)->get();

        if (count($companies) == 0) {
            return redirect()->route('mycompanies.index')->with('alert', 'У вас нет компаний! Сначала добавьте вашу компанию.');
        }

        $categories = Category::offer()->orderBy('sort_id', 'asc')->get();

        return view('profile.pages.offer.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'companies' => $companies,
            'categories' => $categories,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function create()
    {
        return redirect()->route('myoffers.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
            'image' => ['image'],
            'image1' => ['image'],
            'image2' => ['image'],
            'image3' => ['image'],
            'image4' => ['image'],
        ]);

        $company = Company::where('user_id', '=', Auth::user()->id)->find($request->company);

        if (empty($company)) {
            return redirect()->route('myoffers.index');
        }

        $offer = new CompanyOffer();

        $offer->name = $request->name;
        $offer->address = $request->address;
        $offer->description = $request->description;
        $offer->category_id = $request->category;
        $offer->company_id = $company->id;
        $offer->city_id = $company->city_id;
        $offer->region_id = $company->region->id;
        $offer->phone = $company->phone;
        $offer->web = $company->web;
        $offer->viber = $company->viber;
        $offer->whatsapp = $company->whatsapp;
        $offer->telegram = $company->telegram;
        $offer->instagram = $company->instagram;
        $offer->vkontakte = $company->vkontakte;
        $offer->user_id = Auth::user()->id;


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

        return redirect()->route('myoffers.index')->with('success', 'Товар "' . $offer->name . '" добавлен');
    }

    public function show(Request $request, $id)
    {
        $offer = CompanyOffer::with('company')->find($id);

        if (empty($offer)) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        if (!$offer->company->user_id == Auth::user()->id) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        return view('profile.pages.offer.show', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'offer' => $offer,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $offer = CompanyOffer::with('company')->find($id);

        if (empty($offer)) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        if (!$offer->company->user_id == Auth::user()->id) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        $categories = Category::offer()->orderBy('sort_id', 'asc')->get();
        $companies = Company::with('offers')->where('user_id', '=', Auth::user()->id)->get();

        return view('profile.pages.offer.edit', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'offer' => $offer,
            'categories' => $categories,
            'companies' => $companies,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
            'image' => ['image'],
            'image1' => ['image'],
            'image2' => ['image'],
            'image3' => ['image'],
            'image4' => ['image'],
        ]);

        $offer = CompanyOffer::find($id);

        if (empty($offer)) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        if (!$offer->company->user_id == Auth::user()->id) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }


        $company = Company::where('user_id', '=', Auth::user()->id)->find($request->company);

        if (empty($company)) {
            return redirect()->route('myoffers.index');
        }


        $offer->name = $request->name;
        $offer->address = $request->address;
        $offer->description = $request->description;
        $offer->category_id = $request->category;
        $offer->company_id = $company->id;
        $offer->city_id = $company->city_id;
        $offer->region_id = $company->region->id;
        $offer->phone = $company->phone;
        $offer->web = $company->web;
        $offer->viber = $company->viber;
        $offer->whatsapp = $company->whatsapp;
        $offer->telegram = $company->telegram;
        $offer->instagram = $company->instagram;
        $offer->vkontakte = $company->vkontakte;

        if ($request->image_r == 'delete') {
            Storage::delete('public/' . $offer->image);
            $offer->image = null;
        }

        if ($request->image_r1 == 'delete') {
            Storage::delete('public/' . $offer->image1);
            $offer->image1 = null;
        }

        if ($request->image_r2 == 'delete') {
            Storage::delete('public/' . $offer->image2);
            $offer->image2 = null;
        }

        if ($request->image_r3 == 'delete') {
            Storage::delete('public/' . $offer->image3);
            $offer->image3 = null;
        }

        if ($request->image_r4 == 'delete') {
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

        $offer->update();

        return redirect()->route('myoffers.show', ['myoffer' => $offer->id])->with('success', 'Товар "' . $offer->name . '" обнавлен');
    }

    public function destroy($id)
    {
        $offer = CompanyOffer::find($id);

        if (empty($offer)) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        if (!$offer->company->user_id == Auth::user()->id) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

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

        return redirect()->route('myoffers.index')->with('success', 'Товар удалён');
    }
}
