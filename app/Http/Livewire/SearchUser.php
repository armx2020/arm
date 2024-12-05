<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Entity\UserEntity;

class SearchUser extends BaseSearch
{
    protected $entity;

    public function __construct()
    {
        $this->entity = new UserEntity;
        parent::__construct($this->entity);
    }

    public function render()
    {
        $title = 'Все пользователи';
        $emptyEntity = 'Пользователей нет';
        $entityName = 'user';

        sleep(1);
        if ($this->term == "") {

            $entities = User::query()->with('city')->latest();

            foreach ($this->selectedFilters as $filterName => $filterValue) {
                $operator = array_key_first($filterValue);
                $callable = $filterValue[array_key_first($filterValue)];

                $entities = $entities->where($filterName, $operator, $callable);
            }
            $entities = $entities->paginate($this->quantityOfDisplayed);
        } else {
            $entities = User::search($this->term)->with('city')->paginate($this->quantityOfDisplayed);
        }

        return view(
            'livewire.search-user',
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
