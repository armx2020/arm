<?php

namespace App\Http\Livewire;

use App\Entity\CompanyEntity;
use App\Models\Company;
use Livewire\WithPagination;

class SearchCompany extends BaseSearch
{
    protected $entity;

    public function __construct()
    {
        $this->entity = new CompanyEntity;
        parent::__construct($this->entity);
    }

    public function render()
    {
        sleep(1);
        if ($this->term == "") {

            $companies = Company::query()->with('city')->latest();

            foreach ($this->selectedFilters as $filterName => $filterValue) {
                $operator = array_key_first($filterValue);
                $callable = $filterValue[array_key_first($filterValue)];

                $companies = $companies->where($filterName, $operator, $callable);
            }
            $companies = $companies->paginate(20);
        } else {
            $companies = Company::search($this->term)->with('city')->paginate(20);
        }

        return view(
            'livewire.search-company',
            [
                'companies' => $companies,
                'allColumns' => $this->allColumns,
                'selectedColumns' => $this->selectedColumns,
                'filters' => $this->filters,
            ]
        );
    }
}
