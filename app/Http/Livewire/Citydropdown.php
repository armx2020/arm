<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;

class Citydropdown extends Component
{
    public $ottPlatform = '';
    
    public $cities;

    public function mount()
    {
        $this->cities = City::all();
    }

    public function render()
    {
        return view('livewire.citydropdown');
    }
}
