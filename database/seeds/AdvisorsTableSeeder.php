<?php

use App\Advisor;
use Illuminate\Database\Seeder;

class AdvisorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Advisor::create([
            "name" => "Tolga Ayav",
            "area" => "Formal Methods for Software Testing, Testing of Hardware Components and System-on-Chip, Real-Time and Fault-Tolerant Embedded Systems",
            "title_id" => "1",
        ]);
        Advisor::create([
            "name" => "Onur Demirörs",
            "area" => "software process improvement, process models: methods, tools, techniques, business process management, software quality management, software measurement, software project management and conceptual modelling",
            "title_id" => "2",
        ]);
        Advisor::create([
            "name" => "Serap Şahin",
            "area" => "",
            "title_id" => "2",
        ]);
        Advisor::create([
            "name" => "Yusuf Murat Erten",
            "area" => "",
            "title_id" => "2",
        ]);
        Advisor::create([
            "name" => "Selma Tekir",
            "area" => "text mining, news analysis, overlapping community detection, and information warfare",
            "title_id" => "2",
        ]);

    }
}
