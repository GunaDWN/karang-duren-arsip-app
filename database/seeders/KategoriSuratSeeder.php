<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriSurat;

class KategoriSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            [
                'nama' => 'Surat Masuk',
                'keterangan' => 'Surat yang diterima dari pihak eksternal'
            ],
            [
                'nama' => 'Surat Keluar',
                'keterangan' => 'Surat yang dikirim ke pihak eksternal'
            ],
            [
                'nama' => 'Nota Dinas',
                'keterangan' => 'Catatan internal untuk menyampaikan informasi atau instruksi'
            ],
            [
                'nama' => 'Surat Perintah',
                'keterangan' => 'Dokumen yang berisi perintah dari atasan'
            ],
            [
                'nama' => 'Surat Tugas',
                'keterangan' => 'Dokumen penugasan kepada staf'
            ]
        ];

        foreach ($kategori as $item) {
            KategoriSurat::create($item);
        }
    }
}
