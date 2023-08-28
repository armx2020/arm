<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Resume;
use App\Models\Vacancy;

class SelectVacancies extends Component
{
    use WithPagination;

    public $region;
    public $type = 0;

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
        if ($this->type == 0) {
                $typeName = 'ВАКАНСИЙ';
            if ($this->region == 1) {
                $works = Vacancy::paginate(12);
                $recommendations = [];
            } else {
                $works = Vacancy::with('region', 'parent')
                    ->where('region_id', '=', $this->region)
                    ->paginate(12);
                $recommendations = Vacancy::with('region', 'parent')
                    ->whereNot(function ($query) {
                        $query->where('region_id', '=', $this->region);
                    })->limit(3)->get();
            }
        } else {
                $typeName = 'РЕЗЮМЕ';
            if ($this->region == 1) {
                $works = Resume::with('user')->paginate(12);
                $recommendations = []; 
            } else {
                $works = Resume::with('user', 'region')
                    ->where('region_id', '=', $this->region)
                    ->paginate(12);
                $recommendations = Resume::with('user', 'region')
                    ->whereNot(function ($query) {
                        $query->where('region_id', '=', $this->region);
                    })->limit(3)->get();
            }
        }
        $regions = Region::all();

        return view('livewire.select-vacancies', [
            'works' => $works,
            'regions' => $regions,
            'region' => $this->region,
            'recommendations' => $recommendations,
            'typeName' => $typeName
        ]);
    }
}
