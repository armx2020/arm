<?php

namespace App\Entity\Actions;

use App\Entity\Actions\Traits\GetCity;
use App\Models\Category;
use App\Models\Entity;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class CompanyAction
{
    use GetCity;

    public function store($request, $user_id = null, $isActive = true): Entity
    {
        $city = $this->getCity($request);

        $entity = new Entity();

        if ($isActive == false) {
            $entity->activity = $isActive;
        }

        $entity->entity_type_id = 1;
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

        if ($request->image) {
            $entity->image = $request->file('image')->store('uploaded', 'public');
            Image::make('storage/' . $entity->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $entity->save();

        if ($request->fields) {
            foreach ($request->fields as $categoryID) {
                $categoryBD = Category::find($categoryID);

                if ($categoryBD) {
                    $categoryMain = $categoryBD->category_id;

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

        if ($request->image_remove == 'delete') {
            Storage::delete('public/' . $entity->image);
            $entity->image = null;
        }

        if ($request->image) {
            Storage::delete('public/' . $entity->image);
            $entity->image = $request->file('image')->store('uploaded', 'public');
            Image::make('storage/' . $entity->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

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

        $entity->fields()->detach();

        $entity->update();

        if ($request->categories) {
            foreach ($request->categories as $categoryID => $val) {
                $categoryBD = Category::find($categoryID);

                if ($categoryBD) {
                    $categoryMain = $categoryBD->category_id;

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

    public function destroy($entity): void
    {

        if ($entity->image !== null) {
            Storage::delete('public/' . $entity->image);
        }

        $entity->fields()->detach();
        $entity->delete();
    }
}
