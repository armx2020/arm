<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\EntityAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Entity\StoreEntityRequest;
use App\Http\Requests\Entity\UpdateEntityRequest;
use App\Models\Entity;

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
        return view('admin.entity.edit', ['entity' => $entity, 'menu' => $this->menu]);
    }

    public function update(UpdateEntityRequest $request, Entity $entity)
    {
        $entity = $this->entityAction->update($request, $entity, $request->user ?: 1);

        return redirect()->route('admin.entity.edit', ['entity' => $entity->id])
            ->with('success', "Сущность сохранена");
    }

    public function destroy(Entity $entity)
    {
        $entity = $this->entityAction->destroy($entity);

        return redirect()->route('admin.entity.index')->with('success', 'Сущность удалена');
    }

    public function report(){
        return view('admin.entity.report.index', ['menu' => $this->menu]);
    }

    public function reportTwo(){
        return view('admin.entity.report.index-two', ['menu' => $this->menu]);
    }

    public function reportDouble(){
        return view('admin.entity.report.index-double', ['menu' => $this->menu]);
    }
}
