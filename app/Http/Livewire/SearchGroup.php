<?php

namespace App\Http\Livewire;

use App\Entity\GroupEntity;
use App\Models\Group;

class SearchGroup extends BaseSearch
{
    protected $entity;

    public function __construct()
    {
        $this->entity = new GroupEntity;
        parent::__construct($this->entity);
    }

    public function render()
    {
        $title = 'Все группы';
        $emptyEntity = 'Групп нет';
        $entityName = 'group';

        sleep(1);
        if ($this->term == "") {

            $entities = Group::query()->with('city')->latest();

            foreach ($this->selectedFilters as $filterName => $filterValue) {
                $operator = array_key_first($filterValue);
                $callable = $filterValue[array_key_first($filterValue)];

                $entities = $entities->where($filterName, $operator, $callable);
            }
            $entities = $entities->paginate(20);
        } else {
            $entities = Group::search($this->term)->with('city')->paginate(20);
        }

        return view('livewire.search-group', [
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
