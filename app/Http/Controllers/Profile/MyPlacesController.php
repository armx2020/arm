<?php

namespace App\Http\Controllers\Profile;

use App\Entity\Actions\PlaceAction;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Models\Category;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPlacesController extends BaseController
{
    public function __construct(private PlaceAction $groupAction)
    {
        parent::__construct();
        $this->groupAction = $groupAction;
    }

    public function index(Request $request)
    {
        $entitiesName = 'myplaces';
        $entityName = 'myplace';

        $groups = Auth::user()->entities()->places()->with('primaryImage')->orderByDesc('updated_at')->paginate(10);

        return view('profile.pages.place.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'countries' => $this->countries,
            'entities' => $groups,
            'entitiesName' => $entitiesName,
            'entityName' => $entityName,
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::query()->places()->active()->paginate(10);

        return view('profile.pages.place.create', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'countries' => $this->countries,
            'categories' => $categories,
        ]);
    }

    public function store(StoreGroupRequest $request)
    {

        $group = $this->groupAction->store($request, Auth::user()->id);

        return redirect()->route('myplaces.index')->with('success', 'Место "' . $group->name . '" добавлено');
    }

    public function show(Request $request, $id)
    {
        $entity = Entity::where('user_id', '=', Auth::user()->id)->with('fields')->find($id);

        if (empty($entity)) {
            return redirect()->route('myplaces.index')->with('alert', 'Место не найдено');
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

        return view('profile.pages.place.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'countries' => $this->countries,
            'entity' => $entity,
            'fullness' => $fullness,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $entity = Entity::where('user_id', '=', Auth::user()->id)->with('fields')->find($id);

        if (empty($entity)) {
            return redirect()->route('myplaces.index')->with('alert', 'Место не найдено');
        }

        $categories = Category::query()->places()->active()->get();

        return view('profile.pages.place.edit', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categories' => $categories,
            'regions' => $this->regions,
            'countries' => $this->countries,
            'entity' => $entity,
        ]);
    }

    public function update(UpdateGroupRequest $request, $id)
    {
        $entity = Entity::where('user_id', '=', Auth::user()->id)->with('fields')->find($id);

        if (empty($entity)) {
            return redirect()->route('myplaces.index')->with('alert', 'Место не найдено');
        }

        $entity = $this->groupAction->update($request, $entity, Auth::user()->id);

        return redirect()->route('myplaces.show', ['myplace' => $entity->id])->with('success', 'Место "' . $entity->name . '" обнавлено');
    }

    public function destroy($id)
    {
        $entity = Entity::where('user_id', '=', Auth::user()->id)->with('fields')->find($id);

        if (empty($entity)) {
            return redirect()->route('myplaces.index')->with('alert', 'Место не найдено');
        }

        $this->groupAction->destroy($entity);

        return redirect()->route('myplaces.index')->with('success', 'Место удалено');
    }
}
