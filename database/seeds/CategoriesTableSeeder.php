<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
          [
            'kode_kategori' => '1',
            'kategori' => 'Tunggal Dini Putra',
            'deskripsi' => 'Kategori tunggal dini putra (6-9 Tahun)',
            'created_at' => now(),
            'updated_at' => now()
          ],
          [
            'kode_kategori' => '1',
            'kategori' => 'Tunggal Anak-Anak Putra',
            'deskripsi' => 'Kategori tunggal anak-anak putra (10-11 Tahun)',
            'created_at' => now(),
            'updated_at' => now()
          ],
          [
            'kode_kategori' => '2',
            'kategori' => 'Ganda Anak-Anak Putra',
            'deskripsi' => 'Kategori ganda anak-anak putra (10-11 Tahun)',
            'created_at' => now(),
            'updated_at' => now()
          ]
        ]);
    }
}
