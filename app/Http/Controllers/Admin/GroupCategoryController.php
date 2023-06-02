<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupCategory;
use Illuminate\Http\Request;

class GroupCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = GroupCategory::withCount('groups')->paginate(20);

        return view('admin.groupcategory.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.groupcategory.create');
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

        $category = new GroupCategory();

        $category->name = $request->name;
        $category->sort_id = $request->sort_id;

        $category->save();

        return redirect()->route('admin.groupCategory.index')->with('success', 'The category added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = GroupCategory::with('groups')->findOrFail($id);

        return view('admin.groupcategory.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = GroupCategory::findOrFail($id);

        return view('admin.groupcategory.edit', ['category' => $category]);
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

        $category = GroupCategory::findOrFail($id);

        $category->name = $request->name;
        $category->sort_id = $request->sort_id;

        $category->update();

        return redirect()->route('admin.groupCategory.index')->with('success', 'The category saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = GroupCategory::findOrFail($id);

        $category->delete();

        return redirect()->route('admin.groupCategory.index')->with('success', 'The category deleted');
    }
}
