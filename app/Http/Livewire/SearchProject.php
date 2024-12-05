<?php

namespace App\Http\Livewire;

use App\Entity\ProjectEntity;
use App\Models\Project;

class SearchProject extends BaseSearch
{
    protected $entity;

    public function __construct()
    {
        $this->entity = new ProjectEntity;
        parent::__construct($this->entity);
    }


    public function render()
    {
        $title = 'Все проекты';
        $emptyEntity = 'Проектов нет';
        $entityName = 'project';

        sleep(1);
        if ($this->term == "") {

            $entities = Project::query()->with('city')->latest();

            foreach ($this->selectedFilters as $filterName => $filterValue) {
                $operator = array_key_first($filterValue);
                $callable = $filterValue[array_key_first($filterValue)];

                $entities = $entities->where($filterName, $operator, $callable);
            }
            $entities = $entities->paginate($this->quantityOfDisplayed);
        } else {
            $entities = Project::search($this->term)->with('city')->paginate($this->quantityOfDisplayed);
        }

        return view('livewire.search-project', [
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
