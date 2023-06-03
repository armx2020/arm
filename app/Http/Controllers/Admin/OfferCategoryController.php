<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfferCategory;
use Illuminate\Http\Request;

class OfferCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = OfferCategory::withCount('offers')->latest()->paginate(20);

        return view('admin.offercategory.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.offercategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'sort_id' => ['required', 'integer',],
        ]);

        $category = new OfferCategory();

        $category->name = $request->name;
        $category->sort_id = $request->sort_id;

        $category->save();

        return redirect()->route('admin.offerCategory.index')->with('success', 'The category added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = OfferCategory::with('offers')->findOrFail($id);

        return view('admin.offercategory.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = OfferCategory::findOrFail($id);

        return view('admin.offercategory.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'sort_id' => ['required', 'integer',],
        ]);

        $category = OfferCategory::findOrFail($id);

        $category->name = $request->name;
        $category->sort_id = $request->sort_id;

        $category->update();

        return redirect()->route('admin.offerCategory.show', ['offerCategory'=> $category->id])
                        ->with('success', 'The category saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = OfferCategory::findOrFail($id);

        $category->delete();

        return redirect()->route('admin.offerCategory.index')->with('success', 'The category deleted');
    }
}
