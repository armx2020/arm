<?php

namespace App\Http\Controllers;

use App\Models\CompanyOffer;
use Illuminate\Http\Request;

class OfferController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        return view('pages.offer.offers', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
        ]);
    }

    public function show(Request $request, $id)
    {
        $offer = CompanyOffer::with('company')->find($id);

        if (empty($offer)) {
            return redirect()->route('offers.index')->with('alert', 'Товар не найден');
        }

        $recommendations = CompanyOffer::where('company_id', '=', $offer->company->id)
            ->whereNot(function ($query) use ($id) {
                $query->where('id', '=', $id);
            })->paginate(12);

        return view('pages.offer.offer', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'offer' => $offer,
            'recommendations' => $recommendations,
        ]);
    }
}
