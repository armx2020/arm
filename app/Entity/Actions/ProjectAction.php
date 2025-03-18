<?php

namespace App\Entity\Actions;

use App\Models\Project;
use App\Entity\Actions\Traits\GetCity;
use App\Models\Entity;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class ProjectAction
{
    use GetCity;

    public function store($request, $user_id = null, $isActive = true)
    {
        $city = $this->getCity($request);

        $entity = new Entity();

        if ($isActive == false) {
            $entity->activity = $isActive;
        }

        $entity->entity_type_id = 12;
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

    public function update($request, $project): Project
    {
        $city = $this->getCity($request);

        $project->name = $request->name;
        $project->address = $request->address;
        $project->description = $request->description;
        $project->city_id = $request->city;
        $project->region_id = $city->region->id;
        $project->donations_need = $request->donations_need;
        $project->donations_have = $request->donations_have;

        if ($request->parent == 'User') {
            $project->parent_type = 'App\Models\User';
            $project->parent_id = $request->user;
        } elseif ($request->parent == 'Company') {
            $project->parent_type = 'App\Models\Company';
            $project->parent_id = $request->company;
        } elseif ($request->parent == 'Group') {
            $project->parent_type = 'App\Models\Group';
            $project->parent_id = $request->group;
        } else {
            $project->parent_type = 'App\Models\User';
            $project->parent_id = 1;
        }

        if ($request->image_remove == 'delete') {
            Storage::delete('public/' . $project->image);
            $project->image = null;
        }

        if ($request->image) {
            Storage::delete('public/' . $project->image);
            $project->image = $request->file('image')->store('projects', 'public');
            Image::make('storage/' . $project->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $project->update();

        return $project;
    }
}
