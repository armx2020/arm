<?php

namespace App\Entity\Actions;

use App\Entity\Actions\Traits\GetCity;
use App\Models\Category;
use App\Models\Entity;
use App\Models\Offer;
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

        if ($request->image) {
            $offer->image = $request->file('image')->store('uploaded', 'public');
            Image::make('storage/' . $offer->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $offer->save();

        // images
        if ($request->image_1) {
            $offer->images()->create([
                'path' => $request->file('image_1')->store('uploaded', 'public')
            ]);
            Image::make('storage/' . $offer->images()->get()[0]->path)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image_2) {
            $offer->images()->create([
                'path' => $request->file('image_2')->store('uploaded', 'public')
            ]);
            Image::make('storage/' . $offer->images()->get()[1]->path)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image_3) {
            $offer->images()->create([
                'path' => $request->file('image_3')->store('uploaded', 'public')
            ]);
            Image::make('storage/' . $offer->images()->get()[2]->path)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image_4) {
            $offer->images()->create([
                'path' => $request->file('image_4')->store('uploaded', 'public')
            ]);
            Image::make('storage/' . $offer->images()->get()[3]->path)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $offer->save();

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

        if ($request->image_remove == 'delete' || $request->image) {
            if (isset($offer->image)) {
                Storage::delete('public/' . $offer->image);
                $offer->image = null;
            }
        }

        if ($request->image_remove_1 == 'delete' || $request->image_1) {
            if (isset($offer->images()->get()[0])) {
                Storage::delete('public/' . $offer->images()->get()[0]->path);
                $offer->images()->get()[0]->delete();
            }
        }

        if ($request->image_remove_2 == 'delete'  || $request->image_2) {
            if (isset($offer->images()->get()[1])) {
                Storage::delete('public/' . $offer->images()->get()[1]->path);
                $offer->images()->get()[1]->delete();
            }
        }

        if ($request->image_remove_3 == 'delete'  || $request->image_3) {
            if (isset($offer->images()->get()[2])) {
                Storage::delete('public/' . $offer->images()->get()[2]->path);
                $offer->images()->get()[2]->delete();
            }
        }

        if ($request->image_remove_4 == 'delete' || $request->image_4) {
            if (isset($offer->images()->get()[3])) {
                Storage::delete('public/' . $offer->images()->get()[3]->path);
                $offer->images()->get()[3]->delete();
            }
        }

        // images
        if ($request->image) {
            $offer->image = $request->file('image')->store('uploaded', 'public');
            Image::make('storage/' . $offer->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image_1) {
            $offer->images()->create([
                'path' => $request->file('image_1')->store('uploaded', 'public')
            ]);
            Image::make('storage/' . $offer->images()->get()[0]->path)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image_2) {
            $offer->images()->create([
                'path' => $request->file('image_2')->store('uploaded', 'public')
            ]);
            Image::make('storage/' . $offer->images()->get()[1]->path)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image_3) {
            $offer->images()->create([
                'path' => $request->file('image_3')->store('uploaded', 'public')
            ]);
            Image::make('storage/' . $offer->images()->get()[2]->path)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image_4) {
            $offer->images()->create([
                'path' => $request->file('image_4')->store('uploaded', 'public')
            ]);
            Image::make('storage/' . $offer->images()->get()[3]->path)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

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

        return $offer;
    }

    public function destroy($offer): void
    {
        if (isset($offer->image)) {
            Storage::delete('public/' . $offer->image);
            $offer->image = null;
        }

        if (isset($offer->images()->get()[0])) {
            Storage::delete('public/' . $offer->images()->get()[0]->path);
            $offer->images()->get()[0]->delete();
        }

        if (isset($offer->images()->get()[1])) {
            Storage::delete('public/' . $offer->images()->get()[1]->path);
            $offer->images()->get()[1]->delete();
        }

        if (isset($offer->images()->get()[2])) {
            Storage::delete('public/' . $offer->images()->get()[2]->path);
            $offer->images()->get()[2]->delete();
        }

        if (isset($offer->images()->get()[3])) {
            Storage::delete('public/' . $offer->images()->get()[3]->path);
            $offer->images()->get()[3]->delete();
        }

        $offer->delete();
    }
}
