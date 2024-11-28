<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use App\Models\Region;

class SelectEvents extends Component
{
    use WithPagination;

    public $term = 0;
    public $region;
    public $sort = "updated_at|desc";
    public $view = 2;

    public function mount(Request $request, $regionCode = null)
    {
        if($regionCode) {
            $reg = Region::where('code', '=', $regionCode)->First();
        } else {
            $reg = Region::where('name', '=', $request->session()->get('region'))->First();
        }

        if (empty($reg)) {
            $this->region = 1;
        } else {
            $this->region = $reg->id;
        }
    }
    public function render()
    {
        $exp = explode('|', $this->sort);

        if ($this->term == 0 && $this->region == 1) {
            $events = Event::orderBy($exp[0], $exp[1])->where('activity', 1)->paginate(12);
            $recommendations = [];
        } elseif ($this->term !== 0 && $this->region == 1) {
            $events = Event::with('region')
                ->where('activity', 1)
                ->where('category_id', '=', $this->term)
                ->orderBy($exp[0], $exp[1])
                ->paginate(12);
            $recommendations = [];
        } elseif ($this->term == 0 && $this->region !== 1) {
            $events = Event::with('region')
                ->where('activity', 1)
                ->where('region_id', '=', $this->region)
                ->orderBy($exp[0], $exp[1])
                ->paginate(12);

            $recommendations = Event::with('region')
                ->where('activity', 1)
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })->limit(3)->get();
        } else {
            $events = Event::with('region')
                ->where('activity', 1)
                ->where('category_id', '=', $this->term)
                ->where('region_id', '=', $this->region)
                ->orderBy($exp[0], $exp[1])
                ->paginate(12);

            $recommendations = Event::with('region')
                ->where('activity', 1)
                ->where('category_id', '=', $this->term)
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })->limit(3)->get();
        }

        $categories = Category::active()->event()->main()->orderBy('sort_id', 'asc')->get();
        $regions = Region::all();

        return view('livewire.select-events', [
            'events' => $events,
            'categories' => $categories,
            'regions' => $regions,
            'region' => $this->region,
            'recommendations' => $recommendations,
        ]);
    }
}
