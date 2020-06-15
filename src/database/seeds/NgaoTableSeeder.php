<?php

use Illuminate\Database\Seeder;

class NgaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Ussd::class, 30)->create();
    }
}
