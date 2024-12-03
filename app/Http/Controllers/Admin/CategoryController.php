<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\CategoryAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends BaseAdminController
{
    public function __construct(private CategoryAction $categoryAction)
    {
        parent::__construct();
        $this->categoryAction = $categoryAction;
    }

    public function index()
    {
        return view('admin.category.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        $categoriesForEvents = Category::event()->latest()->get();
        $categoriesForGroups = Category::group()->latest()->get();
        $categoriesForOffers = Category::offer()->latest()->get();

        return view(
            'admin.category.create',
            [
                'categoriesForEvents' => $categoriesForEvents,
                'categoriesForGroups' => $categoriesForGroups,
                'categoriesForOffers' => $categoriesForOffers,
                'menu' => $this->menu
            ]
        );
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->categoryAction->store($request);

        return redirect()->route('admin.category.index')->with('success', 'Категория добавлена');
    }

    public function edit(Category $category)
    {
        $categories = Category::where('type', $category->type)->latest()->get();
        $categoriesForEvents = Category::event()->latest()->get();
        $categoriesForGroups = Category::group()->latest()->get();
        $categoriesForOffers = Category::offer()->latest()->get();

        return view('admin.category.edit', [
            'category' => $category,
            'categories' => $categories,
            'categoriesForEvents' => $categoriesForEvents,
            'categoriesForGroups' => $categoriesForGroups,
            'categoriesForOffers' => $categoriesForOffers,
            'menu' => $this->menu
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category = $this->categoryAction->update($request, $category);

        return redirect()->route('admin.category.edit', ['category' => $category->id])
            ->with('success', 'Категория сохранена');
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Категория удалена');
    }
}
