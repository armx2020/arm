<?php

namespace App\Http\Livewire;

use App\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;

class SearchGroup extends Component
{
    use WithPagination;

    public $term = "";

    public function render()
    {
        if ($this->term == "") {
            sleep(1);
            $groups = Group::with('city')->latest()->paginate(20);
        } else {
            sleep(1);
            $groups = Group::search($this->term)->paginate(20);
        }

        return view('livewire.search-group', ['groups' => $groups]);
    }
}
