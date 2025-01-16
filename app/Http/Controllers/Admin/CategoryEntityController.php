<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseAdminController;

class CategoryEntityController extends BaseAdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.category-entity.index', ['menu' => $this->menu]);
    }
}
