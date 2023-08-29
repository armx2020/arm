<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Region;

class SelectProjects extends Component
{
    use WithPagination;

    public $region;
    public $term = 2;
    public $sort = "created_at|asc";
    public $view = 1;

    public function mount(Request $request)
    {
        $reg = Region::where('name', '=', $request->session()->get('region'))->First();

        if (empty($reg)) {
            $this->region = 1;
        } else {
            $this->region = $reg->id;
        }
    }

    public function render()
    {
        $exp = explode('|', $this->sort);

        $recommendations = [];

        if ($this->region == 1) {
            if ($this->term == 2) {
                $projects = Project::orderBy($exp[0], $exp[1])->paginate(12);
            } else {
                $projects = Project::where('activity', '=', $this->term)
                    ->orderBy($exp[0], $exp[1])
                    ->paginate(12);
            }
        } else {
            if ($this->term == 2) {
                $projects = Project::with('region')
                    ->where('region_id', '=', $this->region)
                    ->orderBy($exp[0], $exp[1])
                    ->paginate(12);

                $recommendations = Project::with('region')
                    ->whereNot(function ($query) {
                        $query->where('region_id', '=', $this->region);
                    })->limit(3)->get();
            } else {
                $projects = Project::with('region')
                    ->where('region_id', '=', $this->region)
                    ->where('activity', '=', $this->term)
                    ->orderBy($exp[0], $exp[1])
                    ->paginate(12);

                $recommendations = Project::with('region')
                    ->where('activity', '=', $this->term)
                    ->whereNot(function ($query) {
                        $query->where('region_id', '=', $this->region);
                    })->limit(3)->get();
            }
        }

        $regions = Region::all();

        return view('livewire.select-projects', [
            'projects' => $projects,
            'regions' => $regions,
            'recommendations' => $recommendations,
            'region' => $this->region
        ]);
    }
}
