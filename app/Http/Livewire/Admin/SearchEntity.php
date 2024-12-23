<?php

namespace App\Http\Livewire\Admin;

use App\Entity\Repository\EntityRepository;
use App\Http\Livewire\BaseSearch;
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

        sleep(0.5);
        $entities = Entity::query()->with('city', 'type')->orderByDesc('id');;

        if ($this->term == "") {
            foreach ($this->selectedFilters as $filterName => $filterValue) {
                $operator = array_key_first($filterValue);
                $callable = $filterValue[array_key_first($filterValue)];

                $entities = $entities->where($filterName, $operator, $callable);
            }
        } else {
            $entities = $entities->search($this->term);
        }

        $entities = $entities->paginate($this->quantityOfDisplayed);

        return view(
            'livewire.admin.search-entity',
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
