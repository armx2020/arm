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

        if ($this->region == 1) {
            $news = News::orderBy($exp[0], $exp[1])->paginate(12);
            $recommendations = [];
        } else {
            $news = News::with('region')
                ->where('region_id', '=', $this->region)
                ->orderBy($exp[0], $exp[1])
                ->paginate(12);

            $recommendations = News::with('region')
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
