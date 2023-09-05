<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupCategoryRequest;
use App\Models\GroupCategory;
use App\Services\GroupCategoryService;

class GroupCategoryController extends Controller
{
    public function __construct(private GroupCategoryService $groupCategoryService)
    {
        $this->groupCategoryService = $groupCategoryService;
    }

    public function index()
    {
        return view('admin.groupcategory.index');
    }

    public function create()
    {
        return view('admin.groupcategory.create');
    }

    public function store(GroupCategoryRequest $request)
    {
        $this->groupCategoryService->store($request);

        return redirect()->route('admin.groupCategory.index')->with('success', 'The category added');
    }

    public function show(string $id)
    {
        $category = GroupCategory::withcount('groups')->find($id);

        if(empty($category)) {
            return redirect()->route('admin.groupCategory.index')->with('alert', 'The category not found');
        }

        return view('admin.groupcategory.show', ['category' => $category]);
    }

    public function edit(string $id)
    {
        $category = GroupCategory::find($id);

        if(empty($category)) {
            return redirect()->route('admin.groupCategory.index')->with('alert', 'The category not found');
        }

        return view('admin.groupcategory.edit', ['category' => $category]);
    }

    public function update(GroupCategoryRequest $request, string $id)
    {
        $category = GroupCategory::find($id);

        if(empty($category)) {
            return redirect()->route('admin.groupCategory.index')->with('alert', 'The category not found');
        }

        $category = $this->groupCategoryService->update($request, $category);

        return redirect()->route('admin.groupCategory.show', ['groupCategory'=> $category->id])
                        ->with('success', 'The category updated');
    }


    public function destroy(string $id)
    {
        $category = GroupCategory::find($id);

        if(empty($category)) {
            return redirect()->route('admin.groupCategory.index')->with('alert', 'The category not found');
        }

        $category->delete();

        return redirect()->route('admin.groupCategory.index')->with('success', 'The category deleted');
    }
}
