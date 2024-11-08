<?php

namespace App\Services;

use App\Models\GroupCategory;

class GroupCategoryService
{
    public function store($request): GroupCategory
    {
        $category = new GroupCategory();

        $category->name = $request->name;
        $category->sort_id = $request->sort_id;

        $category->save();

        return $category;
    }

    public function update($request, $category): GroupCategory
    {
        $category->name = $request->name;
        $category->sort_id = $request->sort_id;

        $category->update();

        return $category;
    }
}