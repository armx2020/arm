<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class SearchProject extends Component
{
    use WithPagination;

    public $term = "";

    public function render()
    {
        if ($this->term == "") {
            sleep(1);
            $projects = Project::with('city')->latest()->paginate(20);
        } else {
            sleep(1);
            $projects = Project::search($this->term)->paginate(20);
        }
        return view('livewire.search-project', ['projects' => $projects]);
    }
}
