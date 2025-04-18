<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\EntityAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Imports\ChurchImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportChurchController extends BaseAdminController
{
    public function __construct(private EntityAction $entityAction)
    {
        parent::__construct();
        $this->entityAction = $entityAction;
    }

    public function index()
    {
        return view('admin.entity.import.church', ['menu' => $this->menu]);
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new ChurchImport, $file);
        return back()->with('success', 'Успешно импортировано');
    }
}
