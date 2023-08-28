<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        return view('pages.news.news', [
            'city'   => $request->session()->get('city'),
            'cities' => $cities
        ]);
    }

    public function show(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $news = News::with('parent')->find($id);

        if (empty($news)) {
            return redirect()->route('news.index')->with('alert', 'Новость не найдена');
        }
        return view('pages.news.new', [
            'city'   => $request->session()->get('city'),
            'news'   => $news,
            'cities' => $cities
        ]);
    }
}
