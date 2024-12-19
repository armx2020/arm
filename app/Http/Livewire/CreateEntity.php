<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\EntityType;
use App\Models\User;
use Livewire\Component;

class CreateEntity extends Component
{
    public $type;

    public function render()
    {
        $categorieForOffer = null;
        $categoriesForGroup = null;

        switch ($this->type) {
            case 1:
                $categorieForOffer = Category::query()->offer()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();
                break;
            case 2:
                $categoriesForGroup = Category::query()->group()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();
                break;
        }

        $typies = EntityType::all();
        $users = User::all();

        return view(
            'livewire.create-entity',
            [
                'users' => $users,
                'typies' => $typies,
                'categorieForOffer' => $categorieForOffer,
                'categoriesForGroup' => $categoriesForGroup,
            ]
        );
    }
}
