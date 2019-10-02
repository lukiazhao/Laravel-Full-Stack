<?php

use Illuminate\Database\Seeder;
use App\Models\Type;
use App\Models\Classification;
use App\Models\Job;
use App\Models\User;
use App\Models\CompanySize;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ClassificationsTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(JobsTableSeeder::class);
    }
}
