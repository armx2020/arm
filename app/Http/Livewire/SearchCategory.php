<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class SearchCategory extends Component
{
    use WithPagination;

    public $term = "";

    public function render()
    {
        if ($this->term == "") {
            sleep(1);
            $categories = Category::withCount('groups')->latest()->paginate(20);
        } else {
            sleep(1);
            $categories = Category::search($this->term)->paginate(20);
        }
        return view('livewire.search-category', ['categories' => $categories]);
    }
}
