<?php

namespace App\Services;

use App\Models\Action;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class ActionService
{
    public function store($request): Action
    {
        $action = new Action();

        $action->name = $request->name;
        $action->description = $request->description;
        $action->price = $request->price;

        if ($request->image) {
            $action->image = $request->file('image')->store('groups', 'public');
            Image::make('storage/' . $action->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        } else {
            $action->image = 'group/groups.png';
        }

        $action->save();

        return $action;
    }

    public function update($request, $action): Action
    {
        $action->name = $request->name;
        $action->description = $request->description;
        $action->price = $request->price;

        if ($request->image_r == 'delete') {
            Storage::delete('public/' . $action->image);
            $action->image = null;
        }

        if ($request->image) {
            Storage::delete('public/' . $action->image);
            $action->image = $request->file('image')->store('groups', 'public');
            Image::make('storage/' . $action->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }


        $action->update();

        return $action;
    }
}
