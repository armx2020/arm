<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfferCategory;
use Illuminate\Http\Request;

class OfferCategoryController extends Controller
{
    public function index()
    {
        return view('admin.offercategory.index');
    }

    public function create()
    {
        return view('admin.offercategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'sort_id' => ['required', 'integer'],
        ]);

        $category = new OfferCategory();

        $category->name = $request->name;
        $category->sort_id = $request->sort_id;

        $category->save();

        return redirect()->route('admin.offerCategory.index')->with('success', 'The category added');
    }

    public function show(string $id)
    {
        $category = OfferCategory::withcount('offers')->findOrFail($id);

        return view('admin.offercategory.show', ['category' => $category]);
    }

    public function edit(string $id)
    {
        $category = OfferCategory::findOrFail($id);

        return view('admin.offercategory.edit', ['category' => $category]);
    }

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

    public function destroy(string $id)
    {
        $category = OfferCategory::findOrFail($id);

        $category->delete();

        return redirect()->route('admin.offerCategory.index')->with('success', 'The category deleted');
    }
}
