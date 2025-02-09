<?php

namespace App\Entity\Actions;

use App\Entity\Actions\Traits\GetCity;
use App\Models\Category;
use App\Models\Entity;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class EntityAction
{
    use GetCity;

    public function store($request, $user_id = null, $isActive = true): Entity
    {
        $city = $this->getCity($request);

        $entity = new Entity();

        if ($isActive == false) {
            $entity->activity = $isActive;
        }

        $entity->entity_type_id = $request->type;

        $entity->name = $request->name;
        $entity->address = $request->address;
        $entity->description = $request->description;
        $entity->city_id = $city->id;
        $entity->region_id = $city->region->id;
        $entity->phone = $request->phone;
        $entity->web = $request->web;
        $entity->whatsapp = $request->whatsapp;
        $entity->telegram = $request->telegram;
        $entity->instagram = $request->instagram;
        $entity->vkontakte = $request->vkontakte;
        $entity->user_id = $user_id ?: $request->user;
        $entity->activity = $request->activity ? 1 : 0;
        $entity->sort_id = $request->sort_id;

        $entity->save();

        // images
        for ($i = 1, $k = 0; $i < 21; $i++, $k++) {
            $image = "image_$i";
            $activitiImage = "activity_img_$i";

            if ($request->$image) {
                $entity->images()->create([
                    'path' => $request->file($image)->store('uploaded', 'public'),
                    'activity' => $request->$activitiImage ?: 0
                ]);
                Image::make('storage/' . $entity->images()->withoutGlobalScopes()->get()[$k]->path)->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save();
            }
        }

        // fields
        if ($request->fields) {
            foreach ($request->fields as $categoryID) {
                $categoryBD = Category::find($categoryID);

                if ($categoryBD) {
                    $categoryMain = $categoryBD->category_id ?: $categoryBD->id;

                    if ($entity->category_id == null) {
                        $entity->category_id = $categoryMain;
                        $entity->save();
                    }
                    $entity->fields()->attach($categoryID, ['main_category_id' => $categoryMain]);
                }
            }
        }

        return $entity;
    }

    public function update($request, $entity, $user_id = null): Entity
    {
        $city = $this->getCity($request);

        for ($i = 1, $k = 0; $i < 21; $i++, $k++) {
            $text = "image_remove_$i";
            $text2 = "image_$i";
            if ($request->$text == 'delete'  || $request->$text2) {
                if (isset($entity->images()->withoutGlobalScopes()->get()[$k])) {
                    Storage::delete('public/' . $entity->images()->withoutGlobalScopes()->get()[$k]->path);
                    $entity->images()->withoutGlobalScopes()->get()[$k]->delete();
                }
            }
        }

        $entity->entity_type_id = $request->type;

        $entity->name = $request->name;
        $entity->address = $request->address;
        $entity->description = $request->description;
        $entity->city_id = $city->id;
        $entity->region_id = $city->region->id;
        $entity->phone = $request->phone;
        $entity->web = $request->web;
        $entity->whatsapp = $request->whatsapp;
        $entity->telegram = $request->telegram;
        $entity->instagram = $request->instagram;
        $entity->vkontakte = $request->vkontakte;
        $entity->user_id = $user_id ?: $request->user;
        $entity->activity = $request->activity ? 1 : 0;
        $entity->category_id = null;
        $entity->sort_id = $request->sort_id;

        $entity->save();

        $entity->fields()->detach();
        $entity->update();

        // images
        for ($i = 1, $k = 0; $i < 21; $i++, $k++) {
            $image = "image_$i";
            $activitiImage = "activity_img_$i";
            if ($request->$image) {
                $entity->images()->create([
                    'path' => $request->file($image)->store('uploaded', 'public'),
                    'activity' => $request->$activitiImage ?: 0
                ]);
                Image::make('storage/' . $entity->images()->withoutGlobalScopes()->get()[$k]->path)->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save();
            }
            if ($request->$activitiImage) {
                if (isset($entity->images()->withoutGlobalScopes()->get()[$k])) {
                    $entity->images()->withoutGlobalScopes()->get()[$k]->update([
                        'activity' => 1
                    ]);
                }
            } else {
                if (isset($entity->images()->withoutGlobalScopes()->get()[$k])) {
                    $entity->images()->withoutGlobalScopes()->get()[$k]->update([
                        'activity' => 0
                    ]);
                }
            }
        }

        if ($request->fields) {
            foreach ($request->fields as $categoryID) {
                $categoryBD = Category::find($categoryID);

                if ($categoryBD) {
                    $categoryMain = $categoryBD->category_id ?: $categoryBD->id;;

                    if ($entity->category_id == null) {
                        $entity->category_id = $categoryMain;
                        $entity->save();
                    }
                    $entity->fields()->attach($categoryID, ['main_category_id' => $categoryMain]);
                }
            }
        }

        return $entity;
    }

    public function destroy($entity)
    {
        if (count($entity->offers) > 0) {
            return redirect()->route('admin.entity.index')->with('alert', 'У компании есть предложения, удалите сначала их');
        }

        if ($entity->entity_type_id == 1) {
            $entity->fields()->detach();
        }

        if (isset($entity->image)) {
            Storage::delete('public/' . $entity->image);
            $entity->image = null;
        }

        if (isset($entity->images()->get()[0])) {
            Storage::delete('public/' . $entity->images()->get()[0]->path);
            $entity->images()->get()[0]->delete();
        }

        if (isset($entity->images()->get()[1])) {
            Storage::delete('public/' . $entity->images()->get()[1]->path);
            $entity->images()->get()[1]->delete();
        }

        if (isset($entity->images()->get()[2])) {
            Storage::delete('public/' . $entity->images()->get()[2]->path);
            $entity->images()->get()[2]->delete();
        }

        if (isset($entity->images()->get()[3])) {
            Storage::delete('public/' . $entity->images()->get()[3]->path);
            $entity->images()->get()[3]->delete();
        }

        $entity->delete();
    }
}
