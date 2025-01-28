<?php

namespace App\Livewire\Admin;

use App\Entity\Repository\EntityRepository;
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
        $this->entity = new EntityRepository();
        parent::__construct($this->entity);
    }

    public function mount(Request $request)
    {
        // Получаем текущий месяц и год из запроса (или устанавливаем по умолчанию текущий месяц и год)
        $this->month = $request->get('month', now()->translatedFormat('F'));
        $this->year = $request->get('year', now()->year); // Добавляем год
    }

    public function render(Request $request)
    {
        $title = 'Сводка сущности';

        $currentMonth = $this->month ?? now()->translatedFormat('F');
        $currentYear = $this->year ?? now()->year;

        $months = [
            'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
        ];

        $currentIndex = array_search($currentMonth, $months);

        if ($currentIndex === false) {
            $currentIndex = now()->month - 1;
            $currentMonth = $months[$currentIndex];
        }

        if ($currentIndex === 0) {
            $prevMonth = $months[11];
            $prevYear = $currentYear - 1;
        } else {
            $prevMonth = $months[$currentIndex - 1];
            $prevYear = $currentYear;
        }

        if ($currentIndex === 11) {
            $nextMonth = $months[0];
            $nextYear = $currentYear + 1;
        } else {
            $nextMonth = $months[$currentIndex + 1];
            $nextYear = $currentYear;
        }

        $regions = Region::query()->get();
        $entityTypes = EntityType::query()->get();
        $currentMonthIndex = $currentIndex + 1; // Январь = 1, Февраль = 2 и т.д.

        $entityCounts = Entity::query()
            ->whereMonth('created_at', $currentMonthIndex)
            ->whereYear('created_at', $currentYear)
            ->select('region_id', 'entity_type_id', \DB::raw('COUNT(*) as count'))
            ->groupBy('region_id', 'entity_type_id')
            ->get()
            ->groupBy('region_id');


        $table = [];
        foreach ($regions as $region) {
            $row = ['region' => $region->name];
            $regionCounts = $entityCounts->get($region->id, collect());

            foreach ($entityTypes as $type) {
                $count = $regionCounts->firstWhere('entity_type_id', $type->id)->count ?? 0;
                $row[$type->name] = $count;
            }

            $table[] = $row;
        }

        return view('livewire.admin.search-report-entity', [
            'entityTypes' => $entityTypes,
            'regions' => $regions,
            'table' => $table,
            'title' => $title,
            'month' => $currentMonth,
            'year' => $currentYear,
            'prevMonth' => $prevMonth,
            'prevYear' => $prevYear,
            'nextMonth' => $nextMonth,
            'nextYear' => $nextYear,
        ]);
    }
}
