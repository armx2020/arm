<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use App\Models\Region;

class SelectCompanies extends Component
{
    use WithPagination;

    public $region;

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
                $companies = Company::paginate(12);
        } else {
                $companies = Company::with('region')
                            ->where('region_id', '=', $this->region)
                            ->paginate(12);
        }

        $regions = Region::all();

        return view('livewire.select-companies', [
            'companies' => $companies,
            'regions' => $regions,
            'region' => $this->region
        ]);
    }
}