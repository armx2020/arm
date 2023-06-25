<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class SearchCompany extends Component
{
    use WithPagination;

    public $term = "";

    public function render()
    {
        if ($this->term == "") {
            sleep(1);
            $companies = Company::with('city')->latest()->paginate(20);
        } else {
            sleep(1);
            $companies = Company::search($this->term)->paginate(20);
        }

        return view('livewire.search-company', ['companies' => $companies]);
    }
}
