<?php

namespace App\Entity;

use App\Contracts\EntityColumnsInterface;
use App\Contracts\EntityFiltersInterface;

class CategoryEntity implements EntityColumnsInterface, EntityFiltersInterface
{
    protected $allColumns = [
        'id',
        'name',
        'sort_id',
        'type',
        'category_id ',
        'activity',
        'created_at',
        'updated_at',
    ];

    protected $selectedColumns = [
        'id',
        'name',
        'sort_id',
        'type',
        'category_id ',
        'activity',
    ];

    protected $filters = [
        'created_at' => 'date',
        'updated_at' => 'date',
        'activity' => 'bool',
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
