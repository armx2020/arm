<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyOffer;
use App\Models\OfferCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyOfferController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $companies = Company::with('offers')->where('user_id', '=', Auth::user()->id)->get();

        if (count($companies) == 0) {
            return redirect()->route('mycompanies.index')->with('alert', 'У вас нет компаний! Сначала добавьте вашу компанию.');
        }

        $categories = OfferCategory::orderBy('sort_id', 'asc')->get();

        return view('profile.pages.offer.index', [
            'city'   => $request->session()->get('city'),
            'companies' => $companies,
            'categories' => $categories,
            'cities' => $cities
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
            'price' => ['numeric'],
            'image' => ['image', 'max:2048'],
            'image1' => ['image', 'max:2048'],
            'image2' => ['image', 'max:2048'],
            'image3' => ['image', 'max:2048'],
            'image4' => ['image', 'max:2048'],
        ]);

        $company = Company::where('user_id', '=', Auth::user()->id)->find($request->company);

        if (empty($company)) {
            return redirect()->route('myoffers.index');
        }

        $offer = new CompanyOffer();

        $offer->name = $request->name;
        $offer->address = $request->address;
        $offer->description = $request->description;
        $offer->price = $request->price;
        $offer->offer_category_id = $request->category;
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
        

        if ($request->image) {
            $offer->image = $request->file('image')->store('offers', 'public');
        }
        if ($request->image1) {
            $offer->image1 = $request->file('image1')->store('offers', 'public');
        }
        if ($request->image2) {
            $offer->image2 = $request->file('image2')->store('offers', 'public');
        }
        if ($request->image3) {
            $offer->image3 = $request->file('image3')->store('offers', 'public');
        }
        if ($request->image4) {
            $offer->image4 = $request->file('image4')->store('offers', 'public');
        }

        $offer->save();

        return redirect()->route('myoffers.index')->with('success', 'Товар "' . $offer->name . '" добавлен');
    }

    public function show(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $offer = CompanyOffer::find($id);

        if (empty($offer)) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        if (!$offer->company->user_id == Auth::user()->id) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        return view('profile.pages.offer.show', [
            'city'   => $request->session()->get('city'),
            'offer' => $offer,
            'cities' => $cities
        ]);
    }

    public function edit(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $offer = CompanyOffer::with('company')->find($id);

        if (empty($offer)) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        if (!$offer->company->user_id == Auth::user()->id) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        $categories = OfferCategory::orderBy('sort_id', 'asc')->get();
        $companies = Company::with('offers')->where('user_id', '=', Auth::user()->id)->get();

        return view('profile.pages.offer.edit', [
            'city'   => $request->session()->get('city'),
            'offer' => $offer,
            'categories' => $categories,
            'companies' => $companies,
            'cities' => $cities
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
            'price' => ['numeric'],
            'image' => ['image', 'max:2048'],
            'image1' => ['image', 'max:2048'],
            'image2' => ['image', 'max:2048'],
            'image3' => ['image', 'max:2048'],
            'image4' => ['image', 'max:2048'],
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
        $offer->price = $request->price;
        $offer->offer_category_id = $request->category;
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

        if ($request->image) {
            Storage::delete('public/' . $offer->image);
            $offer->image = $request->file('image')->store('offers', 'public');
        }
        if ($request->image1) {
            Storage::delete('public/' . $offer->image1);
            $offer->image1 = $request->file('image1')->store('offers', 'public');
        }
        if ($request->image2) {
            Storage::delete('public/' . $offer->image2);
            $offer->image2 = $request->file('image2')->store('offers', 'public');
        }
        if ($request->image3) {
            Storage::delete('public/' . $offer->image3);
            $offer->image3 = $request->file('image3')->store('offers', 'public');
        }
        if ($request->image4) {
            Storage::delete('public/' . $offer->image4);
            $offer->image4 = $request->file('image4')->store('offers', 'public');
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
