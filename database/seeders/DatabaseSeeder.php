<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            // assignRoleSeeder::class,
            // assignAdminSeeder::class,
            // rolePermissionSeeder::class,
            // menuSeeder::class,
            // AddPlanSeeder::class,
            // homeCmsSeeder::class,
            // topGridSeeeder::class,
            // ottIconseeder::class,
            // entertainmentCmsSeeder::class,
            // contactCmsSeeder::class,
            // contactDetailsCms::class,
            // socialMediaCms::class,
            // planCmsSeeder::class,
            // contentTypeCmsSeeder::class,
            // EntertainmentBannerSeeder::class,
            // subscriptionCmsSeeder::class,
            // aboutCmsSeeder::class,
            // businessManagementSeeder::class,
            // footerCmsSeeder::class,
            // FaqSeeder::class,
            PaypalCredentialSeeder::class,

        ]);
    }
}
