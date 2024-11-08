<?php

namespace App\Http\Livewire;

use App\Models\CompanyOffer;
use Livewire\Component;
use Livewire\WithPagination;

class SearchOffer extends Component
{
    use WithPagination;

    public $term = "";

    public function render()
    {
        if ($this->term == "") {
            sleep(1);
            $offers = CompanyOffer::with('city')->latest()->paginate(20);
        } else {
            sleep(1);
            $offers = CompanyOffer::search($this->term)->paginate(20);
        }
        return view('livewire.search-offer', ['offers' => $offers]);
    }
}
