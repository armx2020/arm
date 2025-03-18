<?php

namespace App\Http\Controllers\InformUs;

use App\Entity\Actions\ProjectAction;
use App\Http\Requests\Project\StoreProjectRequest;
use Illuminate\Http\Request;

class ProjectController extends BaseInformUsController
{

    public function __construct(private ProjectAction $projectAction)
    {
        $this->projectAction = $projectAction;
        parent::__construct();
    }

    public function index(Request $request)
    {
        return view('inform-us.create-project', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'countries' => $this->countries,
            'cities' => $this->cities,
        ]);
    }

    public function store(StoreProjectRequest $request)
    {
        $project = $this->projectAction->store($request, null, false);

        return redirect()->route('inform-us.project')->with('success', "Спасибо, что делитесь полезной информацией! Благодаря вам наше сообщество становится более полезным и дружным. Мы рады, что вы с нами!");
    }
}
