<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Models\Region;
use App\Models\Work;

class SelectWorks extends BaseSelect
{
    use WithPagination;

    public $category = 'Вакансии';

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $entityShowRout = 'works.show';
        $exp = explode('|', $this->sort);

        $works = Work::query()->active()->orderBy($exp[0], $exp[1]);
        $recommendations = [];

        if ($this->category == 'Вакансии') {
            $works = $works->vacancy();
        } else {
            $works = $works->resume()->with('parent');
        }

        if ($this->region !== 1) {
            $works = $works
                ->where('region_id', '=', $this->region);

            $recommendations = Work::query()->active()
                ->orderBy($exp[0], $exp[1])
                ->with('region')
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })
                ->limit(3)
                ->get();
        }

        $works = $works->paginate(12);

        $regions = Region::all();

        return view('livewire.select-works', [
            'entityShowRout' => $entityShowRout,
            'entities' => $works,
            'regions' => $regions,
            'region' => $this->region,
            'recommendations' => $recommendations,
            'position' => $this->position,
        ]);
    }
}
