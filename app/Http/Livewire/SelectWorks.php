<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Work;

class SelectWorks extends Component
{
    use WithPagination;

    public $region;
    public $type = 0;
    public $sort = "updated_at|desc";
    public $view = 1;

    public function mount(Request $request, $regionCode = null)
    {
        if($regionCode) {
            $reg = Region::where('code', '=', $regionCode)->First();
        } else {
            $reg = Region::where('name', '=', $request->session()->get('region'))->First();
        }

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
                $works = Work::vacancy()->orderBy($exp[0], $exp[1])->where('activity', 1)->paginate(12);
                $recommendations = [];
            } else {
                $works = Work::vacancy()->with('region', 'parent')
                    ->where('activity', 1)
                    ->where('region_id', '=', $this->region)
                    ->orderBy($exp[0], $exp[1])
                    ->paginate(12);
                $recommendations = Work::vacancy()->with('region', 'parent')
                    ->where('activity', 1)
                    ->whereNot(function ($query) {
                        $query->where('region_id', '=', $this->region);
                    })->limit(3)->get();
            }
        } else {
            $typeName = 'резюме';
            if ($this->region == 1) {
                $works = Work::resume()->with('parent')->where('activity', 1)->orderBy($exp[0], $exp[1])->paginate(12);
                $recommendations = [];
            } else {
                $works = Work::resume()->with('parent', 'region')
                    ->where('activity', 1)
                    ->where('region_id', '=', $this->region)
                    ->orderBy($exp[0], $exp[1])
                    ->paginate(12);
                $recommendations = Work::resume()->with('parent', 'region')
                    ->where('activity', 1)
                    ->whereNot(function ($query) {
                        $query->where('region_id', '=', $this->region);
                    })->limit(3)->get();
            }
        }
        $regions = Region::all();

        return view('livewire.select-works', [
            'works' => $works,
            'regions' => $regions,
            'region' => $this->region,
            'recommendations' => $recommendations,
            'typeName' => $typeName
        ]);
    }
}
