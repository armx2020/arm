<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferCategoryRequest;
use App\Models\OfferCategory;
use App\Services\OfferCategoryService;

class OfferCategoryController extends Controller
{
    public function __construct(private OfferCategoryService $offerCategoryService)
    {
        $this->offerCategoryService = $offerCategoryService;
    }

    public function index()
    {
        return view('admin.offercategory.index');
    }

    public function create()
    {
        return view('admin.offercategory.create');
    }

    public function store(OfferCategoryRequest$request)
    {
        $this->offerCategoryService->store($request);

        return redirect()->route('admin.offerCategory.index')->with('success', 'The category added');
    }

    public function show(string $id)
    {
        $category = OfferCategory::withcount('offers')->find($id);

        if(empty($category)) {
            return redirect()->route('admin.offercategory.index')->with('alert', 'The category not found');
        }

        return view('admin.offercategory.show', ['category' => $category]);
    }

    public function edit(string $id)
    {
        $category = OfferCategory::find($id);

        if(empty($category)) {
            return redirect()->route('admin.offercategory.index')->with('alert', 'The category not found');
        }

        return view('admin.offercategory.edit', ['category' => $category]);
    }

    public function update(OfferCategoryRequest $request, string $id)
    {
        $category = OfferCategory::find($id);

        if(empty($category)) {
            return redirect()->route('admin.offercategory.index')->with('alert', 'The category not found');
        }

        $category = $this->offerCategoryService->update($request, $category);

        return redirect()->route('admin.offerCategory.show', ['offerCategory'=> $category->id])
                        ->with('success', 'The category updated');
    }

    public function destroy(string $id)
    {
        $category = OfferCategory::find($id);

        if(empty($category)) {
            return redirect()->route('admin.offercategory.index')->with('alert', 'The category not found');
        }

        $category->delete();

        return redirect()->route('admin.offerCategory.index')->with('success', 'The category deleted');
    }
}
