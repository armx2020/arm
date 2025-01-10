<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Entity;
use App\Models\Region;

class SelectCompanies extends BaseSelect
{
    public $category = 'Все';

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $entityShowRout = 'companies.show';
        $exp = explode('|', $this->sort);

        $entities = Entity::query()->active()
            ->orderBy($exp[0], $exp[1])
            ->with(['categories', 'region']);

        $recommendations = [];

        if ($this->region !== 1) {
            $entities = $entities
                ->where('region_id', '=', $this->region);

            $recommendations = Entity::query()->active()
                ->orderBy($exp[0], $exp[1])
                ->with(['fields', 'region'])
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })
                ->limit(3)
                ->get();
        }

        if ($this->category !== 'Все') {
            $entities = $entities->whereHas('fields', function ($query) {
                $query->where('category_entity.main_category_id', '=', $this->category);
            });
        }

        $entities = $entities->paginate($this->quantityOfDisplayed);
        $categories = Category::query()->main()->active()->orderBy('sort_id')->get();

        $regions = Region::all();

        return view('livewire.select-companies', [
            'entityShowRout' => $entityShowRout,
            'entities' => $entities,
            'regions' => $regions,
            'region' => $this->region,
            'recommendations' => $recommendations,
            'position' => $this->position,
            'categories' => $categories,
        ]);
    }
}
