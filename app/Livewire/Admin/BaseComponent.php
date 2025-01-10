<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseComponent extends Component
{
    use WithPagination;

    public $term = "";
    public $allColumns = [];
    public $selectedColumns = [];
    public $filters = [];
    public $selectedFilters = [];

    protected $quantityOfDisplayed = 100; // Количество отоброжаемых сущностей

    public function __construct($entity)
    {
        $this->allColumns = $entity->getAllColumns();
        $this->selectedColumns = $entity->getSelectedColumns();
        $this->filters = $entity->getFilters();
        $this->selectedFilters = $entity->getSelectedFilters();
    }
}
