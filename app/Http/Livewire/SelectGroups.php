<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Group;
use App\Models\Region;

class SelectGroups extends BaseSelect
{

    public $category = 'Все';

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $entityShowRout = 'groups.show';
        $exp = explode('|', $this->sort);

        $groups = Group::query()->with('users')->active()->orderBy($exp[0], $exp[1]);
        $recommendations = [];

        if ($this->region !== 1) {
            $groups = $groups
                ->where('region_id', '=', $this->region);

            $recommendations = Group::query()->active()
                ->orderBy($exp[0], $exp[1])
                ->with('region')
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })
                ->limit(3)
                ->get();
        }


        if ($this->category !== 'Все') {
            $groups = $groups->where('category_id', '=', $this->category);
        }

        $groups = $groups->paginate(12);
        $categories = Category::active()->main()->group()->orderBy('sort_id')->get();

        $regions = Region::all();

        return view('livewire.select-groups', [
            'entityShowRout' => $entityShowRout,
            'entities' => $groups,
            'regions' => $regions,
            'region' => $this->region,
            'recommendations' => $recommendations,
            'position' => $this->position,
            'categories' => $categories,
        ]);
    }
}
