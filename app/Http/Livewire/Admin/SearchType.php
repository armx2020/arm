<?php

namespace App\Http\Livewire\Admin;

use App\Entity\Repository\TypeRepository;
use App\Http\Livewire\BaseSearch;
use App\Models\EntityType;

class SearchType extends BaseSearch
{
    protected $entity;

    public function __construct()
    {
        $this->entity = new TypeRepository;
        parent::__construct($this->entity);
    }


    public function render()
    {
        $title = 'Все типы сущностей';
        $emptyEntity = 'Типов для сущностей нет';
        $entityName = 'type';

        sleep(1);
        if ($this->term == "") {

            $entities = EntityType::query()->latest();

            foreach ($this->selectedFilters as $filterName => $filterValue) {
                $operator = array_key_first($filterValue);
                $callable = $filterValue[array_key_first($filterValue)];

                $entities = $entities->where($filterName, $operator, $callable);
            }
            $entities = $entities->paginate($this->quantityOfDisplayed);
        } else {
            $entities = EntityType::search($this->term)->paginate($this->quantityOfDisplayed);
        }

        return view('livewire.admin.search-type', [
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
