<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barang')->insert([
            [
                'kode_barang' => 'BRG001',
                'nama_barang' => 'Barang A',
                'harga' => 10000,
                'stok' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG002',
                'nama_barang' => 'Barang B',
                'harga' => 15000,
                'stok' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG003',
                'nama_barang' => 'Barang C',
                'harga' => 20000,
                'stok' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data barang lainnya sesuai kebutuhan
        ]);
    }
}
