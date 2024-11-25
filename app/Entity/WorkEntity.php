<?php

namespace App\Entity;

use App\Contracts\EntityColumnsInterface;
use App\Contracts\EntityFiltersInterface;

class WorkEntity implements EntityColumnsInterface, EntityFiltersInterface
{
    protected $allColumns = [
        'id',
        'created_at',
        'updated_at',
        'name',
        'address',
        'description',
        'activity',
        'city_id',
        'region_id',
        'parent_type',
        'parent_id',
    ];

    protected $selectedColumns = [
        'id',
        'name',
        'description',
        'activity',
    ];

    protected $filters = [
        'created_at' => 'date',
        'updated_at' => 'date',
        'activity' => 'bool',
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