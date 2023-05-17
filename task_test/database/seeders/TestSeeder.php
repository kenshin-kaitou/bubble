<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("tests")->insert([
            [
                "text" => "aaa",
                "created_at" => Now()
            ],
            [
                "text" => "bbb",
                "created_at" => Now()
            ]
        ]);
    }
}
