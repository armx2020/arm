<?php

namespace App\Http\Controllers\InformUs;

use App\Entity\Actions\EventAction;
use App\Http\Requests\Event\StoreEventRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends BaseInformUsController
{

    public function __construct(private EventAction $eventAction)
    {
        $this->eventAction = $eventAction;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $categories = Category::query()->event()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();

        return view('inform-us.create-event', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId'),
            'cities' => $this->cities,
            'secondPositionUrl' => $this->secondPositionUrl,
            'secondPositionName' => $this->secondPositionName,
            'categories' => $categories,
        ]);
    }

    public function store(StoreEventRequest $request)
    {
        $group = $this->eventAction->store($request, null, false);

        return redirect()->route('inform-us.event')->with('success', 'Ваша заявка успешно принята');
    }
}
