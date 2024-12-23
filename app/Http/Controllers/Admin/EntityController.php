<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\EntityAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Entity\StoreEntityRequest;
use App\Http\Requests\Entity\UpdateEntityRequest;
use App\Models\Category;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class EntityController extends BaseAdminController
{
    public function __construct(private EntityAction $entityAction)
    {
        parent::__construct();
        $this->entityAction = $entityAction;
    }

    public function index()
    {
        return view('admin.entity.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        return view('admin.entity.create', ['menu' => $this->menu]);
    }

    public function store(StoreEntityRequest $request)
    {
        $this->entityAction->store($request, $request->user ?: 1);

        return redirect()->route('admin.entity.index')->with('success', 'Сущность добавлена');
    }

    public function edit(Entity $entity)
    {
        $categories = Category::query()->active()->where('category_id', null)->with('categories')->where('entity_type_id', $entity->entity_type_id)->orderBy('sort_id')->get();
        $users = User::all();

        return view('admin.entity.edit', ['entity' => $entity, 'users' => $users, 'menu' => $this->menu, 'categories' => $categories]);
    }

    public function update(UpdateEntityRequest $request, Entity $entity)
    {
        $entity = $this->entityAction->update($request, $entity, $request->user ?: 1);

        return redirect()->route('admin.entity.edit', ['entity' => $entity->id])
            ->with('success', "Сущность сохранена");
    }

    public function destroy(Entity $entity)
    {
        if (count($entity->offers) > 0) {
            return redirect()->route('admin.company.index')->with('alert', 'У компании есть предложения, удалите сначала их');
        }


        foreach ($entity->works as $work) {
            $work->delete();
        }

        if ($entity->image !== null) {
            Storage::delete('public/' . $entity->image);
        }

        $entity->delete();

        return redirect()->route('admin.entity.index')->with('success', 'Сущность удалена');
    }
}
