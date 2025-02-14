<?php

namespace App\Entity\Actions;

use App\Entity\Actions\Traits\GetCity;
use App\Models\Category;
use App\Models\Entity;
use App\Models\Offer;
use App\Models\Image as Images;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class OfferAction
{
    use GetCity;

    public function store($request, $user_id = null)
    {
        $entity = Entity::query();

        if ($user_id) {
            $entity = $entity->where('user_id', '=', $user_id);
        }

        $entity = $entity->find($request->entity);

        if ($entity) {
            $categoryBD = Category::find($request->category);

            if ($categoryBD) {
                $categoryMain = $categoryBD->category_id;

                if ($entity->category_id == null) {
                    $entity->category_id = $categoryMain;
                    $entity->save();
                }

                $entity->fields()->syncWithoutDetaching([$request->category => ['main_category_id' => $categoryMain]]);
            }
        } else {
            return false;
        }

        $city = $this->getCity($request);

        $offer = new Offer();
        $offer->name = $request->name;
        $offer->address = $request->address;
        $offer->description = $request->description;
        $offer->city_id = $city->id;
        $offer->region_id = $city->region->id;
        $offer->entity_id = $request->entity;
        $offer->user_id = $user_id ?: $entity->user_id ?: 1;
        $offer->category_id = $request->category;
        $offer->activity = $request->activity ? 1 : 0;

        $offer->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $sortId => $file) {
                $path = $file->store('uploaded', 'public');

                $imageOffer = $offer->images()->create([
                    'path' => $path,
                    'sort_id' => $sortId,
                ]);

                Image::make('storage/' . $imageOffer->path)
                    ->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save();
            }
        }

        return $offer;
    }

    public function update($request, $offer, $user_id = null)
    {
        $entity = Entity::query();

        if ($user_id) {
            $entity = $entity->where('user_id', '=', $user_id);
        }

        $entity = $entity->find($request->entity);

        if ($entity) {
            $entity->fields()->detach($offer->category_id);

            $categoryBD = Category::find($request->category);

            if ($categoryBD) {
                $categoryMain = $categoryBD->category_id;

                if ($entity->category_id == null) {
                    $entity->category_id = $categoryMain;
                    $entity->save();
                }

                $entity->fields()->syncWithoutDetaching([$request->category => ['main_category_id' => $categoryMain]]);
            }
        } else {
            return false;
        }

        $city = $this->getCity($request);


        $offer->name = $request->name;
        $offer->address = $request->address;
        $offer->description = $request->description;
        $offer->category_id = $request->category;
        $offer->entity_id = $entity->id;
        $offer->city_id = $city->id;
        $offer->region_id = $city->region->id;
        $offer->entity_id = $request->entity;
        $offer->user_id = $user_id ?: $entity->user_id ?: 1;
        $offer->activity = $request->activity ? 1 : 0;

        $offer->update();


        $oldImages = $offer->images;
        $imagesData = $request->input('images', []);
        $oldIDs = $oldImages->pluck('id');

        $incomingIDs = collect($imagesData)
            ->filter(fn($item) => !str_starts_with($item['id'], 'new_'))
            ->pluck('id');

        $idsToDelete = $oldIDs->diff($incomingIDs);

        if ($idsToDelete->isNotEmpty()) {
            $images = $offer->images()->whereIn('id', $idsToDelete)->get();
            foreach ($images as $image) {
                if ($image->path) {
                    Storage::delete('public/' . $image->path);
                }
            }
            $offer->images()->whereIn('id', $idsToDelete)->delete();
        }

        $oldImagesMap = $oldImages->keyBy('id');

        foreach ($imagesData as $index => $imgData) {
            $sortId  = $imgData['sort_id'] ?? $index;
            $imageId = $imgData['id'];

            if (str_starts_with($imageId, 'new_')) {
                $file = $request->file("images.$index.file");
                if ($file) {
                    $path = $file->store('uploaded', 'public');

                    $newImage = $offer->images()->create([
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

        return $offer;
    }

    public function destroy($offer): void
    {
        foreach ($offer->images as $image) {
            Storage::delete('public/' . $image->path);
            $image->delete();
        }

        $offer->delete();
    }
}
