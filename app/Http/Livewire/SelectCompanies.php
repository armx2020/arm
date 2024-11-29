<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Region;

class SelectCompanies extends BaseSelect
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $entityShowRout = 'companies.show';

        $exp = explode('|', $this->sort);

        if ($this->region == 1) {
            $companies = Company::orderBy($exp[0], $exp[1])->where('activity', 1)->with('categories')->paginate(12);
            $recommendations = [];
        } else {
            $companies = Company::with('region')
                ->where('activity', 1)
                ->where('region_id', '=', $this->region)
                ->orderBy($exp[0], $exp[1])
                ->with('categories')
                ->paginate(12);

            $recommendations = Company::with('region')
                ->where('activity', 1)
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })
                ->limit(3)
                ->with('categories')
                ->get();
        }

        $regions = Region::all();

        return view('livewire.select-companies', [
            'entityShowRout' => $entityShowRout,
            'entities' => $companies,
            'regions' => $regions,
            'region' => $this->region,
            'recommendations' => $recommendations,
            'position' => $this->position
        ]);
    }
}
