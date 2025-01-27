<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\EntityAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Imports\LaywerImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportLawyerController extends BaseAdminController
{
    public function __construct(private EntityAction $entityAction)
    {
        parent::__construct();
        $this->entityAction = $entityAction;
    }

    public function index()
    {
        return view('admin.entity.import.lawyer', ['menu' => $this->menu]);
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new LaywerImport, $file);
        return back()->with('success', 'Успешно импортировано');
    }
}
