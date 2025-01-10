<?php

namespace App\Livewire;

use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Region;
use Livewire\WithPagination;

class SelectNews extends BaseSelect
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $entityShowRout = 'news.show';
        $exp = explode('|', $this->sort);

        $news = News::query()->active()->orderBy($exp[0], $exp[1]);
        $recommendations = [];

        if ($this->region !== 1) {
            $news = $news
                ->where('region_id', '=', $this->region);

            $recommendations = News::query()->active()
                ->whereNot(function ($query) {
                    $query->where('region_id', '=', $this->region);
                })
                ->limit(3)
                ->get();
        }
        $news = $news->paginate($this->quantityOfDisplayed);
        $regions = Region::all();

        return view('livewire.select-news', [
            'entityShowRout' => $entityShowRout,
            'entities' => $news,
            'regions' => $regions,
            'region' => $this->region,
            'recommendations' => $recommendations,
            'position' => $this->position,
        ]);
    }
}
