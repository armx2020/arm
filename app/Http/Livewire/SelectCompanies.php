<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Company;
use App\Models\Region;

class SelectCompanies extends BaseSelect
{
    public $category = 'Все категории';

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $entityShowRout = 'companies.show';
        $exp = explode('|', $this->sort);

        $companies = Company::query()->active()
            ->orderBy($exp[0], $exp[1])
            ->with(['categories', 'region']);

        $recommendations = [];

        if ($this->region !== 1) {
            $companies = $companies
                ->where('region_id', '=', $this->region);

            $recommendations = $recommendations = Company::query()->active()
                ->orderBy($exp[0], $exp[1])
                ->with(['categories', 'region'])
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })
                ->limit(3)
                ->get();
        }

        if ($this->category !== 'Все категории') {
            $companies = $companies->where('category_id', '=', $this->category)->orWhereHas('categories', function ($query) {
                $query->where('category_company.main_category_id', '=', $this->category);
            });
        }

        $companies = $companies->paginate(12);
        $categories = Category::query()->offer()->main()->active()->orderBy('sort_id')->get();

        $regions = Region::all();

        return view('livewire.select-companies', [
            'entityShowRout' => $entityShowRout,
            'entities' => $companies,
            'regions' => $regions,
            'region' => $this->region,
            'recommendations' => $recommendations,
            'position' => $this->position,
            'categories' => $categories,
        ]);
    }
}
