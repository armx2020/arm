<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SearchUser extends Component
{
    use WithPagination;

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
