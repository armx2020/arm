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
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'countries' => $this->countries,
            'cities' => $this->cities,
            'categories' => $categories,
        ]);
    }

    public function store(StoreGroupRequest $request)
    {
        $community = $this->communityAction->store($request, null, false);

        return redirect()->route('inform-us.community')->with('success', "Спасибо, что делитесь полезной информацией! Благодаря вам наше сообщество становится более полезным и дружным. Мы рады, что вы с нами!");
    }
}
