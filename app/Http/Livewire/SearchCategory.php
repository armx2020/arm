<?php

namespace App\Http\Livewire;

use App\Entity\Repository\CategoryRepository;
use App\Models\Category;

class SearchCategory extends BaseSearch
{
    protected $entity;

    public function __construct()
    {
        $this->entity = new CategoryRepository;
        parent::__construct($this->entity);
    }


    public function render()
    {
        $title = 'Все категории';
        $emptyEntity = 'Категорий нет';
        $entityName = 'category';

        sleep(1);
        if ($this->term == "") {

            $entities = Category::query()->latest();

            foreach ($this->selectedFilters as $filterName => $filterValue) {
                $operator = array_key_first($filterValue);
                $callable = $filterValue[array_key_first($filterValue)];

                $entities = $entities->where($filterName, $operator, $callable);
            }
            $entities = $entities->paginate($this->quantityOfDisplayed);
        } else {
            $entities = Category::search($this->term)->paginate($this->quantityOfDisplayed);
        }

        return view('livewire.search-category', [
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
