<?php

namespace App\Entity\Actions;

use App\Models\Category;
use App\Models\Entity;
use App\Models\Offer;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class OfferAction
{
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
            return redirect()->back()->with('warning', 'компания не найдена');
        }

        $offer = new Offer();
        $offer->name = $request->name;
        $offer->address = $request->address;
        $offer->description = $request->description;
        $offer->city_id = $entity->city_id;
        $offer->region_id = $entity->region_id;
        $offer->entity_id = $request->entity;
        $offer->user_id = $user_id ?: $entity->user_id;
        $offer->category_id = $request->category;

        if ($request->image) {
            $offer->image = $request->file('image')->store('uploaded', 'public');
            Image::make('storage/' . $offer->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image1) {
            $offer->image1 = $request->file('image1')->store('offers', 'public');
            Image::make('storage/' . $offer->image1)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image2) {
            $offer->image2 = $request->file('image2')->store('offers', 'public');
            Image::make('storage/' . $offer->image2)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image3) {
            $offer->image3 = $request->file('image3')->store('offers', 'public');
            Image::make('storage/' . $offer->image3)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image4) {
            $offer->image4 = $request->file('image4')->store('offers', 'public');
            Image::make('storage/' . $offer->image4)->resize(400, null, function ($constraint) {
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
            return redirect()->back()->with('warning', 'компания не найдена');
        }


        if ($request->image_remove == 'delete') {
            Storage::delete('public/' . $offer->image);
            $offer->image = null;
        }

        if ($request->image_remove1 == 'delete') {
            Storage::delete('public/' . $offer->image1);
            $offer->image1 = null;
        }

        if ($request->image_remove2 == 'delete') {
            Storage::delete('public/' . $offer->image2);
            $offer->image2 = null;
        }

        if ($request->image_remove3 == 'delete') {
            Storage::delete('public/' . $offer->image3);
            $offer->image3 = null;
        }

        if ($request->image_remove4 == 'delete') {
            Storage::delete('public/' . $offer->image4);
            $offer->image4 = null;
        }

        if ($request->image) {
            Storage::delete('public/' . $offer->image);
            $offer->image = $request->file('image')->store('offers', 'public');
            Image::make('storage/' . $offer->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image1) {
            Storage::delete('public/' . $offer->image1);
            $offer->image1 = $request->file('image1')->store('offers', 'public');
            Image::make('storage/' . $offer->image1)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image2) {
            Storage::delete('public/' . $offer->image2);
            $offer->image2 = $request->file('image2')->store('offers', 'public');
            Image::make('storage/' . $offer->image2)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image3) {
            Storage::delete('public/' . $offer->image3);
            $offer->image3 = $request->file('image3')->store('offers', 'public');
            Image::make('storage/' . $offer->image3)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image4) {
            Storage::delete('public/' . $offer->image4);
            $offer->image4 = $request->file('image4')->store('offers', 'public');
            Image::make('storage/' . $offer->image4)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $offer->name = $request->name;
        $offer->address = $request->address;
        $offer->description = $request->description;
        $offer->category_id = $request->category;
        $offer->entity_id = $entity->id;
        $offer->city_id = $entity->city_id;
        $offer->region_id = $entity->region_id;
        $offer->entity_id = $request->entity;
        $offer->user_id = $user_id ?: $entity->user_id;

        $offer->update();

        return $offer;
    }

    public function destroy($offer): void
    {
        if ($offer->image !== null) {
            Storage::delete('public/' . $offer->image);
        }
        if ($offer->image1 !== null) {
            Storage::delete('public/' . $offer->image1);
        }
        if ($offer->image2 !== null) {
            Storage::delete('public/' . $offer->image2);
        }
        if ($offer->image3 !== null) {
            Storage::delete('public/' . $offer->image3);
        }
        if ($offer->image4 !== null) {
            Storage::delete('public/' . $offer->image4);
        }

        $offer->delete();
    }
}
