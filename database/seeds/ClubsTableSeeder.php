<?php

use Illuminate\Database\Seeder;

class ClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clubs')->insert([
          [
            'nama_klub' => 'PB Bima Sakti',
            'alamat' => 'Badung',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now()
          ],
          [
            'nama_klub' => 'Porwaja Denpasar',
            'alamat' => 'Denpasar',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now()
          ]
        ]);
    }
}
