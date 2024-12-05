<?php

namespace App\Http\Livewire;

use App\Entity\NewsEntity;
use App\Models\News;

class SearchNews extends BaseSearch
{
    protected $entity;

    public function __construct()
    {
        $this->entity = new NewsEntity;
        parent::__construct($this->entity);
    }

    public function render()
    {
        $title = 'Все новости';
        $emptyEntity = 'Новостей нет';
        $entityName = 'new';

        sleep(1);
        if ($this->term == "") {

            $entities = News::query()->with('city')->latest();

            foreach ($this->selectedFilters as $filterName => $filterValue) {
                $operator = array_key_first($filterValue);
                $callable = $filterValue[array_key_first($filterValue)];

                $entities = $entities->where($filterName, $operator, $callable);
            }
            $entities = $entities->paginate($this->quantityOfDisplayed);
        } else {
            $entities = News::search($this->term)->with('city')->paginate($this->quantityOfDisplayed);
        }

        return view('livewire.search-news', [
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
