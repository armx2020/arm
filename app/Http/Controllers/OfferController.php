<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CompanyOffer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        return view('pages.offer.offers', [
            'city'   => $request->session()->get('city'),
            'cities' => $cities
        ]);
    }

    public function show(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $offer = CompanyOffer::with('company')->find($id);

        if (empty($offer)) {
            return redirect()->route('offers.index')->with('alert', 'Товар не найден');
        }

        $recommendations = CompanyOffer::where('company_id', '=', $offer->company->id)
            ->whereNot(function ($query) use ($id) {
                $query->where('id', '=', $id);
            })->paginate(12);

        return view('pages.offer.offer', [
            'city'   => $request->session()->get('city'),
            'offer' => $offer,
            'recommendations' => $recommendations,
            'cities' => $cities
        ]);
    }
}
