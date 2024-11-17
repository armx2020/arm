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
    public $sort = "updated_at|asc";
    public $view = 1;

    public function mount(Request $request, $regionCode = null)
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

        if ($this->region == 1) {
            $companies = Company::orderBy($exp[0], $exp[1])->where('activity', 1)->paginate(12);
            $recommendations = [];
        } else {
            $companies = Company::with('region')
                ->where('activity', 1)
                ->where('region_id', '=', $this->region)
                ->orderBy($exp[0], $exp[1])
                ->paginate(12);

            $recommendations = Company::with('region')
                ->where('activity', 1)
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })->limit(3)->get();
        }

        $regions = Region::all();

        return view('livewire.select-companies', [
            'companies' => $companies,
            'regions' => $regions,
            'region' => $this->region,
            'recommendations' => $recommendations,
        ]);
    }
}
