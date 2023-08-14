<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\Group;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyNewsController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $groups = Group::where('user_id', '=', Auth::user()->id)->with('news')->get();
        $companies = Company::where('user_id', '=', Auth::user()->id)->with('news')->get();
        $news = Auth::user()->news;

        return view('profile.pages.news.index', [
            'city'   => $request->session()->get('city'),
            'groups' => $groups,
            'companies' => $companies,
            'newsFromUser' => $news,
            'cities' => $cities
        ]);
    }

    public function create(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $companies = Company::where('user_id', '=', Auth::user()->id)->get();
        $groups = Group::where('user_id', '=', Auth::user()->id)->get();

        return view('profile.pages.news.create', [
            'city'      => $request->session()->get('city'),
            'companies' => $companies,
            'groups'    => $groups,
            'cities'    => $cities
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'image' => ['image', 'max:2048'],
            'image1' => ['image', 'max:2048'],
            'image2' => ['image', 'max:2048'],
            'image3' => ['image', 'max:2048'],
            'image4' => ['image', 'max:2048'],
        ]);

        $city = City::with('region')->find($request->news_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $news = new News();

        $news->name = $request->name;
        $news->description = $request->description;
        $news->date = $request->date;
        $news->city_id = $request->news_city;
        $news->region_id = $city->region->id;

        $parent = $request->parent;
        $parent_explode = explode('|', $parent);

        if ($parent_explode[0] == 'User') {
            $news->parent_type = 'App\Models\User';
            $news->parent_id = $parent_explode[1];
        } elseif ($parent_explode[0] == 'Company') {
            $news->parent_type = 'App\Models\Company';
            $news->parent_id = $parent_explode[1];
        } elseif ($parent_explode[0] == 'Group') {
            $news->parent_type = 'App\Models\Group';
            $news->parent_id = $parent_explode[1];
        } else {
            $news->parent_type = 'App\Models\Admin';
            $news->parent_id = 1;
        }


        if ($request->image) {
            $news->image = $request->file('image')->store('news', 'public');
        }
        if ($request->image1) {
            $news->image1 = $request->file('image1')->store('news', 'public');
        }
        if ($request->image2) {
            $news->image2 = $request->file('image2')->store('news', 'public');
        }
        if ($request->image3) {
            $news->image3 = $request->file('image3')->store('news', 'public');
        }
        if ($request->image4) {
            $news->image4 = $request->file('image4')->store('news', 'public');
        }

        $news->save();

        return redirect()->route('mynews.index')->with('success', 'Новость "' . $news->name . '" добавлена');
    }

    public function show(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $news = News::with('parent')->find($id);

        if (empty($news)) {
            return redirect()->route('mynews.index')->with('alert', 'Новость не найдена');
        } else {
            if (
                ($news->parent_type == 'App\Models\User' && $news->parent_id == Auth::user()->id) ||
                ($news->parent_type == 'App\Models\Company' && $news->parent->user_id == Auth::user()->id) ||
                ($news->parent_type == 'App\Models\Group' && $news->parent->user_id == Auth::user()->id)
            ) {
                return view('profile.pages.news.show', [
                    'city'   => $request->session()->get('city'),
                    'news'   => $news,
                    'cities' => $cities
                ]);
            } else {
                return redirect()->route('mynews.index')->with('alert', 'Новость не найдена');
            }
        }
    }

    public function edit(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $news = News::with('parent')->find($id);

        if (empty($news)) {
            return redirect()->route('mynews.index')->with('alert', 'Новость не найдена');
        } else {
            if (
                ($news->parent_type == 'App\Models\User' && $news->parent_id == Auth::user()->id) ||
                ($news->parent_type == 'App\Models\Company' && $news->parent->user_id == Auth::user()->id) ||
                ($news->parent_type == 'App\Models\Group' && $news->parent->user_id == Auth::user()->id)
            ) {
                return view('profile.pages.news.edit', [
                    'city'   => $request->session()->get('city'),
                    'news'  => $news,
                    'cities' => $cities
                ]);
            } else {
                return redirect()->route('mynews.index')->with('alert', 'Новость не найдена');
            }
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'image' => ['image', 'max:2048'],
            'image1' => ['image', 'max:2048'],
            'image2' => ['image', 'max:2048'],
            'image3' => ['image', 'max:2048'],
            'image4' => ['image', 'max:2048'],
        ]);

        $city = City::with('region')->find($request->news_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $news = News::with('parent')->find($id);

        if (empty($news)) {
            return redirect()->route('mynews.index')->with('alert', 'Новость не найдена');
        } else {
            if (
                ($news->parent_type == 'App\Models\User' && $news->parent_id == Auth::user()->id) ||
                ($news->parent_type == 'App\Models\Company' && $news->parent->user_id == Auth::user()->id) ||
                ($news->parent_type == 'App\Models\Group' && $news->parent->user_id == Auth::user()->id)
            ) {
                $news->name = $request->name;
                $news->description = $request->description;
                $news->date = $request->date;
                $news->city_id = $request->news_city;
                $news->region_id = $city->region->id;

                if ($request->image) {
                    Storage::delete('public/' . $news->image);
                    $news->image = $request->file('image')->store('news', 'public');
                }
                if ($request->image1) {
                    Storage::delete('public/' . $news->image1);
                    $news->image1 = $request->file('image1')->store('news', 'public');
                }
                if ($request->image2) {
                    Storage::delete('public/' . $news->image2);
                    $news->image2 = $request->file('image2')->store('news', 'public');
                }
                if ($request->image3) {
                    Storage::delete('public/' . $news->image3);
                    $news->image3 = $request->file('image3')->store('news', 'public');
                }
                if ($request->image4) {
                    Storage::delete('public/' . $news->image4);
                    $news->image4 = $request->file('image4')->store('news', 'public');
                }

                $news->update();

                return redirect()->route('mynews.index')->with('success', 'Новость "' . $news->name . '" обновлена');
            } else {
                return redirect()->route('mynews.index')->with('alert', 'Новость не найдена');
            }
        }
    }

    public function destroy($id)
    {
        $news = News::with('parent')->find($id);

        if (empty($news)) {
            return redirect()->route('mynews.index')->with('alert', 'Новость не найдена');
        } else {
            if (
                ($news->parent_type == 'App\Models\User' && $news->parent_id == Auth::user()->id) ||
                ($news->parent_type == 'App\Models\Company' && $news->parent->user_id == Auth::user()->id) ||
                ($news->parent_type == 'App\Models\Group' && $news->parent->user_id == Auth::user()->id)
            ) {

                if ($news->image) {
                    Storage::delete('public/' . $news->image);
                }

                $news->delete();

                return redirect()->route('mynews.index')->with('success', 'Новость удалена');
            } else {
                return redirect()->route('mynews.index')->with('alert', 'Новость не найдена');
            }
        }
    }
}
