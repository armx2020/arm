<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\City;
use App\Models\EntityType;
use App\Models\User;
use Livewire\Component;

class EditEntity extends Component
{
    public $selectedType = null;
    public $entity = null;

    public function mount($entity)
    {
        $this->entity = $entity;
        $this->selectedType = $entity->entity_type_id;
    }

    public function render()
    {
        $categories = Category::query()->active()->with('categories')->where('category_id', null)->orderBy('sort_id');


        if ($this->selectedType) {
            $categories = $categories->where('entity_type_id', $this->selectedType)->get();
        } else {
            $categories = $categories->take(0)->get();
        }

        $typies = EntityType::all();
        $users = User::all();
        $cities = City::all();

        return view(
            'livewire.admin.edit-entity',
            [
                'users' => $users,
                'typies' => $typies,
                'categories' => $categories,
                'cities' => $cities
            ]
        );
    }
}
