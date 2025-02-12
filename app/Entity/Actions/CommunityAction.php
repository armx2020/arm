<?php

namespace App\Entity\Actions;

use App\Entity\Actions\Traits\GetCity;
use App\Models\Entity;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class CommunityAction
{
    use GetCity;

    public function store($request, $user_id = null, $isActive = true): Entity
    {
        $city = $this->getCity($request);

        $entity = new Entity();

        if ($isActive == false) {
            $entity->activity = $isActive;
        }

        $entity->entity_type_id = 4;
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
        $entity->category_id = $request->category;

        $entity->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $sortId => $file) {
                $path = $file->store('uploaded', 'public');

                $imageEntity = $entity->images()->create([
                    'path' => $path,
                    'sort_id' => $sortId,
                ]);

                Image::make('storage/' . $imageEntity->path)
                    ->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save();
            }
        }

        return $entity;
    }

    public function update($request, $entity, $user_id = null): Entity
    {
        $city = $this->getCity($request);

        if ($request->image_remove == 'delete' || $request->image) {
            if (isset($entity->image)) {
                Storage::delete('public/' . $entity->image);
                $entity->image = null;
            }
        }

        if ($request->image_remove_1 == 'delete' || $request->image_1) {
            if (isset($entity->images()->get()[0])) {
                Storage::delete('public/' . $entity->images()->get()[0]->path);
                $entity->images()->get()[0]->delete();
            }
        }

        if ($request->image_remove_2 == 'delete'  || $request->image_2) {
            if (isset($entity->images()->get()[1])) {
                Storage::delete('public/' . $entity->images()->get()[1]->path);
                $entity->images()->get()[1]->delete();
            }
        }

        if ($request->image_remove_3 == 'delete'  || $request->image_3) {
            if (isset($entity->images()->get()[2])) {
                Storage::delete('public/' . $entity->images()->get()[2]->path);
                $entity->images()->get()[2]->delete();
            }
        }

        if ($request->image_remove_4 == 'delete' || $request->image_4) {
            if (isset($entity->images()->get()[3])) {
                Storage::delete('public/' . $entity->images()->get()[3]->path);
                $entity->images()->get()[3]->delete();
            }
        }

        // images
        if ($request->image) {
            $entity->image = $request->file('image')->store('uploaded', 'public');
            Image::make('storage/' . $entity->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image_1) {
            $entity->images()->create([
                'path' => $request->file('image_1')->store('uploaded', 'public')
            ]);
            Image::make('storage/' . $entity->images()->get()[0]->path)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image_2) {
            $entity->images()->create([
                'path' => $request->file('image_2')->store('uploaded', 'public')
            ]);
            Image::make('storage/' . $entity->images()->get()[1]->path)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image_3) {
            $entity->images()->create([
                'path' => $request->file('image_3')->store('uploaded', 'public')
            ]);
            Image::make('storage/' . $entity->images()->get()[2]->path)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image_4) {
            $entity->images()->create([
                'path' => $request->file('image_4')->store('uploaded', 'public')
            ]);
            Image::make('storage/' . $entity->images()->get()[3]->path)->resize(400, null, function ($constraint) {
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
        $entity->category_id = $request->category;

        $entity->update();

        return $entity;
    }

    public function destroy($entity): void
    {
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
