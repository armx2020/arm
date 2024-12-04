<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Event;
use App\Models\Region;

class SelectEvents extends BaseSelect
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

        $events = Event::query()->with('region')->active()->orderBy($exp[0], $exp[1]);
        $recommendations = [];

        if ($this->region !== 1) {
            $events = $events
                ->where('region_id', '=', $this->region);

            $recommendations = $recommendations = Event::query()->active()
                ->orderBy($exp[0], $exp[1])
                ->with('region')
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })
                ->limit(3)
                ->get();
        }

        if ($this->category !== 'Все') {
            $events = $events->where('category_id', '=', $this->category);
        }

        $events = $events->paginate(12);
        $categories = Category::active()->event()->main()->orderBy('sort_id')->get();

        $regions = Region::all();

        return view('livewire.select-events', [
            'entityShowRout' => $entityShowRout,
            'entities' => $events,
            'regions' => $regions,
            'region' => $this->region,
            'recommendations' => $recommendations,
            'position' => $this->position,
            'categories' => $categories,
        ]);
    }
}
