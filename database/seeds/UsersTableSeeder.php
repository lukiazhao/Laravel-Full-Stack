<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employer;
use App\Models\Employee;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employeeUser = factory(User::class)->create([
            'email' => 'employee@gmail.com',
            'is_employer' => false,
        ]);
        $employerUser = factory(User::class)->create([
            'email' => 'employer@gmail.com',
            'is_employer' => true,
            'api_token' => Str::random(60),
        ]);
        factory(Employer::class)->create([
            'user_id' => $employerUser->id,
            'business_name' => $employerUser->name,
        ]);
        factory(Employee::class)->create([
            'user_id' => $employeeUser->id
        ]);
    }
}
