<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateInOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate_in_order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /** Specify the names of the migrations files in the order you want to 
        * loaded
        * $migrations =[ 
        *               'xxxx_xx_xx_000000_create_nameTable_table.php',
        *    ];
        */
        $migrations = [ 
            '2023_12_03_102655_create_permission_tables.php',
            '2014_10_12_100000_create_password_reset_tokens_table.php',
            '2014_10_12_100000_create_password_resets_table.php',
            '2019_08_19_000000_create_failed_jobs_table.php',
            '2019_12_14_000001_create_personal_access_tokens_table.php',
            '2023_11_17_123003_create_regions_table.php',
            '2014_10_12_000000_create_users_table.php',
            '2023_11_17_123118_create_districts_table.php',
            '2023_11_17_123154_create_wards_table.php',
            '2023_11_17_123813_create_age_groups_table.php',
            '2023_11_17_123928_create_attributes_table.php',
            '2023_11_17_124034_create_form_attributes_table.php',
            '2023_11_17_124310_create_forms_table.php',
            '2023_11_17_124841_create_form_data_table.php',
            '2023_12_31_110958_create_notifications_table.php',
        ];

        foreach($migrations as $migration)
        {
            $basePath = 'database/migrations/';          
            $migrationName = trim($migration);
            $path = $basePath.$migrationName;
            $this->call('migrate:refresh', [
            '--path' => $path ,            
            ]);
        }
    }
}