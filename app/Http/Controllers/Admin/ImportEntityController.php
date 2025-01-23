<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\EntityAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Imports\EntityImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportEntityController extends BaseAdminController
{
    public function __construct(private EntityAction $entityAction)
    {
        parent::__construct();
        $this->entityAction = $entityAction;
    }

    public function index()
    {
        return view('admin.entity.import.entity', ['menu' => $this->menu]);
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new EntityImport, $file);
        return back()->with('success', 'Успешно импортировано');
    }
}
