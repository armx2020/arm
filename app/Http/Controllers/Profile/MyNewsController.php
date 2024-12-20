<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\BaseController;
use App\Models\City;
use App\Models\Company;
use App\Models\Group;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class MyNewsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $entitiesName = 'mynews';
        $entityName = 'mynews';

        $news = Auth::user()->mynews()->paginate(10);

        return view('profile.pages.news.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId'),
            'entities' => $news,
            'entitiesName' => $entitiesName,
            'entityName' => $entityName,
        ]);
    }

    public function create(Request $request)
    {
        $companies = Company::where('user_id', '=', Auth::user()->id)->get();
        $groups = Group::where('user_id', '=', Auth::user()->id)->get();

        return view('profile.pages.news.create', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'companies' => $companies,
            'groups'    => $groups,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['image'],
            'image1' => ['image'],
            'image2' => ['image'],
            'image3' => ['image'],
            'image4' => ['image'],
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
        $news->user_id = Auth::user()->id;

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
            $news->parent_type = 'App\Models\User';
            $news->parent_id = 1;
        }

        if ($request->image) {
            $news->image = $request->file('image')->store('news', 'public');
            Image::make('storage/' . $news->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image1) {
            $news->image1 = $request->file('image1')->store('news', 'public');
            Image::make('storage/' . $news->image1)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image2) {
            $news->image2 = $request->file('image2')->store('news', 'public');
            Image::make('storage/' . $news->image2)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image3) {
            $news->image3 = $request->file('image3')->store('news', 'public');
            Image::make('storage/' . $news->image3)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image4) {
            $news->image4 = $request->file('image4')->store('news', 'public');
            Image::make('storage/' . $news->image4)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $news->save();

        return redirect()->route('mynews.index')->with('success', 'Новость "' . $news->name . '" добавлена');
    }

    public function show(Request $request, $id)
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
                return view('profile.pages.news.show', [
                    'region'   => $request->session()->get('region'),
                    'regions' => $this->regions,
                    'news'   => $news,
                    'regionCode' => $request->session()->get('regionId')
                ]);
            } else {
                return redirect()->route('mynews.index')->with('alert', 'Новость не найдена');
            }
        }
    }

    public function edit(Request $request, $id)
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
                $companies = Company::where('user_id', '=', Auth::user()->id)->get();
                $groups = Group::where('user_id', '=', Auth::user()->id)->get();

                return view('profile.pages.news.edit', [
                    'region'   => $request->session()->get('region'),
                    'regions' => $this->regions,
                    'news'  => $news,
                    'companies' => $companies,
                    'groups'    => $groups,
                    'regionCode' => $request->session()->get('regionId')
                ]);
            } else {
                return redirect()->route('mynews.index')->with('alert', 'Новость не найдена');
            }
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['image'],
            'image1' => ['image'],
            'image2' => ['image'],
            'image3' => ['image'],
            'image4' => ['image'],
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
                    $news->parent_type = 'App\Models\User';
                    $news->parent_id = 1;
                }

                if ($request->image_remove == 'delete') {
                    Storage::delete('public/' . $news->image);
                    $news->image = null;
                }

                if ($request->image_remove1 == 'delete') {
                    Storage::delete('public/' . $news->image1);
                    $news->image1 = null;
                }

                if ($request->image_remove2 == 'delete') {
                    Storage::delete('public/' . $news->image2);
                    $news->image2 = null;
                }

                if ($request->image_remove3 == 'delete') {
                    Storage::delete('public/' . $news->image3);
                    $news->image3 = null;
                }

                if ($request->image_remove4 == 'delete') {
                    Storage::delete('public/' . $news->image4);
                    $news->image4 = null;
                }

                if ($request->image) {
                    Storage::delete('public/' . $news->image);
                    $news->image = $request->file('image')->store('news', 'public');
                    Image::make('storage/' . $news->image)->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save();
                }
                if ($request->image1) {
                    Storage::delete('public/' . $news->image1);
                    $news->image1 = $request->file('image1')->store('news', 'public');
                    Image::make('storage/' . $news->image1)->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save();
                }
                if ($request->image2) {
                    Storage::delete('public/' . $news->image2);
                    $news->image2 = $request->file('image2')->store('news', 'public');
                    Image::make('storage/' . $news->image2)->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save();
                }
                if ($request->image3) {
                    Storage::delete('public/' . $news->image3);
                    $news->image3 = $request->file('image3')->store('news', 'public');
                    Image::make('storage/' . $news->image3)->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save();
                }
                if ($request->image4) {
                    Storage::delete('public/' . $news->image4);
                    $news->image4 = $request->file('image4')->store('news', 'public');
                    Image::make('storage/' . $news->image4)->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save();
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
