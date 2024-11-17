<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Group;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;

class SelectGroups extends Component
{
    use WithPagination;

    public $term = 0;
    public $sort = "updated_at|desc";
    public $view = 1;
    public $region;

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

        switch ($request->session()->pull('filter')) {
            case 'places':
                $this->term = 6;
                break;
            case 'religion':
                $this->term = 5;
                break;
        }
    }

    public function render()
    {
        $exp = explode('|', $this->sort);

        if ($this->term == 0 && $this->region == 1) {
            $groups = Group::with('users')->where('activity', 1)->orderBy($exp[0], $exp[1])->paginate(12);
            $recommendations = [];
        } elseif ($this->term !== 0 && $this->region == 1) {
            $groups = Group::with('users', 'region')
                ->where('activity', 1)
                ->where('category_id', '=', $this->term)
                ->orderBy($exp[0], $exp[1])
                ->paginate(12);
            $recommendations = [];
        } elseif ($this->term == 0 && $this->region !== 1) {
            $groups = Group::with('users', 'region')
                ->where('activity', 1)
                ->where('region_id', '=', $this->region)
                ->orderBy($exp[0], $exp[1])
                ->paginate(12);

            $recommendations = Group::with('user', 'region')
                ->where('activity', 1)
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })->limit(3)->get();
        } else {
            $groups = Group::with('users', 'region')
                ->where('activity', 1)
                ->where('category_id', '=', $this->term)
                ->where('region_id', '=', $this->region)
                ->orderBy($exp[0], $exp[1])
                ->paginate(12);

            $recommendations = Group::with('user', 'region')
                ->where('activity', 1)
                ->where('category_id', '=', $this->term)
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })->limit(3)->get();
        }

        $categories = Category::active()->orderBy('sort_id', 'asc')->get();
        $regions = Region::all();

        return view('livewire.select-groups', [
            'groups' => $groups,
            'categories' => $categories,
            'recommendations' => $recommendations,
            'regions' => $regions,
            'region' => $this->region
        ]);
    }
}
