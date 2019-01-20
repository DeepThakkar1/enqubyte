<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Rennokki\Plans\Models\PlanModel;

class CreatePlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plans:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create entries in plans table';

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
        PlanModel::truncate();

        $this->info('Plans database truncated!');

        $monthly = PlanModel::create([
            'name' => 'All-in-one monthly',
            'description' => 'Includes all services and modules for a month',
            'price' => 850,
            'currency' => 'INR',
            'duration' => 30, // in days
        ]);

        $yearly = PlanModel::create([
            'name' => 'All-in-one yearly',
            'description' => 'Includes all services and modules for a year',
            'price' => 19200,
            'currency' => 'INR',
            'duration' => 365, // in days
        ]);

        $this->info('Plans added to the database');
    }
}
