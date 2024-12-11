<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class InformUsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $secondPositionUrl = 'inform-us';
        $secondPositionName = 'Сообщите нам';

        return view('inform-us', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId'),
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName

        ]);
    }

    public function store(Request $request)
    {
        return redirect()->route('inform-us')->with('success', 'Ваша заявка успешно принята');
    }
}
