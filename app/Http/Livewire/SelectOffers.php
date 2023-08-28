<?php

namespace App\Http\Livewire;

use App\Models\CompanyOffer;
use App\Models\OfferCategory;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;

class SelectOffers extends Component
{
    use WithPagination;

    public $term = 0;
    public $region;

    public function mount(Request $request)
    {
        $reg = Region::where('name', '=', $request->session()->get('region'))->First();

        if (empty($reg)) {
            $this->region = 1;
        } else {
            $this->region = $reg->id;
        }
    }

    public function render()
    {
        if ($this->term == 0 && $this->region == 1) {
            $offers = CompanyOffer::with('company')->paginate(12);
            $recommendations = [];
        } elseif ($this->term !== 0 && $this->region == 1) {
            $offers = CompanyOffer::with('company', 'region')
                ->where('offer_category_id', '=', $this->term)
                ->paginate(12);
            $recommendations = [];
        } elseif ($this->term == 0 && $this->region !== 1) {
            $offers = CompanyOffer::with('company', 'region')
                ->where('region_id', '=', $this->region)
                ->paginate(12);
            $recommendations = CompanyOffer::with('company', 'region')
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })->limit(3)->get();
        } else {
            $offers = CompanyOffer::with('company', 'region')
                ->where('offer_category_id', '=', $this->term)
                ->where('region_id', '=', $this->region)
                ->paginate(12);
            $recommendations = CompanyOffer::with('company', 'region')
                ->where('offer_category_id', '=', $this->term)
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })->limit(3)->get();
        }

        $categories = OfferCategory::orderBy('sort_id', 'asc')->get();
        $regions = Region::all();

        return view('livewire.select-offers', [
            'offers' => $offers,
            'categories' => $categories,
            'regions' => $regions,
            'recommendations' => $recommendations,
            'region' => $this->region
        ]);
    }
}
