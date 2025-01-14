<?php

namespace App\Http\Controllers\InformUs;

use App\Entity\Actions\PlaceAction;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Entity\StoreEntityRequest;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class PlaceController extends BaseInformUsController
{

    public function __construct(private PlaceAction $placeAction)
    {
        $this->placeAction = $placeAction;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $categories = Category::query()->places()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();

        return view('inform-us.create-place', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId'),
            'cities' => $this->cities,
            'secondPositionUrl' => '',
            'secondPositionName' => $this->secondPositionName,
            'categories' => $categories,

        ]);
    }

    public function store(StoreGroupRequest $request)
    {
        $place = $this->placeAction->store($request, null, false);

        return redirect()->route('inform-us.place')->with('success', 'Ваша заявка успешно принята');
    }
}
