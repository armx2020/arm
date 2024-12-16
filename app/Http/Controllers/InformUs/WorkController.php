<?php

namespace App\Http\Controllers\InformUS;

use App\Entity\Actions\WorkAction;
use App\Http\Requests\Work\StoreWorkRequest;
use Illuminate\Http\Request;

class WorkController extends BaseInformUsController
{

    public function __construct(private WorkAction $workAction)
    {
        $this->workAction = $workAction;
        parent::__construct();
    }

    public function index(Request $request)
    {
        return view('inform-us.create-work', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId'),
            'cities' => $this->cities,
            'secondPositionUrl' => $this->secondPositionUrl,
            'secondPositionName' => $this->secondPositionName,
        ]);
    }

    public function store(StoreWorkRequest $request)
    {
        $work = $this->workAction->store($request, null, false);

        return redirect()->route('inform-us.work')->with('success', 'Ваша заявка успешно принята');
    }
}
