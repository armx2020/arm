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

        // Проверяем, есть ли в запросе месяц, если нет, используем текущий месяц
        $currentMonth = $this->month ?? now()->translatedFormat('F'); // Текущий месяц по умолчанию
        $currentYear = $this->year ?? now()->year;  // Текущий год по умолчанию

        // Массив всех месяцев на русском
        $months = [
            'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
        ];

        // Индекс текущего месяца
        $currentIndex = array_search($currentMonth, $months);

        // Если месяц не был передан или индекс оказался -1, то устанавливаем значения по умолчанию
        if ($currentIndex === false) {
            $currentIndex = now()->month - 1;  // Устанавливаем индекс текущего месяца
            $currentMonth = $months[$currentIndex];  // Устанавливаем текущий месяц
        }

        // Предыдущий месяц с учетом года
        if ($currentIndex === 0) {
            $prevMonth = $months[11]; // Декабрь предыдущего года
            $prevYear = $currentYear - 1;
        } else {
            $prevMonth = $months[$currentIndex - 1];
            $prevYear = $currentYear;
        }

        // Следующий месяц с учетом года
        if ($currentIndex === 11) {
            $nextMonth = $months[0]; // Январь следующего года
            $nextYear = $currentYear + 1;
        } else {
            $nextMonth = $months[$currentIndex + 1];
            $nextYear = $currentYear;
        }

        // Данные для отчета
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

        // Сборка таблицы
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
