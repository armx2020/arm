<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseSearch extends Component
{
    use WithPagination;

    public $term = "";
    public $allColumns = [];
    public $selectedColumns = [];
    public $filters = [];
    public $selectedFilters = [];

    public function __construct($entity)
    {
        $this->allColumns = $entity->getAllColumns();
        $this->selectedColumns = $entity->getSelectedColumns();
        $this->filters = $entity->getFilters();
        $this->selectedFilters = $entity->getSelectedFilters();
    }
}
