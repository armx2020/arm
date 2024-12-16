<?php

namespace App\Http\Livewire;

use App\Entity\Repository\CompanyRepository;
use App\Models\Company;

class SearchCompany extends BaseSearch
{
    protected $entity;

    public function __construct()
    {
        $this->entity = new CompanyRepository;
        parent::__construct($this->entity);
    }

    public function render()
    {
        $title = 'Все компании';
        $emptyEntity = 'Компаний нет';
        $entityName = 'company';

        sleep(1);
        if ($this->term == "") {

            $entities = Company::query()->with('city')->latest();

            foreach ($this->selectedFilters as $filterName => $filterValue) {
                $operator = array_key_first($filterValue);
                $callable = $filterValue[array_key_first($filterValue)];

                $entities = $entities->where($filterName, $operator, $callable);
            }
            $entities = $entities->paginate($this->quantityOfDisplayed);
        } else {
            $entities = Company::search($this->term)->with('city')->paginate($this->quantityOfDisplayed);
        }

        return view(
            'livewire.search-company',
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
