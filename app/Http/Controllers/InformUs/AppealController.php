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
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'countries' => $this->countries,
        ]);
    }

    public function store(StoreAppealRequest $request)
    {
        $appeal = $this->appealAction->store($request);

        return redirect()->route('inform-us.appeal')->with('success', "Спасибо за ваш вклад в наше сообщество! Ваша информация поможет многим найти надежные компании и услуги. Мы ценим вашу активность и заботу о наших земляках!");
    }
}
