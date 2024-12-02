<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Offer\StoreOfferRequest;
use App\Http\Requests\Offer\UpdateOfferRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyOffer;
use App\Services\OfferService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyOfferController extends BaseController
{
    public function __construct(private OfferService $offerService)
    {
        parent::__construct();
        $this->offerService = $offerService;
    }

    public function index(Request $request)
    {
        $companies = Company::with('offers')->where('user_id', '=', Auth::user()->id)->get();

        if (count($companies) == 0) {
            return redirect()->route('mycompanies.index')->with('alert', 'У вас нет компаний! Сначала добавьте вашу компанию.');
        }

        return view('profile.pages.offer.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'companies' => $companies,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function create(Request $request)
    {
        $companies = Company::with('offers')->where('user_id', '=', Auth::user()->id)->get();

        if (count($companies) == 0) {
            return redirect()->route('mycompanies.index')->with('alert', 'У вас нет компаний! Сначала добавьте вашу компанию.');
        }

        $categories = Category::offer()->whereNotNull('category_id')->orderBy('sort_id')->get();

        return view('profile.pages.offer.create', [
            'companies' => $companies,
            'categories' => $categories,
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function store(StoreOfferRequest $request)
    {
        $offer = $this->offerService->store($request, Auth::user()->id);

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

        if (empty($offer) || $offer->company->user_id !== Auth::user()->id) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        $categories = Category::offer()->whereNotNull('category_id')->orderBy('sort_id')->get();
        $companies = Company::query()->with('offers')->where('user_id', '=', Auth::user()->id)->whereNot('id', $offer->company_id)->get();

        return view('profile.pages.offer.edit', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'offer' => $offer,
            'categories' => $categories,
            'companies' => $companies,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function update(UpdateOfferRequest $request, $id)
    {
        $offer = CompanyOffer::find($id);

        if (empty($offer) || $offer->company->user_id !== Auth::user()->id) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        $offer = $this->offerService->update($request, $offer, Auth::user()->id);

        return redirect()->route('myoffers.show', ['myoffer' => $offer->id])->with('success', 'Товар "' . $offer->name . '" обнавлен');
    }

    public function destroy($id)
    {
        $offer = CompanyOffer::find($id);

        if (empty($offer) || $offer->company->user_id !== Auth::user()->id) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        $this->offerService->destroy($offer);

        return redirect()->route('myoffers.index')->with('success', 'Товар удалён');
    }
}
