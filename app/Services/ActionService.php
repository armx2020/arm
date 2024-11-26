<?php

namespace App\Services;

use App\Models\Action;

class ActionService
{
    public function store($request): Action
    {
        $action = new Action();

        $action->name = $request->name;
        $action->description = $request->description;
        $action->price = $request->price;

        $action->save();

        return $action;
    }

    public function update($request, $action): Action
    {
        $action->name = $request->name;
        $action->description = $request->description;
        $action->price = $request->price;

        $action->update();

        return $action;
    }
}
