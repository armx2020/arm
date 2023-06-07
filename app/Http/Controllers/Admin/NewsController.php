<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::latest()->paginate(20);

        return view('admin.news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'description' => ['string'],
            'image' => ['image', 'max:2048'],
            'image1' => ['image', 'max:2048'],
            'image2' => ['image', 'max:2048'],
            'image3' => ['image', 'max:2048'],
            'image4' => ['image', 'max:2048'],
        ]);

        $news = new News();

        $news->name = $request->name;
        $news->date = $request->date;
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.show', ['news' => $news]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = News::findOrFail($id);
        
        return view('admin.news.edit', ['news' => $news]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'description' => ['string'],
            'image' => ['image', 'max:2048'],
            'image1' => ['image', 'max:2048'],
            'image2' => ['image', 'max:2048'],
            'image3' => ['image', 'max:2048'],
            'image4' => ['image', 'max:2048'],
        ]);

        $news = News::findOrFail($id);

        $news->name = $request->name;
        $news->date = $request->date;
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'The news deleted');

    }
}
