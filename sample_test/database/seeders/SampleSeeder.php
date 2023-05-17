<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("samples")->insert([
        [
            "text" => "sample",
            "created_at" => Now()
        ],
            
        [
            "text" => "test",
            "created_at" => Now()
        ]
        ]);
    }
}
