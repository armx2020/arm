<?php

namespace App\Entity\Repository;

use App\Contracts\EntityColumnsInterface;
use App\Contracts\EntityFiltersInterface;

class EntityRepository implements EntityColumnsInterface, EntityFiltersInterface
{
    protected $allColumns = [
        'id',
        'name',
        'address',
        'phone',
        'description',
        'activity',
        'entity_type_id',
        'created_at',
        'updated_at',
        'whatsapp',
        'instagram',
        'vkontakte',
        'telegram',
        'category_id',
        'user_id',
        'city_id',
        'region_id',
    ];

    protected $selectedColumns = [
        'id',
        'name',
        'entity_type_id',
        'category_id',
        'user_id',
        'city_id',
        'region_id',
        'address',
        'phone',
    ];

    protected $filters = [
        'created_at' => 'date',
        'updated_at' => 'date',
        'activity' => 'bool',
        'entity_type_id' => 'select',
        //    'user_id' => 'select', // TODO выборка по пользователю
        'city_id' => 'select',
        'region_id' => 'select',
    ];

    protected $selectedFilters = [];

    public function getAllColumns(): array
    {
        return $this->allColumns;
    }

    public function getSelectedColumns(): array
    {
        return $this->selectedColumns;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getSelectedFilters(): array
    {
        return $this->selectedFilters;
    }

}
