<?php

namespace App\Services;

use App\Models\OfferCategory;

class OfferCategoryService
{
    public function store($request): OfferCategory
    {
        $category = new OfferCategory();

        $category->name = $request->name;
        $category->sort_id = $request->sort_id;

        $category->save();

        return $category;
    }

    public function update($request, $category): OfferCategory
    {
        $category->name = $request->name;
        $category->sort_id = $request->sort_id;

        $category->update();

        return $category;
    }
}
