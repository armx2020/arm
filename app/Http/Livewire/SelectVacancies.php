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
        $reg = Region::where('InEnglish', '=', $request->session()->get('region'))->First();

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
            } else {
                $works = Vacancy::with('region')
                    ->where('region_id', '=', $this->region)
                    ->paginate(12);
            }
        } else {
                $typeName = 'РЕЗЮМЕ';
            if ($this->region == 1) {
                $works = Resume::with('user')->paginate(12); 
            } else {
                $works = Resume::with('user', 'region')
                    ->where('region_id', '=', $this->region)
                    ->paginate(12);
            }
        }
        $regions = Region::all();

        return view('livewire.select-vacancies', [
            'works' => $works,
            'regions' => $regions,
            'region' => $this->region,
            'typeName' => $typeName
        ]);
    }
}
