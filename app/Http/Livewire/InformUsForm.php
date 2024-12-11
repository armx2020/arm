<?php

namespace App\Http\Livewire;

use App\Models\Region;
use Livewire\Component;

class InformUsForm extends Component
{
    public $types = '';


    public function render()
    {
        $form = null;


        switch ($this->types) {
            case 'companies':
                # code...
                break;

            default:
                # code...
                break;
        }

        $regions = Region::all();

        return view(
            'livewire.inform-us-form',
            ['regions' => $regions]
        );
    }
}
