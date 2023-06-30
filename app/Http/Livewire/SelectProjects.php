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

    public function mount(Request $request)
    {
        $reg = Region::where('InEnglish', '=', $request->session()->get('region'))->First();

        if (empty($reg)) {
            $this->region = 1;
        } else {
            $this->region = $reg->id;
        }
    }

    public function render()
    {
        if ($this->region == 1) {
            if ($this->term == 2) {
                $projects = Project::paginate(12);
            } else {
                $projects = Project::where('activity', '=', $this->term)->paginate(12);
            }
        } else {
            if ($this->term == 2) {
                $projects = Project::with('region')
                            ->where('region_id', '=', $this->region)
                            ->paginate(12);
            } else {
                $projects = Project::with('region')
                        ->where('region_id', '=', $this->region)
                        ->where('activity', '=', $this->term)
                        ->paginate(12);
            }
        }

        $regions = Region::all();

        return view('livewire.select-projects', [
            'projects' => $projects,
            'regions' => $regions,
            'region' => $this->region
        ]);
    }
}
