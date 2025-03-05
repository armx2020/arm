<?php

namespace App\Http\Controllers\InformUs;

use App\Entity\Actions\GroupAction;
use App\Entity\Actions\JobAction;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class JobController extends BaseInformUsController
{

    public function __construct(private JobAction $jobAction)
    {
        $this->jobAction = $jobAction;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $categories = Category::query()->jobs()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();

        return view('inform-us.create-job', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'cities' => $this->cities,
            'categories' => $categories,
        ]);
    }

    public function store(StoreGroupRequest $request)
    {
        $job = $this->jobAction->store($request, null, false);

        return redirect()->route('inform-us.job')->with('success', "Спасибо, что делитесь полезной информацией! Благодаря вам наше сообщество становится более полезным и дружным. Мы рады, что вы с нами!");
    }
}
