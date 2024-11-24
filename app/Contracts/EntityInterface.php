<?php
namespace App\Contracts;

interface EntityInterface
{
    public function getAllColumns(): array;
    public function getSelectedColumns(): array;
    public function getFilters(): array;
    public function getSelectedFilters(): array;
}