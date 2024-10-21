<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TruncateDBTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate all tables of Database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->truncateAllTables();
    }

    public function truncateAllTables()
    {
        Schema::disableForeignKeyConstraints();

        $tables = DB::select('SHOW TABLES');
        $tableKey = 'Tables_in_' . env('DB_DATABASE');

        foreach ($tables as $table) {
            $tableName = $table->$tableKey;
            DB::table($tableName)->truncate();
        }

        Schema::enableForeignKeyConstraints();
    }
}
