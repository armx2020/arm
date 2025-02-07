<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\EntityType;
use App\Models\Entity;
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
        $duplicateExists = Entity::where(function ($query) {
            $query->where('name', $this->entity->name)
                ->orWhere('phone', $this->entity->phone)
                ->orWhere('address', $this->entity->address)
                ->orWhere('email', $this->entity->email)
                ->orWhere('web', $this->entity->web)
                ->orWhere('vkontakte', $this->entity->vkontakte)
                ->orWhere('whatsapp', $this->entity->whatsapp)
                ->orWhere('telegram', $this->entity->telegram)
                ->orWhere('instagram', $this->entity->instagram);
        })->where('id', '!=', $this->entity->id)
        ->exists();
        $categories = Category::query()->active()->with('categories')->where('category_id', null)->orderBy('sort_id');

        if ($this->selectedType) {
            $categories = $categories->where('entity_type_id', $this->selectedType)->get();
        } else {
            $categories = $categories->take(0)->get();
        }

        $typies = EntityType::all();

        return view(
            'livewire.admin.edit-entity',
            [
                'typies' => $typies,
                'categories' => $categories,
                'duplicateExists' => $duplicateExists
            ]
        );
    }
}
