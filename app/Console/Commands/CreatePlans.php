<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Rennokki\Plans\Models\PlanModel;
use Rennokki\Plans\Models\PlanFeatureModel;

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
        $this->info('Deleting all plans data!');

        PlanModel::truncate();

        $this->info('Plans database truncated!');

        $free = PlanModel::create([
            'name' => 'Free',
            'description' => 'Includes all services and modules for a month',
            'price' => 0,
            'currency' => 'INR',
            'duration' => 30, // in days
        ]);

        $free->features()->saveMany([
                new PlanFeatureModel([
                    'name' => 'Invoices Count',
                    'code' => 'invoices.count',
                    'description' => 'Number of invoices user can create',
                    'type' => 'limit',
                    'limit' => 10,
                ]),
                new PlanFeatureModel([
                    'name' => 'Enquiries Count',
                    'code' => 'enquiries.count',
                    'description' => 'Number of enquiries user can create',
                    'type' => 'limit',
                    'limit' => 10,
                ]),
                 new PlanFeatureModel([
                    'name' => 'Products Count',
                    'code' => 'products.count',
                    'description' => 'Number of products user can create',
                    'type' => 'limit',
                    'limit' => 15,
                ]),
                new PlanFeatureModel([
                    'name' => 'Customers Count',
                    'code' => 'customers.count',
                    'description' => 'Number of customers user can create',
                    'type' => 'limit',
                    'limit' => 10,
                ]),
            ]);

        $this->info('Free Plan added to database.');

        $adaptive = PlanModel::create([
            'name' => 'Adaptive',
            'description' => 'Includes all services and modules for a month',
            'price' => 450,
            'currency' => 'INR',
            'duration' => 30, // in days
        ]);

        $adaptive->features()->saveMany([
                new PlanFeatureModel([
                    'name' => 'Invoices Count',
                    'code' => 'invoices.count',
                    'description' => 'Number of invoices user can create',
                    'type' => 'limit',
                    'limit' => 70,
                ]),
                new PlanFeatureModel([
                    'name' => 'Enquiries Count',
                    'code' => 'enquiries.count',
                    'description' => 'Number of enquiries user can create',
                    'type' => 'limit',
                    'limit' => 50,
                ]),
                 new PlanFeatureModel([
                    'name' => 'Products Count',
                    'code' => 'products.count',
                    'description' => 'Number of products user can create',
                    'type' => 'limit',
                    'limit' => 65,
                ]),
                new PlanFeatureModel([
                    'name' => 'Customers Count',
                    'code' => 'customers.count',
                    'description' => 'Number of customers user can create',
                    'type' => 'limit',
                    'limit' => 50,
                ]),
            ]);

        $this->info('Adaptive Plan added to database.');


        $growth = PlanModel::create([
            'name' => 'Growth',
            'description' => 'Includes all services and modules for a month',
            'price' => 850,
            'currency' => 'INR',
            'duration' => 30, // in days
        ]);

        $growth->features()->saveMany([
                new PlanFeatureModel([
                    'name' => 'Invoices Count',
                    'code' => 'invoices.count',
                    'description' => 'Number of invoices user can create',
                    'type' => 'limit',
                    'limit' => 200,
                ]),
                new PlanFeatureModel([
                    'name' => 'Enquiries Count',
                    'code' => 'enquiries.count',
                    'description' => 'Number of enquiries user can create',
                    'type' => 'limit',
                    'limit' => 200,
                ]),
                 new PlanFeatureModel([
                    'name' => 'Products Count',
                    'code' => 'products.count',
                    'description' => 'Number of products user can create',
                    'type' => 'limit',
                    'limit' => 150,
                ]),
                new PlanFeatureModel([
                    'name' => 'Customers Count',
                    'code' => 'customers.count',
                    'description' => 'Number of customers user can create',
                    'type' => 'limit',
                    'limit' => 200,
                ]),
            ]);

        $this->info('Growth Plan added to database.');

        $enterprise = PlanModel::create([
            'name' => 'Enterprise',
            'description' => 'Includes all services and modules for a month',
            'price' => 1750,
            'currency' => 'INR',
            'duration' => 30, // in days
        ]);

        $growth->features()->saveMany([
                new PlanFeatureModel([
                    'name' => 'Invoices Count',
                    'code' => 'invoices.count',
                    'description' => 'Number of invoices user can create',
                    'type' => 'limit',
                    'limit' => 10000,
                ]),
                new PlanFeatureModel([
                    'name' => 'Enquiries Count',
                    'code' => 'enquiries.count',
                    'description' => 'Number of enquiries user can create',
                    'type' => 'limit',
                    'limit' => 10000,
                ]),
                 new PlanFeatureModel([
                    'name' => 'Products Count',
                    'code' => 'products.count',
                    'description' => 'Number of products user can create',
                    'type' => 'limit',
                    'limit' => 10000,
                ]),
                new PlanFeatureModel([
                    'name' => 'Customers Count',
                    'code' => 'customers.count',
                    'description' => 'Number of customers user can create',
                    'type' => 'limit',
                    'limit' => 10000,
                ]),
            ]);

        $this->info('Enterprise Plan added to database.');


        $this->info('Plans database created.');
       
    }
}
