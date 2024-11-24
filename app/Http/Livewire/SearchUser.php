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
        sleep(1);
        $users = User::query()->with('city')->latest();

        foreach ($this->selectedFilters as $filterName => $filterValue) {
            $operator = array_key_first($filterValue);
            $callable = $filterValue[array_key_first($filterValue)];

            $users = $users->where($filterName, $operator, $callable);
        }
        $users = $users->paginate(20);

        return view(
            'livewire.search-user',
            [
                'users' => $users,
                'allColumns' => $this->allColumns,
                'selectedColumns' => $this->selectedColumns,
                'filters' => $this->filters,
            ]
        );
    }
}
