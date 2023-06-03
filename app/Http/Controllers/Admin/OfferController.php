<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyOffer;
use App\Models\OfferCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = CompanyOffer::with('company', 'category')->latest()->paginate(20);

        return view('admin.offer.index', ['offers' => $offers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $categories = OfferCategory::all();

        return view('admin.offer.create', ['companies' => $companies, 'categories'=> $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'description' => ['string'],
            'phone' => ['string', 'max:36'],
            'web' => ['max:250'],
            'viber' => ['max:36'],
            'whatsapp' => ['max:36'],
            'telegram' => ['max:36'],
            'instagram' => ['max:36'],
            'vkontakte' => ['max:36'],
            'image' => ['image', 'max:2048'],
            'image1' => ['image', 'max:2048'],
            'image2' => ['image', 'max:2048'],
            'image3' => ['image', 'max:2048'],
            'image4' => ['image', 'max:2048'],
        ]);

        $offer = New CompanyOffer();

        $offer->name = $request->name;
        $offer->address = $request->address;
        $offer->description = $request->description;
        $offer->phone = $request->phone;
        $offer->price = $request->price;
        $offer->unit_of_price = $request->unit_of_price;
        $offer->web = $request->web;
        $offer->viber = $request->viber;
        $offer->whatsapp = $request->whatsapp;
        $offer->telegram = $request->telegram;
        $offer->instagram = $request->instagram;
        $offer->vkontakte = $request->vkontakte;
        $offer->company_id = $request->company;
        $offer->offer_category_id = $request->category;

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

        return redirect()->route('admin.offer.index')->with('success', 'The offer added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $offer = CompanyOffer::with('company', 'category')->findOrFail($id);
        return view('admin.offer.show', ['offer' => $offer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $offer = CompanyOffer::with('company', 'category')->findOrFail($id);
        $categories = OfferCategory::all();
        $companies = Company::all();
        $company = $offer->company;
        $category = $offer->category;
        return view('admin.offer.edit', [   'offer' => $offer,
                                            'company' => $company,
                                            'category' => $category,
                                            'categories' => $categories,
                                            'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'description' => ['string'],
            'phone' => ['string', 'max:36'],
            'web' => ['max:250'],
            'viber' => ['max:36'],
            'whatsapp' => ['max:36'],
            'telegram' => ['max:36'],
            'instagram' => ['max:36'],
            'vkontakte' => ['max:36'],
            'image' => ['image', 'max:2048'],
            'image1' => ['image', 'max:2048'],
            'image2' => ['image', 'max:2048'],
            'image3' => ['image', 'max:2048'],
            'image4' => ['image', 'max:2048'],
        ]);

        $offer = CompanyOffer::findOrFail($id);

        $offer->name = $request->name;
        $offer->address = $request->address;
        $offer->description = $request->description;
        $offer->phone = $request->phone;
        $offer->price = $request->price;
        $offer->unit_of_price = $request->unit_of_price;
        $offer->web = $request->web;
        $offer->viber = $request->viber;
        $offer->whatsapp = $request->whatsapp;
        $offer->telegram = $request->telegram;
        $offer->instagram = $request->instagram;
        $offer->vkontakte = $request->vkontakte;
        $offer->company_id = $request->company;
        $offer->offer_category_id = $request->category;

        if ($request->image) {
            Storage::delete('public/'.$offer->image);
            $offer->image = $request->file('image')->store('offers', 'public');
        }
        if ($request->image1) {
            Storage::delete('public/'.$offer->image1);
            $offer->image1 = $request->file('image1')->store('offers', 'public');
        }
        if ($request->image2) {
            Storage::delete('public/'.$offer->image2);
            $offer->image2 = $request->file('image2')->store('offers', 'public');
        }
        if ($request->image3) {
            Storage::delete('public/'.$offer->image3);
            $offer->image3 = $request->file('image3')->store('offers', 'public');
        }
        if ($request->image4) {
            Storage::delete('public/'.$offer->image4);
            $offer->image4 = $request->file('image4')->store('offers', 'public');
        }

        $offer->update();

        return redirect()->route('admin.offer.show', ['offer'=>$offer->id])
                        ->with('success', 'The offer saved');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $offer = CompanyOffer::findOrFail($id);

        if($offer->image !== null) {
            Storage::delete('public/'.$offer->image);
        }
        if($offer->image1 !== null) {
            Storage::delete('public/'.$offer->image1);
        }
        if($offer->image2 !== null) {
            Storage::delete('public/'.$offer->image2);
        }
        if($offer->image3 !== null) {
            Storage::delete('public/'.$offer->image3);
        }
        if($offer->image4 !== null) {
            Storage::delete('public/'.$offer->image4);
        }

        $offer->delete();

        return redirect()->route('admin.offer.index')->with('success', 'The offer deleted');
    }
}
