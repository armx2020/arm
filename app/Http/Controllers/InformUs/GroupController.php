<?php

namespace App\Http\Controllers\InformUs;

use App\Entity\Actions\GroupAction;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class GroupController extends BaseInformUsController
{

    public function __construct(private GroupAction $groupAction)
    {
        $this->groupAction = $groupAction;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $categories = Category::query()->groups()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();

        return view('inform-us.create-group', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId'),
            'cities' => $this->cities,
            'secondPositionUrl' => $this->secondPositionUrl,
            'secondPositionName' => $this->secondPositionName,
            'categories' => $categories,

        ]);
    }

    public function store(StoreGroupRequest $request)
    {
        $group = $this->groupAction->store($request, null, false);

        return redirect()->route('inform-us.group')->with('success', 'Ваша заявка успешно принята');
    }
}
