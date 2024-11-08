<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class SearchEvent extends Component
{
    use WithPagination;

    public $term = "";

    public function render()
    {
        if ($this->term == "") {
            sleep(1);
            $events = Event::with('city', 'parent')->latest()->paginate(20);
        } else {
            sleep(1);
            $events = Event::search($this->term)->paginate(20);
        }

        return view('livewire.search-event', ['events' => $events]);
    }
}
