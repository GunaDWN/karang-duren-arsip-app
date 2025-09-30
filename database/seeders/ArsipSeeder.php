<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Arsip;

class ArsipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arsip = [
            [
                'nomor_surat' => '001/XXX/SET/2025',
                'judul' => 'Pengumuman Libur Tahun Baru Imlek',
                'tanggal' => '2025-01-28',
                'kategori_id' => 1,
                'file_path' => 'files/pengumuman_imlek.pdf'
            ],
            [
                'nomor_surat' => '002/XXX/SET/2025',
                'judul' => 'Permohonan Izin Penelitian',
                'tanggal' => '2025-02-15',
                'kategori_id' => 1,
                'file_path' => 'files/izin_penelitian.pdf'
            ],
            [
                'nomor_surat' => '003/XXX/SET/2025',
                'judul' => 'Laporan Kegiatan Tahunan',
                'tanggal' => '2025-03-10',
                'kategori_id' => 2,
                'file_path' => 'files/laporan_kegiatan.pdf'
            ],
            [
                'nomor_surat' => '004/XXX/SET/2025',
                'judul' => 'Undangan Rapat Koordinasi',
                'tanggal' => '2025-03-20',
                'kategori_id' => 3,
                'file_path' => 'files/undangan_rapat.pdf'
            ],
            [
                'nomor_surat' => '005/XXX/SET/2025',
                'judul' => 'Perintah Tugas Lapangan',
                'tanggal' => '2025-04-05',
                'kategori_id' => 4,
                'file_path' => 'files/perintah_tugas.pdf'
            ]
        ];

        foreach ($arsip as $item) {
            Arsip::create($item);
        }
    }
}
