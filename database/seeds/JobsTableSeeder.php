<?php

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Classification;
use App\Models\Type;
use App\Models\Employer;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employerUser = Employer::first();

        $jobs = factory(Job::class, 50)->create([
            'employer_id' => $employerUser->id
        ]);
        $jobs->each(function ($job) {
            $randNumOfRow = rand(1, 3);
            $classifications = Classification::orderByRaw('RAND()')->take($randNumOfRow)->get();
            $job->classifications()->sync($classifications);
        });
    }
}
