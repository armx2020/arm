<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupCategory;
use Illuminate\Http\Request;

class GroupCategoryController extends Controller
{
    public function index()
    {
        return view('admin.groupcategory.index');
    }

    public function create()
    {
        return view('admin.groupcategory.create');
    }

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

    public function show(string $id)
    {
        $category = GroupCategory::withcount('groups')->findOrFail($id);

        return view('admin.groupcategory.show', ['category' => $category]);
    }

    public function edit(string $id)
    {
        $category = GroupCategory::findOrFail($id);

        return view('admin.groupcategory.edit', ['category' => $category]);
    }

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

        return redirect()->route('admin.groupCategory.show', ['groupCategory'=> $category->id])
                        ->with('success', 'The category saved');
    }


    public function destroy(string $id)
    {
        $category = GroupCategory::findOrFail($id);

        $category->delete();

        return redirect()->route('admin.groupCategory.index')->with('success', 'The category deleted');
    }
}