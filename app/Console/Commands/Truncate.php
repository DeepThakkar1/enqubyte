<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Truncate extends Command
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
    protected $description = 'Truncate all tables in database';

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
     * @return mixed
     */
    public function handle()
    {
        $tableNames = \Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        foreach ($tableNames as $name) {
            //if you don't want to truncate migrations
            if ($name == 'migrations') {
                continue;
            }

          /*  if(substr($name, 0, strlen('telescope')) === 'telescope'){
                continue;
            }

              if(substr($name, 0, strlen('mojo')) === 'mojo'){
                continue;
            }*/
            \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            \DB::table($name)->truncate();
            \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }   

        $this->info('All Database tables truncated.');
    }
}
