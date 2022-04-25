<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->insert([
            ['firstname' => 'Ánh', 'lastname' => 'Nguyễn Nhật', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
            ['firstname' => 'Việt', 'lastname' => 'Nguyễn Phong', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
            ['firstname' => 'Hữu', 'lastname' => 'Tố', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
            ['firstname' => 'Hoài', 'lastname' => 'Tô', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
            ['firstname' => 'Diệu', 'lastname' => 'Xuân', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
            ['firstname' => 'Cao', 'lastname' => 'Nam', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
        ]);
    }
}
