<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("shops")->insert([
            ["name" => "食パンや", "area_id" => "1"],
            ["name" => "パンや", "area_id" => "2"],
            ["name" => "フライパンや", "area_id" => "1"],
            ["name" => "メロンパンや", "area_id" => "3"]
        ]);
    }
}
