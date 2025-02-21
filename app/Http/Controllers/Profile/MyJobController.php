<?php

namespace App\Http\Controllers\Profile;

use App\Entity\Actions\JobAction;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Models\Category;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyJobController extends BaseController
{
    public function __construct(private JobAction $jobAction)
    {
        parent::__construct();
        $this->jobAction = $jobAction;
    }


    public function index(Request $request)
    {
        $entitiesName = 'myjobs';
        $entityName = 'myjob';

        $companies = Auth::user()->entities()->jobs()->with('primaryImage')->orderByDesc('updated_at')->paginate(10);

        return view('profile.pages.job.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'entities' => $companies,
            'entitiesName' => $entitiesName,
            'entityName' => $entityName,
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::query()->jobs()->active()->where('category_id', null)->with('categories')->get();

        return view('profile.pages.job.create', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categories' => $categories,
            'regions' => $this->regions,
        ]);
    }

    public function store(StoreGroupRequest $request)
    {
        $company = $this->jobAction->store($request, Auth::user()->id);

        return redirect()->route('myjobs.index')->with('success', 'Работа "' . $company->name . '" добавлена');
    }

    public function show(Request $request, $id)
    {
        $entity = Entity::where('user_id', '=', Auth::user()->id)->with('fields')->find($id);

        if (empty($entity)) {
            return redirect()->route('myjobs.index')->with('alert', 'Работа не найдена');
        }

        $sum =  ($entity->address ? 10 : 0) +
            ($entity->description ? 10 : 0) +
            ($entity->image ? 10 : 0) +
            ($entity->phone ? 5 : 0) +
            ($entity->web ? 5 : 0) +
            ($entity->whatsapp ? 5 : 0) +
            ($entity->instagram ? 5 : 0) +
            ($entity->vkontakte ? 5 : 0) +
            ($entity->telegram ? 5 : 0) +
            ($entity->name ? 5 : 0);

        $fullness = (round(($sum / 70) * 100));

        return view('profile.pages.job.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'entity' => $entity,
            'fullness' => $fullness,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $entity = Entity::where('user_id', '=', Auth::user()->id)->with('fields')->find($id);

        if (empty($entity)) {
            return redirect()->route('myjobs.index')->with('alert', 'Работа не найдена');
        }

        $categories = Category::query()->jobs()->active()->where('category_id', null)->with('categories')->get();

        return view('profile.pages.job.edit', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categories' => $categories,
            'regions' => $this->regions,
            'entity' => $entity,
        ]);
    }

    public function update(UpdateGroupRequest $request, $id)
    {
        $entity = Entity::where('user_id', '=', Auth::user()->id)->with('fields')->find($id);

        if (empty($entity)) {
            return redirect()->route('myjobs.index')->with('alert', 'Работа не найдена');
        }

        $entity = $this->jobAction->update($request, $entity, Auth::user()->id);

        return redirect()->route('myjobs.show', ['myjob' => $entity->id])->with('success', 'Работа "' . $entity->name . '" обнавлена');
    }

    public function destroy($id)
    {
        $entity = Entity::where('user_id', '=', Auth::user()->id)->with('fields')->find($id);

        if (empty($entity)) {
            return redirect()->route('myjobs.index')->with('alert', 'Работа не найдена');
        }

        $this->jobAction->destroy($entity);

        return redirect()->route('myjobs.index')->with('success', 'Работа удалена');
    }
}
