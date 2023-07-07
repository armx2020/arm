<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        return view('admin.news.index');
    }

    public function create()
    {
        return view('admin.news.create');
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

        $news = new News();

        $city = City::with('region')->findOrFail($request->city);

        $news->name = $request->name;
        $news->date = $request->date;
        $news->city_id = $request->city;
        $news->region_id = $city->region->id; // add to region key
        $news->description = $request->description;

        if ($request->image) {
            Storage::delete('public/'.$news->image);
            $news->image = $request->file('image')->store('news', 'public');
        }
        if ($request->image1) {
            Storage::delete('public/'.$news->image1);
            $news->image1 = $request->file('image1')->store('news', 'public');
        }
        if ($request->image2) {
            Storage::delete('public/'.$news->image2);
            $news->image2 = $request->file('image2')->store('news', 'public');
        }
        if ($request->image3) {
            Storage::delete('public/'.$news->image3);
            $news->image3 = $request->file('image3')->store('news', 'public');
        }
        if ($request->image4) {
            Storage::delete('public/'.$news->image4);
            $news->image4 = $request->file('image4')->store('news', 'public');
        }

        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'The news added');
    }

    public function show(string $id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.show', ['news' => $news]);
    }

    public function edit(string $id)
    {
        $news = News::findOrFail($id);
        
        return view('admin.news.edit', ['news' => $news]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'image' => ['image', 'max:2048'],
            'image1' => ['image', 'max:2048'],
            'image2' => ['image', 'max:2048'],
            'image3' => ['image', 'max:2048'],
            'image4' => ['image', 'max:2048'],
        ]);

        $news = News::findOrFail($id);
        $city = City::with('region')->findOrFail($request->city);

        $news->name = $request->name;
        $news->date = $request->date;
        $news->city_id = $request->city;
        $news->region_id = $city->region->id; // add to region key
        $news->description = $request->description;

        if ($request->image) {
            Storage::delete('public/'.$news->image);
            $news->image = $request->file('image')->store('news', 'public');
        }
        if ($request->image1) {
            Storage::delete('public/'.$news->image1);
            $news->image1 = $request->file('image1')->store('news', 'public');
        }
        if ($request->image2) {
            Storage::delete('public/'.$news->image2);
            $news->image2 = $request->file('image2')->store('news', 'public');
        }
        if ($request->image3) {
            Storage::delete('public/'.$news->image3);
            $news->image3 = $request->file('image3')->store('news', 'public');
        }
        if ($request->image4) {
            Storage::delete('public/'.$news->image4);
            $news->image4 = $request->file('image4')->store('news', 'public');
        }

        $news->update();
        
        return redirect()->route('admin.news.index')->with('success', 'The news saved');
    }

    public function destroy(string $id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'The news deleted');

    }
}
