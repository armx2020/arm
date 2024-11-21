<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function store($request): Category
    {
        $category = new Category();

        $category->name = $request->name;
        $category->sort_id = $request->sort_id;
        $category->type = $request->type;

        $category->save();

        return $category;
    }

    public function update($request, $category): Category
    {
        $category->name = $request->name;
        $category->sort_id = $request->sort_id;
        $category->type = $request->type;

        $category->update();

        return $category;
    }
}