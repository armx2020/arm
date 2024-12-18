<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\TypeAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Type\StoreTypeRequest;
use App\Http\Requests\Type\UpdateTypeRequest;
use App\Models\EntityType;

class TypeController extends BaseAdminController
{
    public function __construct(private TypeAction $typeAction)
    {
        parent::__construct();
        $this->typeAction = $typeAction;
    }

    public function index()
    {
        return view('admin.type.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        return view(
            'admin.type.create',
            [
                'menu' => $this->menu
            ]
        );
    }

    public function store(StoreTypeRequest $request)
    {
        $this->typeAction->store($request);

        return redirect()->route('admin.type.index')->with('success', 'Категория добавлена');
    }

    public function edit(EntityType $type)
    {
        return view('admin.type.edit', [
            'type' => $type,
            'menu' => $this->menu
        ]);
    }

    public function update(UpdateTypeRequest $request, EntityType $type)
    {
        $type = $this->typeAction->update($request, $type);

        return redirect()->route('admin.type.edit', ['type' => $type->id])
            ->with('success', 'Тип сохранен');
    }


    public function destroy(EntityType $type)
    {
        $type->delete();

        return redirect()->route('admin.type.index')->with('success', 'Тип удален');
    }
}
