<?php

namespace App\Http\Livewire;

use App\Models\Resume;
use Livewire\Component;
use Livewire\WithPagination;

class SearchResume extends Component
{
    use WithPagination;

    public $term = "";

    public function render()
    {
        if ($this->term == "") {
            sleep(1);
            $resumes = Resume::with('city')->latest()->paginate(20);
        } else {
            sleep(1);
            $resumes = Resume::search($this->term)->paginate(20);
        }
        return view('livewire.search-resume', ['resumes' => $resumes]);
    }
}
