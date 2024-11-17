<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\OfferRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyOffer;
use App\Services\OfferService;
use Illuminate\Support\Facades\Storage;

class OfferController extends BaseAdminController
{
    public function __construct(private OfferService $offerService)
    {
        parent::__construct();
        $this->offerService = $offerService;
    }

    public function index()
    {
        return view('admin.offer.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        $companies = Company::all();
        $categories = Category::offer()->get();

        return view('admin.offer.create', ['companies' => $companies, 'categories' => $categories, 'menu' => $this->menu]);
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

        return view('admin.offer.show', ['offer' => $offer, 'menu' => $this->menu]);
    }

    public function edit(string $id)
    {
        $offer = CompanyOffer::with('company', 'category')->find($id);

        if (empty($offer)) {
            return redirect()->route('admin.offer.index')->with('alert', 'The offer not found');
        }

        $categories = Category::offer()->get();
        $companies = Company::all();
        $company = $offer->company;
        $category = $offer->category;

        return view('admin.offer.edit', [
            'offer' => $offer,
            'company' => $company,
            'category' => $category,
            'categories' => $categories,
            'companies' => $companies,
            'menu' => $this->menu
        ]);
    }

    public function update(OfferRequest $request, string $id)
    {
        $offer = CompanyOffer::find($id);

        if (empty($offer)) {
            return redirect()->route('admin.offer.index')->with('alert', 'The offer not found');
        }

        $offer = $this->offerService->update($request, $offer);

        return redirect()->route('admin.offer.show', ['offer' => $offer->id])
            ->with('success', 'The offer updated');
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
