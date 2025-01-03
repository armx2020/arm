<?php

namespace App\Http\Livewire\Admin;

use App\Entity\Repository\OfferRepository;
use App\Http\Livewire\Admin\BaseComponent;
use App\Models\Offer;

class SearchOffer extends BaseComponent
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

        sleep(0.5);
        $entities = Offer::query()->with('city')->orderByDesc('id');;

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
            'livewire.admin.search-offer',
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
