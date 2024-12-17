<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Group;
use App\Services\ImportService;
use Illuminate\Console\Command;

class ImportDataToEntityTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-data-to-entity-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ImportService $service)
    {
        $service->setDataFromEntity(Company::query());
        $service->setDataFromEntity(Group::query());
    }
}
