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
    public $sort = "updated_at|asc";
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

        if ($this->type == 0) {
                $typeName = 'вакансий';
            if ($this->region == 1) {
                $works = Vacancy::orderBy($exp[0], $exp[1])->paginate(12);
                $recommendations = [];
            } else {
                $works = Vacancy::with('region', 'parent')
                    ->where('region_id', '=', $this->region)
                    ->orderBy($exp[0], $exp[1])
                    ->paginate(12);
                $recommendations = Vacancy::with('region', 'parent')
                    ->whereNot(function ($query) {
                        $query->where('region_id', '=', $this->region);
                    })->limit(3)->get();
            }
        } else {
                $typeName = 'резюме';
            if ($this->region == 1) {
                $works = Resume::with('user')->orderBy($exp[0], $exp[1])->paginate(12);
                $recommendations = []; 
            } else {
                $works = Resume::with('user', 'region')
                    ->where('region_id', '=', $this->region)
                    ->orderBy($exp[0], $exp[1])
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
