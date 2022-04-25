<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            ['name' => 'Tiếng Anh', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tiếng Việt', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tiếng Nga', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tiếng Trung Quốc', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tiếng Đức', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tiếng Pháp', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
