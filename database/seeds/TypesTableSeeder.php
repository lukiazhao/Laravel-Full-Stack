<?php

use Illuminate\Database\Seeder;
use App\Models\Type;
use App\Models\Job;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create(['name' => 'Contract']);
        Type::create(['name' => 'Volunteer']);
        Type::create(['name' => 'Part time']);
        Type::create(['name' => 'Full time']);
        Type::create(['name' => 'Casual']);
        Type::create(['name' => 'Intern']);
    }
}
