<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

        public function run() {

            DB::table('Admins')->insert([
                'name' => 'Mahmud Naseem',
                'email' => 'mhmnaseem@gmail.com',
                'password' => bcrypt('Don@web5!'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ]);

            DB::table('Admins')->insert([
                'name' => 'Don',
                'email' => 'donlmudalige@gmail.com',
                'password' => bcrypt('Don@web5!'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ]);
        }

}
