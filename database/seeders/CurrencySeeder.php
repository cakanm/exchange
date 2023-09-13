<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->truncate();

        DB::table('currencies')->insert([
            'name' => 'Euro',
            'code' => 'EUR',
            'rate' => 0.884872,
            'surcharge_percent' => 5,
            'discount_percent' => 2,
            'created_at' => Carbon::now()
        ]);

        DB::table('currencies')->insert([
            'name' => 'British Pound',
            'code' => 'GBP',
            'rate' => 0.711178,
            'surcharge_percent' => 5,
            'send_email' => true,
            'created_at' => Carbon::now()
        ]);
        DB::table('currencies')->insert([
            'name' => 'Yen',
            'code' => 'JPY',
            'rate' => 107.17,
            'surcharge_percent' => 7.5,
            'created_at' => Carbon::now()
        ]);
    }
}
