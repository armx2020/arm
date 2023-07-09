<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\GroupCategory;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;


class SelectGroups extends Component
{
    use WithPagination;

    public $term = 0;
    public $region;

    public function mount(Request $request)
    {
        $reg = Region::where('InEnglish', '=', $request->session()->get('region'))->First();
        
        if(empty($reg)){
            $this->region = 1;
        } else {
            $this->region = $reg->id;
        }     
    }

    public function render()
    {
        if ($this->term == 0 && $this->region == 1) {
            $groups = Group::with('users')->paginate(12);
        } elseif ($this->term !== 0 && $this->region == 1) { 
            $groups = Group::with('users', 'region')
                ->where('group_category_id', '=', $this->term)
                ->paginate(12);
        } elseif ($this->term == 0 && $this->region !== 1) {
            $groups = Group::with('users', 'region')
                ->where('region_id', '=', $this->region)
                ->paginate(12);
        } else {
            $groups = Group::with('users', 'region')
                ->where('group_category_id', '=', $this->term)
                ->where('region_id', '=', $this->region)
                ->paginate(12); 
        }

        $categories = GroupCategory::orderBy('sort_id', 'asc')->get();
        $regions = Region::all();
  
        return view('livewire.select-groups', [
                                                'groups' => $groups,
                                                'categories' => $categories,
                                                'regions' => $regions,
                                                'region' => $this->region
                    ]);
    }
}