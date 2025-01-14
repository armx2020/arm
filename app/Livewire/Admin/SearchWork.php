<?php

namespace App\Livewire\Admin;

use App\Entity\Repository\WorkRepository;
use App\Livewire\Admin\BaseComponent;
use App\Models\Work;

class SearchWork extends BaseComponent
{
    protected $entity;

    public function __construct()
    {
        $this->entity = new WorkRepository;
        parent::__construct($this->entity);
    }

    public function render()
    {
        $title = 'Все резюме и вакансии';
        $emptyEntity = 'Резюме и вакансий нет';
        $entityName = 'work';

        sleep(0.5);
        $entities = Work::with('city');

        if ($this->term == "") {
            foreach ($this->selectedFilters as $filterName => $filterValue) {
                $operator = array_key_first($filterValue);
                $callable = $filterValue[array_key_first($filterValue)];

                $entities = $entities->where($filterName, $operator, $callable);
            }
        } else {
            $entities = $entities->search($this->term);
        }

        $entities = $entities->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->quantityOfDisplayed);

        return view('livewire.admin.search-work', [
            'entities' => $entities,
            'allColumns' => $this->allColumns,
            'selectedColumns' => $this->selectedColumns,
            'filters' => $this->filters,
            'title' => $title,
            'emptyEntity' => $emptyEntity,
            'entityName' => $entityName,
        ]);
    }
}
