<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyOffer;
use App\Models\OfferCategory;
use App\Services\OfferService;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    public function __construct(private OfferService $offerService)
    {
        $this->offerService = $offerService;
    }

    public function index()
    {
        return view('admin.offer.index');
    }

    public function create()
    {
        $companies = Company::all();
        $categories = OfferCategory::all();

        return view('admin.offer.create', ['companies' => $companies, 'categories' => $categories]);
    }

    public function store(OfferRequest $request)
    {
        $this->offerService->store($request);

        return redirect()->route('admin.offer.index')->with('success', 'The offer added');
    }

    public function show(string $id)
    {
        $offer = CompanyOffer::with('company', 'category')->find($id);

        if (empty($offer)) {
            return redirect()->route('admin.offer.index')->with('alert', 'The offer not found');
        }

        return view('admin.offer.show', ['offer' => $offer]);
    }

    public function edit(string $id)
    {
        $offer = CompanyOffer::with('company', 'category')->find($id);

        if (empty($offer)) {
            return redirect()->route('admin.offer.index')->with('alert', 'The offer not found');
        }

        $categories = OfferCategory::all();
        $companies = Company::all();
        $company = $offer->company;
        $category = $offer->category;

        return view('admin.offer.edit', [
            'offer' => $offer,
            'company' => $company,
            'category' => $category,
            'categories' => $categories,
            'companies' => $companies
        ]);
    }

    public function update(OfferRequest $request, string $id)
    {
        $offer = CompanyOffer::find($id);

        if (empty($offer)) {
            return redirect()->route('admin.offer.index')->with('alert', 'The offer not found');
        }

        $this->offerService->update($request, $offer);

        return redirect()->route('admin.offer.show', ['offer' => $offer->id])
            ->with('success', 'The offer saved');
    }

    public function destroy(string $id)
    {
        $offer = CompanyOffer::find($id);

        if (empty($offer)) {
            return redirect()->route('admin.offer.index')->with('alert', 'The offer not found');
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

        return redirect()->route('admin.offer.index')->with('success', 'The offer deleted');
    }
}
