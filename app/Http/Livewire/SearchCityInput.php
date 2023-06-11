<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;

class SearchCityInput extends Component
{
    public $term = "";

    public function render()
    {
        sleep(1);
        $cities = City::search($this->term)->paginate(5);

        return view('livewire.search-city-input', ['cities' => $cities]);
    }
}
