<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, $regionCode = null)
    {
        return view('pages.work.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $regionCode
        ]);
    }

    public function show(Request $request, $id)
    {
        $work = Work::with('parent')->find($id);

        if (empty($work)) {
            return redirect()->route('offers.index')->with('alert', 'Товар не найден');
        }

        return view('pages.work.show', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'work' => $work,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }
}
