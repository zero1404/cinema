<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            ['code' => Str::random(15), 'value' => 10000, 'type' => 'fixed', 'status' => 'active', 'times' => rand(10, 30), 'expiration_date' => date('d.m.Y', strtotime('+'.rand(5, 20).' days', strtotime(Date('Y-m-d H:i:s')))), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
            ['code' => Str::random(15), 'value' => 10, 'type' => 'percent', 'status' => 'active', 'times' => rand(10, 30), 'expiration_date' => date('d.m.Y', strtotime('+'.rand(5, 20).' days', strtotime(Date('Y-m-d H:i:s')))), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
            ['code' => Str::random(15), 'value' => 15000, 'type' => 'fixed', 'status' => 'active', 'times' => rand(10, 30), 'expiration_date' => date('d.m.Y', strtotime('+'.rand(5, 20).' days', strtotime(Date('Y-m-d H:i:s')))), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
            ['code' => Str::random(15), 'value' => 25000, 'type' => 'fixed', 'status' => 'active', 'times' => rand(10, 30), 'expiration_date' => date('d.m.Y', strtotime('+'.rand(5, 20).' days', strtotime(Date('Y-m-d H:i:s')))), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
            ['code' => Str::random(15), 'value' => 5, 'type' => 'percent', 'status' => 'active', 'times' => rand(10, 30), 'expiration_date' => date('d.m.Y', strtotime('+'.rand(5, 20).' days', strtotime(Date('Y-m-d H:i:s')))), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
            ['code' => Str::random(15), 'value' => 10000, 'type' => 'fixed', 'status' => 'active', 'times' => rand(10, 30), 'expiration_date' => date('d.m.Y', strtotime('+'.rand(5, 20).' days', strtotime(Date('Y-m-d H:i:s')))), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
            ['code' => Str::random(15), 'value' => 30000, 'type' => 'fixed', 'status' => 'active', 'times' => rand(10, 30), 'expiration_date' => date('d.m.Y', strtotime('+'.rand(5, 20).' days', strtotime(Date('Y-m-d H:i:s')))), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
        ]);
    }
}
