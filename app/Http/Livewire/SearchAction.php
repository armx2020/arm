<?php

namespace App\Http\Livewire;

use App\Entity\ActionEntity;
use App\Models\Action;

class SearchAction extends BaseSearch
{
    protected $entity;

    public function __construct()
    {
        $this->entity = new ActionEntity;
        parent::__construct($this->entity);
    }


    public function render()
    {
        $title = 'Виды деятельности компаний';
        $emptyEntity = 'Деятельностей нет';
        $entityName = 'action';

        sleep(1);
        if ($this->term == "") {

            $entities = Action::query()->latest();

            foreach ($this->selectedFilters as $filterName => $filterValue) {
                $operator = array_key_first($filterValue);
                $callable = $filterValue[array_key_first($filterValue)];

                $entities = $entities->where($filterName, $operator, $callable);
            }
            $entities = $entities->paginate(20);
        } else {
            $entities = Action::search($this->term)->paginate(20);
        }

        return view('livewire.search-action', [
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
