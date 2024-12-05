<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\Region;

class SelectProjects extends BaseSelect
{
    public $category = 'Все';

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $entityShowRout = 'projects.show';
        $exp = explode('|', $this->sort);

        $projects = Project::query()->with('region')->orderBy($exp[0], $exp[1]);
        $recommendations = Project::query()->with('region')->orderBy($exp[0], $exp[1]);

        if ($this->region !== 1) {
            $projects = $projects->where('region_id', '=', $this->region);

            $recommendations = $recommendations
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                });
        }

        if ($this->category !== 'Все') {
            $projects = $projects->where('activity', '=', $this->category);
            $recommendations = $recommendations->where('activity', '=', $this->category);
        }

        $projects = $projects->paginate($this->quantityOfDisplayed);
        $recommendations = $recommendations->limit(3)->get();

        $regions = Region::all();

        return view('livewire.select-projects', [
            'entityShowRout' => $entityShowRout,
            'entities' => $projects,
            'regions' => $regions,
            'region' => $this->region,
            'recommendations' => $recommendations,
            'position' => $this->position,
        ]);
    }
}
