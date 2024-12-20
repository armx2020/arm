<?php

namespace App\Http\Livewire;

use App\Entity\Repository\OfferRepository;
use App\Models\CompanyOffer;

class SearchOffer extends BaseSearch
{
    protected $entity;

    public function __construct()
    {
        $this->entity = new OfferRepository;
        parent::__construct($this->entity);
    }


    public function render()
    {
        $title = 'Все предложения';
        $emptyEntity = 'Предложений нет';
        $entityName = 'offer';

        sleep(1);
        if ($this->term == "") {
            $entities = CompanyOffer::query()->with('city')->latest();

            foreach ($this->selectedFilters as $filterName => $filterValue) {
                $operator = array_key_first($filterValue);
                $callable = $filterValue[array_key_first($filterValue)];

                $entities = $entities->where($filterName, $operator, $callable);
            }

            $entities = $entities->paginate($this->quantityOfDisplayed);
        } else {
            $entities = CompanyOffer::search($this->term)->with('city')->paginate($this->quantityOfDisplayed);
        }
        return view(
            'livewire.search-offer',
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
