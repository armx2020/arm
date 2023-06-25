<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GroupCategory;

class SearchCategoryForGroup extends Component
{
    use WithPagination;

    public $term = "";

    public function render()
    {
        if ($this->term == "") {
            sleep(1);
            $categories = GroupCategory::withCount('groups')->latest()->paginate(20);
        } else {
            sleep(1);
            $categories = GroupCategory::search($this->term)->paginate(20);
        }
        return view('livewire.search-category-for-group', ['categories' => $categories]);
    }
}
