<?php

namespace App\Http\Livewire;

use App\Entity\EventEntity;
use App\Models\Event;

class SearchEvent extends BaseSearch
{
    protected $entity;

    public function __construct()
    {
        $this->entity = new EventEntity;
        parent::__construct($this->entity);
    }

    public function render()
    {
        $title = 'Все события';
        $emptyEntity = 'Событий нет';
        $entityName = 'event';

        sleep(1);
        if ($this->term == "") {

            $entities = Event::query()->with('city', 'parent')->latest();

            foreach ($this->selectedFilters as $filterName => $filterValue) {
                $operator = array_key_first($filterValue);
                $callable = $filterValue[array_key_first($filterValue)];

                $entities = $entities->where($filterName, $operator, $callable);
            }
            $entities = $entities->paginate(20);
        } else {
            $entities = Event::search($this->term)->with('city', 'parent')->paginate(20);
        }

        return view('livewire.search-event', [
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
