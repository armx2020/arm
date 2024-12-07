<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\BaseController;
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
        $secondPositionUrl = 'works.index';
        $secondPositionName = 'Работа';
        $entity = 'works';

        return view('pages.work.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $regionCode,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
        ]);
    }

    public function show(Request $request, $id)
    {
        $work = Work::with('parent')->find($id);

        if (empty($work)) {
            return redirect()->route('works.index')->with('alert', 'Товар не найден');
        }

        return view('pages.work.show', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'entity' => $work,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }
}
