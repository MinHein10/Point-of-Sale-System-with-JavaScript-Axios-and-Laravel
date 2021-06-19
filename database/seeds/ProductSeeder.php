<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'product_name'=>'Keyboard',
            'description'=>'Good keyboard',
            'brand'=>'Accer',
            'photo'=>null,
            'price'=>15000,
            'quantity'=>50,
            'alert_stock'=>80,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);

        DB::table('products')->insert([
            'product_name'=>'CPU',
            'description'=>'Good CPU',
            'brand'=>'Intel',
            'photo'=>null,
            'price'=>450000,
            'quantity'=>90,
            'alert_stock'=>40,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
    }
}
