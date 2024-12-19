<?php

namespace App\Http\Livewire;

use App\Entity\Repository\EntityRepository;
use App\Models\Entity;

class SearchEntity extends BaseSearch
{
    protected $entity;

    public function __construct()
    {
        $this->entity = new EntityRepository();
        parent::__construct($this->entity);
    }

    public function render()
    {
        $title = 'Все сушности';
        $emptyEntity = 'сущностей нет';
        $entityName = 'entity';

        sleep(1);
        if ($this->term == "") {

            $entities = Entity::query()->with('city')->latest();

            foreach ($this->selectedFilters as $filterName => $filterValue) {
                $operator = array_key_first($filterValue);
                $callable = $filterValue[array_key_first($filterValue)];

                $entities = $entities->where($filterName, $operator, $callable);
            }
            $entities = $entities->paginate($this->quantityOfDisplayed);
        } else {
            $entities = Entity::search($this->term)->with('city')->paginate($this->quantityOfDisplayed);
        }

        return view(
            'livewire.search-entity',
            [
                'entities' => $entities,
                'allColumns' => $this->allColumns,
                'selectedColumns' => $this->selectedColumns,
                'filters' => $this->filters,
                'title' => $title,
                'emptyEntity' => $emptyEntity,
                'entityName' => $entityName,
            ]
        );
    }
}
