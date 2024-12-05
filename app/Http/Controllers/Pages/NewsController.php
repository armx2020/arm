<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\BaseController;
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
        return view('pages.news.index', [
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
        return view('pages.news.show', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'entity'   => $news,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }
}
