<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\GroupCategory;
use App\Models\Region;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class HomePage extends Component
{
    use WithPagination;

    public $term = 0;
    public $region = 1;
    public $search = '';


    public function render()
    {
        if ($this->search == '') {
            sleep(1);

            if ($this->term == 0 && $this->region == 1) {
                $groups = Group::with('users', 'category')->paginate(4);
            } elseif ($this->term !== 0 && $this->region == 1) {
                $groups = Group::with('users', 'region', 'category')
                    ->where('group_category_id', '=', $this->term)
                    ->paginate(4);
            } elseif ($this->term == 0 && $this->region !== 1) {
                $groups = Group::with('users', 'region', 'category')
                    ->where('region_id', '=', $this->region)
                    ->paginate(4);
            } else {
                $groups = Group::with('users', 'region', 'category')
                    ->where('group_category_id', '=', $this->term)
                    ->where('region_id', '=', $this->region)
                    ->paginate(4);
            }
        } else {
            sleep(1);
            $groups = Group::search($this->search)->with('users', 'region', 'category')->paginate(4);
        }

        if(count($groups) < 4) {
            $groups = Group::with('users', 'category')->paginate(4);
        }

        $categories = GroupCategory::orderBy('sort_id', 'asc')->get();
        $regions = Region::all();

        return view('livewire.home-page', [
            'groups' => $groups,
            'regions' => $regions,
            'categories' => $categories
        ]);
    }
}
