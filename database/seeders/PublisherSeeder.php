<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publishers')->insert([
            ['name' => 'Nhà xuất bản Chính trị Quốc gia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Nhà xuất bản Tư pháp', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Nhà xuất bản Hồng Đức', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Nhà xuất bản Quân đội', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Nhà xuất bản Kim Đồng', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Nhà xuất bản Lao động', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
