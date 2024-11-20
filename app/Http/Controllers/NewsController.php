<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, $regionCode = null)
    {
        return view('pages.news.news', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $regionCode
        ]);
    }

    public function show(Request $request, $id)
    {
        $news = News::with('parent')->find($id);

        if (empty($news)) {
            return redirect()->route('news.index')->with('alert', 'Новость не найдена');
        }
        return view('pages.news.new', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'news'   => $news,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }
}
