<?php

use Illuminate\Database\Seeder;
use App\Title;

class TitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Title::create([
            "name" => "Chair"
        ]);
        Title::create([
            "name" => "Advisor"
        ]);
    }
}
