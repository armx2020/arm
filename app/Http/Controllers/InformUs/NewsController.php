<?php

namespace App\Http\Controllers\InformUS;

use App\Entity\Actions\NewsAction;
use App\Http\Requests\News\StoreNewsRequest;
use Illuminate\Http\Request;

class NewsController extends BaseInformUsController
{

    public function __construct(private NewsAction $newsAction)
    {
        $this->newsAction = $newsAction;
        parent::__construct();
    }

    public function index(Request $request)
    {
        return view('inform-us.create-news', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId'),
            'cities' => $this->cities,
            'secondPositionUrl' => $this->secondPositionUrl,
            'secondPositionName' => $this->secondPositionName,
        ]);
    }

    public function store(StoreNewsRequest $request)
    {
        $news = $this->newsAction->store($request, null, false);

        return redirect()->route('inform-us.news')->with('success', 'Ваша заявка успешно принята');
    }
}
