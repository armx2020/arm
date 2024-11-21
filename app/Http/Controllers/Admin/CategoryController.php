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

        return redirect()->route('admin.category.index')->with('success', 'Категория добавлена');
    }

    public function show(string $id)
    {
        $category = Category::withcount('groups')->find($id);

        if(empty($category)) {
            return redirect()->route('admin.сategory.index')->with('alert', 'Категория не найдена');
        }

        return view('admin.category.edit', ['category' => $category, 'menu' => $this->menu]);
    }

    public function edit(string $id)
    {
        $category = Category::find($id);

        if(empty($category)) {
            return redirect()->route('admin.сategory.index')->with('alert', 'Категория не найдена');
        }

        return view('admin.category.edit', ['category' => $category, 'menu' => $this->menu]);
    }

    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::find($id);

        if(empty($category)) {
            return redirect()->route('admin.category.index')->with('alert', 'Категория не найдена');
        }

        $category = $this->categoryService->update($request, $category);

        return redirect()->route('admin.category.edit', ['category'=> $category->id])
                        ->with('success', 'Категория сохранена');
    }


    public function destroy(string $id)
    {
        $category = Category::find($id);

        if(empty($category)) {
            return redirect()->route('admin.category.index')->with('alert', 'Категория не найдена');
        }

        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Категория удалена');
    }
}
