<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Entity;
use App\Models\Image;
use DB;

class CalculateTopEntities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-top-entities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate top entities based on fullness';

    /**
     * Execute the console command.
     */
    public function handle() {
        $this->info('Calculating top entities...');

        DB::transaction(function () {
            Entity::query()->update(['top' => 0]);
            $allEntities = Entity::select('id', 'region_id', 'entity_type_id', 'fullness')
                ->orderByDesc('fullness')
                ->get();
            $groupedEntities = $allEntities->groupBy(function ($item) {
                return $item->region_id . '-' . $item->entity_type_id;
            });
            $topEntityIds = [];
            foreach ($groupedEntities as $group) {
                $topEntities = $group->take(3)->pluck('id')->toArray(); // Берем только 3 записи из каждой группы
                $topEntityIds = array_merge($topEntityIds, $topEntities);
            }
            if (!empty($topEntityIds)) {
                Entity::whereIn('id', $topEntityIds)->update(['top' => 1]);
            }
        });

        $this->info('Top entity calculation completed.');
    }
}
