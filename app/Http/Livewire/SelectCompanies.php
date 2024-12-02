<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Company;
use App\Models\Region;
use Illuminate\Contracts\Database\Eloquent\Builder;

class SelectCompanies extends BaseSelect
{
    public $category = '';
    public $subcategory = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $entityShowRout = 'companies.show';
        $exp = explode('|', $this->sort);

        $companies = Company::query()
            ->orderBy($exp[0], $exp[1])
            ->where('activity', 1)
            ->with(['categories', 'region']);

        $recommendations = [];

        if ($this->region !== 1) {
            $companies = $companies
                ->where('region_id', '=', $this->region);

            $recommendations = $recommendations = Company::query()
                ->orderBy($exp[0], $exp[1])
                ->where('activity', 1)
                ->with(['categories', 'region'])
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })
                ->limit(3)
                ->get();
        }



        $companyCategories = Category::query()->offer()->main()->orderBy('sort_id')->get();

        if ($this->category) {

            if ($this->subcategory) {
                $companies = $companies->whereHas('categories', function ($query) {
                    $query->where('category_company.category_id', $this->subcategory);
                });
            } else {
                $companies = $companies->where('category_id', '=', $this->category);
            }

            $companies = $companies->paginate(12);
            $subCompanyCategories = Category::query()->where('category_id', $this->category)->orderBy('sort_id')->get();
        } else {
            $companies = $companies->paginate(12);
            $subCompanyCategories = null;
        }

        $regions = Region::all();

        return view('livewire.select-companies', [
            'entityShowRout' => $entityShowRout,
            'entities' => $companies,
            'regions' => $regions,
            'region' => $this->region,
            'recommendations' => $recommendations,
            'position' => $this->position,
            'companyCategories' => $companyCategories,
            'subCompanyCategories' => $subCompanyCategories,
        ]);
    }
}
