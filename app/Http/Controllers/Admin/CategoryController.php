<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends BaseAdminController
{
    public function __construct(private CategoryService $categoryService)
    {
        parent::__construct();
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('admin.category.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        return view('admin.category.create', ['menu' => $this->menu]);
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryService->store($request);

        return redirect()->route('admin.Category.index')->with('success', 'The category added');
    }

    public function show(string $id)
    {
        $category = Category::withcount('groups')->find($id);

        if(empty($category)) {
            return redirect()->route('admin.Category.index')->with('alert', 'The category not found');
        }

        return view('admin.category.show', ['category' => $category, 'menu' => $this->menu]);
    }

    public function edit(string $id)
    {
        $category = Category::find($id);

        if(empty($category)) {
            return redirect()->route('admin.Category.index')->with('alert', 'The category not found');
        }

        return view('admin.category.edit', ['category' => $category, 'menu' => $this->menu]);
    }

    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::find($id);

        if(empty($category)) {
            return redirect()->route('admin.category.index')->with('alert', 'The category not found');
        }

        $category = $this->categoryService->update($request, $category);

        return redirect()->route('admin.category.show', ['category'=> $category->id])
                        ->with('success', 'The category updated');
    }


    public function destroy(string $id)
    {
        $category = Category::find($id);

        if(empty($category)) {
            return redirect()->route('admin.category.index')->with('alert', 'The category not found');
        }

        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'The category deleted');
    }
}
