<?php

namespace App\Http\Controllers\Profile;

use App\Entity\Actions\CommunityAction;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Models\Category;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyCommunityController extends BaseController
{
    public function __construct(private CommunityAction $groupAction)
    {
        parent::__construct();
        $this->groupAction = $groupAction;
    }

    public function index(Request $request)
    {
        $entitiesName = 'mycommunities';
        $entityName = 'mycommunity';

        $groups = Auth::user()->entities()->communities()->with('primaryImage')->orderByDesc('updated_at')->paginate(10);

        return view('profile.pages.community.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'entities' => $groups,
            'entitiesName' => $entitiesName,
            'entityName' => $entityName,
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::query()->communities()->active()->orderBy('sort_id', 'asc')->paginate(10);

        return view('profile.pages.community.create', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'categories' => $categories,
        ]);
    }

    public function store(StoreGroupRequest $request)
    {

        $group = $this->groupAction->store($request, Auth::user()->id);

        return redirect()->route('mycommunities.index')->with('success', 'Община "' . $group->name . '" добавлена');
    }

    public function show(Request $request, $id)
    {
        $entity = Entity::where('user_id', '=', Auth::user()->id)->with('fields')->find($id);

        if (empty($entity)) {
            return redirect()->route('mycommunities.index')->with('alert', 'Община не найдена');
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

        return view('profile.pages.community.show', [
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
            return redirect()->route('mycommunities.index')->with('alert', 'Община не найдено');
        }

        $categories = Category::query()->communities()->active()->orderBy('sort_id', 'asc')->get();

        return view('profile.pages.community.edit', [
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
            return redirect()->route('mycommunities.index')->with('alert', 'Община не найдена');
        }

        $entity = $this->groupAction->update($request, $entity, Auth::user()->id);

        return redirect()->route('mycommunities.show', ['mycommunity' => $entity->id])->with('success', 'Община "' . $entity->name . '" обнавлена');
    }

    public function destroy($id)
    {
        $entity = Entity::where('user_id', '=', Auth::user()->id)->with('fields')->find($id);

        if (empty($entity)) {
            return redirect()->route('mycommunities.index')->with('alert', 'Община не найдена');
        }

        $this->groupAction->destroy($entity);

        return redirect()->route('mycommunities.index')->with('success', 'Община удалена');
    }
}
