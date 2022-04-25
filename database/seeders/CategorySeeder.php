<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['title' => 'Danh mục cha 01', 'slug' => Str::slug('Danh mục cha 01'), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
            ['title' => 'Danh mục cha 02', 'slug' => Str::slug('Danh mục cha 02'), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
        
        $parentIds = DB::table('categories')->pluck('id')->toArray();
        
        DB::table('categories')->insert([
            ['title' => 'Danh mục con 01', 'slug' => Str::slug('Danh mục con 01'), 'parent_id' =>  $this->getRandomId($parentIds), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Danh mục con 02', 'slug' => Str::slug('Danh mục con 02'), 'parent_id' =>  $this->getRandomId($parentIds), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Danh mục con 03', 'slug' => Str::slug('Danh mục con 03'), 'parent_id' =>  $this->getRandomId($parentIds), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Danh mục con 04', 'slug' => Str::slug('Danh mục con 04'), 'parent_id' =>  $this->getRandomId($parentIds), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }

    private function getRandomId($arr) {
        return Arr::random($arr, 1)[0];
    }
}