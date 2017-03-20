<?php

use Illuminate\Database\Seeder;
use App\Manufacturer;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

         $this->call(TestCategoryTableSeeder::class);
         $this->call(RenalCategoryTableSeeder::class);
         $this->call(LiverCategoryTableSeeder::class);
         $this->call(DiabetesCategoryTableSeeder::class);
         $this->call(LipidCategoryTableSeeder::class);
         $this->call(OtherCategoryTableSeeder::class);
    }
}
