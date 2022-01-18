<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('websites')->insert([
            'name' => "Everything Sports",
            'link' => "https://everythingsports.com"
        ]);

        DB::table('websites')->insert([
            'name' => "Everything tech",
            'link' => "https://everythingtech.com"
        ]);

        DB::table('websites')->insert([
            'name' => "Everything movies",
            'link' => "https://everythingmovies.com"
        ]);
    }
}
