<?php

namespace App\Livewire\Admin;

use App\Entity\Repository\EntityRepository;
use App\Livewire\Admin\BaseComponent;
use Illuminate\Http\Request;
use App\Models\Entity;

class SearchEntity extends BaseComponent
{
    protected $entity;


    public function __construct()
    {
        $this->entity = new EntityRepository();
        parent::__construct($this->entity);
    }

    public function mount(Request $request)
    {
        $this->type = $request->get('type');
        $this->region = $request->get('region');
    }

    public function changeActivity($id)
    {
        $entity = Entity::find($id);
        $isActive = $entity->activity ? false : true;

        $entity->update(['activity' => $isActive]);
    }

    public function render(Request $request)
    {
        if(isset($this->type)){
            $this->selectedFilters['entity_type_id']['='] = $this->type;
        }
        if(isset($this->region)){
            $this->selectedFilters['region_id']['='] = $this->region;
        }
        $title = 'Все сушности';
        $emptyEntity = 'сущностей нет';
        $entityName = 'entity';

        sleep(0.5);
        $entities = Entity::query()->with('city', 'type');

        if ($this->term == "") {
            foreach ($this->selectedFilters as $filterName => $filterValue) {
                if ($filterValue) {
                    $operator = array_key_first($filterValue);
                    $callable = $filterValue[array_key_first($filterValue)];

                    $entities = $entities->where($filterName, $operator, $callable);
                }
            }
        } else {
            $entities = $entities->search($this->term);
        }

        $entities = $entities->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->quantityOfDisplayed);

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
