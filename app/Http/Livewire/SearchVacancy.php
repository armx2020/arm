<?php

namespace App\Http\Livewire;

use App\Models\Vacancy;
use Livewire\Component;
use Livewire\WithPagination;

class SearchVacancy extends Component
{
    use WithPagination;

    public $term = "";

    public function render()
    {
        if ($this->term == "") {
            sleep(1);
            $vacancies = Vacancy::with('city')->latest()->paginate(20);
        } else {
            sleep(1);
            $vacancies = Vacancy::search($this->term)->paginate(20);
        }
        return view('livewire.search-vacancy', ['vacancies' => $vacancies]);
    }
}
