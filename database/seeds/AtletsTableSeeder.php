<?php

use Illuminate\Database\Seeder;

class AtletsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('atlets')->insert([
          [
            'id_klub' => 1,
            'kode_atlet' => 'DNP001',
            'nama' => 'Rafif',
            'tempat_lahir' => 'Denpasar',
            'tgl_lahir' => '2009-01-01',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now()
          ],
          [
            'id_klub' => 2,
            'kode_atlet' => 'ANP001',
            'nama' => 'Kholil Cahyadi',
            'tempat_lahir' => 'Surabaya',
            'tgl_lahir' => '2008-02-02',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now()
          ]
        ]);
    }
}
