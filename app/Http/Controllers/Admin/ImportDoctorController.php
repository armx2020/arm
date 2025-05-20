<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\EntityAction;
use App\Http\Controllers\Controller;
use App\Imports\DoctorImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportDoctorController extends Controller
{
    public function __construct(private EntityAction $entityAction)
    {
        $this->entityAction = $entityAction;
    }

    public function index()
    {
        return view('admin.entity.import.doctor');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new DoctorImport, $file);
        return back()->with('success', 'Успешно импортировано');
    }
}
