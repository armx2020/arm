<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\EntityAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Imports\CategoryImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportCategoryController extends BaseAdminController
{
    public function __construct(private EntityAction $entityAction)
    {
        parent::__construct();
        $this->entityAction = $entityAction;
    }

    public function index()
    {
        return view('admin.entity.import.category', ['menu' => $this->menu]);
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new CategoryImport, $file);
        return back()->with('success', 'Успешно импортировано');
    }
}
