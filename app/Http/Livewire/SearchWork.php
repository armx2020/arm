<?php

namespace App\Http\Livewire;

use App\Entity\WorkEntity;
use App\Models\Work;

class SearchWork extends BaseSearch
{
    protected $entity;

    public function __construct()
    {
        $this->entity = new WorkEntity;
        parent::__construct($this->entity);
    }

    public function render()
    {
        $title = 'Все резюме и вакансии';
        $emptyEntity = 'Резюме и вакансий нет';
        $entityName = 'work';

        sleep(1);
        if ($this->term == "") {

            $entities = Work::with('city')->latest();

            foreach ($this->selectedFilters as $filterName => $filterValue) {
                $operator = array_key_first($filterValue);
                $callable = $filterValue[array_key_first($filterValue)];

                $entities = $entities->where($filterName, $operator, $callable);
            }
            $entities = $entities->paginate($this->quantityOfDisplayed);
        } else {
            $entities = Work::search($this->term)->with('city')->paginate($this->quantityOfDisplayed);
        }

        return view('livewire.search-work', [
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
