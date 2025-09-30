<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Informasi tentang pembuat aplikasi
        $pengembang = [
            'nama' => 'Guna Darma Wangsa Negara',
            'foto' => 'img/guna.png',
            'prodi' => 'DIII - Manajeman Informatika Pamekasan',
            'nim' => '2231750013',
            'tanggal' => '2025-01-01'
        ];

        return view('about.index', compact('pengembang'));
    }
}
