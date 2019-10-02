<?php

use Illuminate\Database\Seeder;
use App\Models\Classification;

class ClassificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Classification::class, 20)->create();
        Classification::create(['name' => 'Accounting']);
        Classification::create(['name' => 'Advertising / Arts/Media / Exhibitions']);
        Classification::create(['name' => 'Banking']);
        Classification::create(['name' => 'Automibile / Automobile Parts']);
        Classification::create(['name' => 'Beauty / Hairdressing / Nail Care / Health Care']);
        Classification::create(['name' => 'Catering Industry']);

        Classification::create(['name' => 'Cleaning']);
        Classification::create(['name' => 'Clothing / FMCG / Daily Necessities']);
        Classification::create(['name' => 'Computer / Internet']);
        Classification::create(['name' => 'Education / Training / Agency']);
        Classification::create(['name' => 'Energy / Minerals']);

        Classification::create(['name' => 'Engineering/Construction/Decoration']);
        Classification::create(['name' => 'Entertainment/Leisure/Sports']);
        Classification::create(['name' => 'Environmental/Charity']);
        Classification::create(['name' => 'Financial Industry']);
        Classification::create(['name' => 'Furniture/Appliances/Toys']);
    
        Classification::create(['name' => 'Gaming']);
        Classification::create(['name' => 'Government/Public Utility']);
        Classification::create(['name' => 'Hotel/Travel']);
        Classification::create(['name' => 'Insurance']);
        Classification::create(['name' => 'Cleaning']);
    }
}
