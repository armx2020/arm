<?php

namespace App\Http\Livewire;

use App\Models\News;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Region;
use Livewire\WithPagination;

class SelectNews extends Component
{
    use WithPagination;

    public $region;
    public $sort = "updated_at|desc";
    public $view = 2;

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

        if ($this->region == 1) {
            $news = News::orderBy($exp[0], $exp[1])->where('activity', 1)->paginate(12);
            $recommendations = [];
        } else {
            $news = News::with('region')
                ->where('activity', 1)
                ->where('region_id', '=', $this->region)
                ->orderBy($exp[0], $exp[1])
                ->paginate(12);

            $recommendations = News::with('region')
                ->where('activity', 1)
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })->limit(3)->get();
        }

        $regions = Region::all();

        return view('livewire.select-news', [
            'news' => $news,
            'regions' => $regions,
            'recommendations' => $recommendations,
            'region' => $this->region
        ]);
    }
}
