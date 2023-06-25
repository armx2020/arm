<?php

namespace App\Http\Livewire;

use App\Models\OfferCategory;
use Livewire\Component;
use Livewire\WithPagination;

class SearchCategoryForOffer extends Component
{
    use WithPagination;

    public $term = "";

    public function render()
    {
        if ($this->term == "") {
            sleep(1);
            $categories = OfferCategory::withCount('offers')->latest()->paginate(20);
        } else {
            sleep(1);
            $categories = OfferCategory::search($this->term)->paginate(20);
        }
        return view('livewire.search-category-for-offer', ['categories' => $categories]);
    }
}
