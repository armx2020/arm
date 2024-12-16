<?php

namespace App\Http\Controllers\InformUs;

use App\Entity\Actions\AppealAction;
use App\Http\Requests\Appeal\StoreAppealRequest;
use Illuminate\Http\Request;

class AppealController extends BaseInformUsController
{

    public function __construct(private AppealAction $appealAction)
    {
        $this->appealAction = $appealAction;
        parent::__construct();
    }

    public function index(Request $request)
    {
        return view('inform-us.appeal', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId'),
            'secondPositionUrl' => $this->secondPositionUrl,
            'secondPositionName' => $this->secondPositionName,
        ]);
    }

    public function store(StoreAppealRequest $request)
    {
        $appeal = $this->appealAction->store($request);

        return redirect()->route('inform-us.appeal')->with('success', 'Ваша заявка успешно принята');
    }
}