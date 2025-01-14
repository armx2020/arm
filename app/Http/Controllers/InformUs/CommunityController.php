<?php

namespace App\Http\Controllers\InformUs;

use App\Entity\Actions\CommunityAction;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CommunityController extends BaseInformUsController
{

    public function __construct(private CommunityAction $communityAction)
    {
        $this->communityAction = $communityAction;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $categories = Category::query()->communities()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();

        return view('inform-us.create-community', [
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
        $community = $this->communityAction->store($request, null, false);

        return redirect()->route('inform-us.community')->with('success', 'Ваша заявка успешно принята');
    }
}