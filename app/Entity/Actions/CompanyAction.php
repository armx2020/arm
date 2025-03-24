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
        $entity->director = $request->director;
        $entity->city_id = $city->id;
        $entity->region_id = $city->region->id;
        $entity->phone = $request->phone;
        $entity->web = $request->web;
        $entity->whatsapp = $request->whatsapp;
        $entity->telegram = $request->telegram;
        $entity->instagram = $request->instagram;
        $entity->vkontakte = $request->vkontakte;
        $entity->user_id = $user_id ?: $request->user;

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

        $entity->name = $request->name;
        $entity->address = $request->address;
        $entity->description = $request->description;
        $entity->director = $request->director;
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

        $oldImages = $entity->images;
        $imagesData = $request->input('images', []);
        $oldIDs = $oldImages->pluck('id');

        $incomingIDs = collect($imagesData)
            ->filter(fn($item) => !str_starts_with($item['id'], 'new_'))
            ->pluck('id');

        $idsToDelete = $oldIDs->diff($incomingIDs);

        if ($idsToDelete->isNotEmpty()) {
            $images = $entity->images()->whereIn('id', $idsToDelete)->get();
            foreach ($images as $image) {
                if ($image->path) {
                    Storage::delete('public/' . $image->path);
                }
            }
            $entity->images()->whereIn('id', $idsToDelete)->delete();
        }

        $oldImagesMap = $oldImages->keyBy('id');

        foreach ($imagesData as $index => $imgData) {
            $sortId  = $imgData['sort_id'] ?? $index;
            $imageId = $imgData['id'];

            if (str_starts_with($imageId, 'new_')) {
                $file = $request->file("images.$index.file");
                if ($file) {
                    $path = $file->store('uploaded', 'public');

                    $newImage = $entity->images()->create([
                        'sort_id' => $sortId,
                        'path'    => $path,
                    ]);

                    Image::make('storage/' . $newImage->path)
                        ->resize(400, null, function($constraint){
                            $constraint->aspectRatio();
                        })
                        ->save();
                }
            } else {
                $oldImage = $oldImagesMap->get($imageId);
                if ($oldImage) {
                    $oldImage->sort_id = $sortId;
                    $oldImage->save();
                }
            }
        }

        return $entity;
    }

    public function destroy($entity): void
    {
        foreach ($entity->images as $image) {
            Storage::delete('public/' . $image->path);
            $image->delete();
        }

        $entity->fields()->detach();
        $entity->offers()->delete();
        $entity->delete();
    }
}
