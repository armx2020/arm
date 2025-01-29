<?php

namespace App\Livewire\Admin;

use App\Entity\Repository\ReportEntityRepository;
use App\Livewire\Admin\BaseComponent;
use Illuminate\Http\Request;
use App\Models\EntityType;
use App\Models\Region;
use App\Models\Entity;

class SearchReportEntity extends BaseComponent
{
    protected $entity;


    public function __construct()
    {
        $this->entity = new ReportEntityRepository();
        parent::__construct($this->entity);
    }

    public function render(Request $request)
    {
        $title = 'Сводка сущности';
        $regions = Region::query()->get();
        $entityTypes = EntityType::query()->get();
        $entityCounts = Entity::query();

        if ($this->term == "") {
            foreach ($this->selectedFilters as $filterName => $filterValue) {
                if ($filterValue) {
                    $operator = array_key_first($filterValue);
                    $callable = $filterValue[array_key_first($filterValue)];
                    if($callable != ''){
                        $entityCounts = $entityCounts->where($filterName, $operator, $callable);
                    }
                }
            }
        } else {
            $entityCounts = $entityCounts->search($this->term);
        }

        $entityCounts = $entityCounts
            ->select('region_id', 'entity_type_id', \DB::raw('COUNT(*) as count'))
            ->groupBy('region_id', 'entity_type_id')
            ->get()
            ->groupBy('region_id');

        $table = [];
        $totals = [];

        foreach ($regions as $region) {
            $row = [
                'region' => ['id' => $region->id, 'name' => $region->name]
            ];
            $regionCounts = $entityCounts->get($region->id, collect());

            foreach ($entityTypes as $type) {
                $count = $regionCounts->firstWhere('entity_type_id', $type->id)->count ?? 0;
                $row[$type->name] = [
                    'id' => $type->id,
                    'count' => $count
                ];

                if (!isset($totals[$type->name])) {
                    $totals[$type->name] = 0;
                }
                $totals[$type->name] += $count;
            }
            $table[] = $row;
        }

        $totalsRow = ['region' => ['id' => null, 'name' => 'Итоги']];
        foreach ($entityTypes as $type) {
            $totalsRow[$type->name] = [
                'id' => $type->id,
                'count' => $totals[$type->name] ?? 0
            ];
        }
        $table[] = $totalsRow;

        if ($this->sortField && in_array($this->sortField, $entityTypes->pluck('name')->toArray())) {
            usort($table, function ($a, $b) {
                if ($a['region']['name'] === 'Итоги') return 1;
                if ($b['region']['name'] === 'Итоги') return -1;

                $valueA = $a[$this->sortField]['count'] ?? 0;
                $valueB = $b[$this->sortField]['count'] ?? 0;

                if ($this->sortAsc) {
                    return $valueA <=> $valueB;
                } else {
                    return $valueB <=> $valueA;
                }
            });
        }

        return view('livewire.admin.search-report-entity', [
            'entityTypes' => $entityTypes,
            'regions' => $regions,
            'table' => $table,
            'title' => $title
        ]);
    }
}
