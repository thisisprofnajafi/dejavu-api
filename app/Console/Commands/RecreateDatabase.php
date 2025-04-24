<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RecreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:recreate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop and recreate the database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $database = config('database.connections.mysql.database');
        
        $this->info("Recreating database: {$database}");
        
        // Switch to a different database to run DROP command
        config(['database.connections.mysql.database' => null]);
        DB::reconnect();
        
        $this->info('Dropping database...');
        DB::statement("DROP DATABASE IF EXISTS `{$database}`");
        
        $this->info('Creating database...');
        DB::statement("CREATE DATABASE `{$database}`");
        
        // Switch back to the original database
        config(['database.connections.mysql.database' => $database]);
        DB::reconnect();
        
        $this->info('Database recreated successfully!');
    }
} 