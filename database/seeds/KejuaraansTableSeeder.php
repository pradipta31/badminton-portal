<?php

use Illuminate\Database\Seeder;

class KejuaraansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kejuaraans')->insert([
          [
            'nama_kejuaraan' => 'STIKOM Badminton CUP IV',
            'kategori' => 'Siswa Nasional',
            'kabupaten' => 'Denpasar',
            'tgl_mulai' => '2016-09-29',
            'tgl_akhir' => '2016-10-02',
            'batas_pendaftaran' => '2016-09-26',
            'status_berkas' => 'belum',
            'created_at' => now(),
            'updated_at' => now()
          ],
          [
            'nama_kejuaraan' => 'Djarum Sirnas',
            'kategori' => 'Siswa Nasional',
            'kabupaten' => 'Denpasar',
            'tgl_mulai' => '2017-10-08',
            'tgl_akhir' => '2017-10-10',
            'batas_pendaftaran' => '2017-10-05',
            'status_berkas' => 'belum',
            'created_at' => now(),
            'updated_at' => now()
          ]
        ]);
    }
}
