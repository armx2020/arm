<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SearchUser extends Component
{
    public $term = "";

    public function render()
    {
        if ($this->term == "") {
            sleep(1);
            $users = User::with('city')->latest()->paginate(20);
        } else {
            sleep(1);
            $users = User::search($this->term)->paginate(20);
        }


        return view('livewire.search-user', ['users' => $users]);
    }
}
