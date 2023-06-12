<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CopyUserData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:copyUserData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy user data to a new table during database migration';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Copying user data...');
        Schema::dropIfExists('usersBackup');
        DB::statement('CREATE TABLE usersBackup LIKE users');
        DB::statement('INSERT INTO usersBackup SELECT * FROM users');
        $this->info('User data copied successfully!');
    }
}
