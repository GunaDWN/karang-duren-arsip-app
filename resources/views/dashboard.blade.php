<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="text-sm text-gray-500">
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang di Sistem Arsip</h1>
                <p class="text-gray-600">Kelola dan pantau arsip surat dengan mudah</p>
            </div>

            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Arsip -->
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Arsip</p>
                            <p class="text-3xl font-bold text-gray-900" id="total-arsip">0</p>
                        </div>
                        <div class="p-3 rounded-full bg-blue-50 text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-xs text-gray-500">
                        <span class="text-green-600 font-medium" id="persentase-arsip">+0%</span> dari bulan lalu
                    </div>
                </div>

                <!-- Total Kategori -->
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Kategori</p>
                            <p class="text-3xl font-bold text-gray-900" id="total-kategori">0</p>
                        </div>
                        <div class="p-3 rounded-full bg-green-50 text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-xs text-gray-500">
                        Kategori surat tersedia
                    </div>
                </div>

                <!-- Arsip Bulan Ini -->
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-purple-500 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Arsip Bulan Ini</p>
                            <p class="text-3xl font-bold text-gray-900" id="arsip-bulan-ini">0</p>
                        </div>
                        <div class="p-3 rounded-full bg-purple-50 text-purple-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-xs text-gray-500">
                        {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Grafik Statistik Per Kategori -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Arsip per Kategori</h2>
                        <div class="flex space-x-2">
                            <button id="btn-pie" class="px-3 py-1 text-xs bg-blue-50 text-blue-600 rounded-lg font-medium">Pie Chart</button>
                            <button id="btn-bar" class="px-3 py-1 text-xs text-gray-500 hover:text-gray-700 rounded-lg font-medium">Bar Chart</button>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>

                <!-- Grafik Trend Bulanan -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Trend Arsip Bulanan</h2>
                        <div class="text-sm text-gray-500">
                            Tahun {{ date('Y') }}
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Daftar Arsip Terbaru -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
                <!-- Quick Actions -->
                <div class="bg-white p-6 rounded-xl shadow-sm lg:col-span-1">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Aksi Cepat</h2>
                    <div class="space-y-4">
                        <a href="{{ route('arsip.create') }}" class="flex items-center p-4 border border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition-colors duration-200 group">
                            <div class="p-2 rounded-lg bg-blue-100 text-blue-600 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 group-hover:text-blue-600">Tambah Arsip</p>
                                <p class="text-xs text-gray-500">Buat arsip baru</p>
                            </div>
                        </a>
                        <a href="{{ route('arsip.index') }}" class="flex items-center p-4 border border-gray-200 rounded-xl hover:border-green-500 hover:bg-green-50 transition-colors duration-200 group">
                            <div class="p-2 rounded-lg bg-green-100 text-green-600 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 group-hover:text-green-600">Lihat Arsip</p>
                                <p class="text-xs text-gray-500">Kelola semua arsip</p>
                            </div>
                        </a>
                        <a href="{{ route('kategori-surat.index') }}" class="flex items-center p-4 border border-gray-200 rounded-xl hover:border-purple-500 hover:bg-purple-50 transition-colors duration-200 group">
                            <div class="p-2 rounded-lg bg-purple-100 text-purple-600 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 group-hover:text-purple-600">Kategori</p>
                                <p class="text-xs text-gray-500">Kelola kategori</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Daftar Arsip Terbaru -->
                <div class="bg-white p-6 rounded-xl shadow-sm lg:col-span-2">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Arsip Terbaru</h2>
                        <a href="{{ route('arsip.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center">
                            Lihat Semua
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Surat</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="arsip-terbaru">
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                        <div class="flex justify-center">
                                            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                                        </div>
                                        <p class="mt-2">Memuat data...</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            let categoryChart, monthlyChart;
            let currentChartType = 'pie';

            // Inisialisasi chart
            function initCharts(categoriesData, monthlyData) {
                // Chart per Kategori
                const categoryCtx = document.getElementById('categoryChart').getContext('2d');

                const colors = [
                    '#3B82F6', '#10B981', '#8B5CF6', '#F59E0B', '#EF4444',
                    '#06B6D4', '#84CC16', '#F97316', '#8B5CF6', '#EC4899'
                ];

                if (currentChartType === 'pie') {
                    categoryChart = new Chart(categoryCtx, {
                        type: 'pie',
                        data: {
                            labels: categoriesData.labels,
                            datasets: [{
                                data: categoriesData.data,
                                backgroundColor: colors,
                                borderWidth: 2,
                                borderColor: '#fff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right',
                                    labels: {
                                        boxWidth: 12,
                                        padding: 15
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = Math.round((value / total) * 100);
                                            return `${label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                } else {
                    categoryChart = new Chart(categoryCtx, {
                        type: 'bar',
                        data: {
                            labels: categoriesData.labels,
                            datasets: [{
                                label: 'Jumlah Arsip',
                                data: categoriesData.data,
                                backgroundColor: '#3B82F6',
                                borderColor: '#2563EB',
                                borderWidth: 1,
                                borderRadius: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                }

                // Chart Trend Bulanan
                const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
                monthlyChart = new Chart(monthlyCtx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                        datasets: [{
                            label: 'Jumlah Arsip',
                            data: monthlyData,
                            borderColor: '#10B981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            }

            // Switch chart type
            $('#btn-pie').on('click', function() {
                if (currentChartType !== 'pie') {
                    currentChartType = 'pie';
                    $(this).addClass('bg-blue-50 text-blue-600').removeClass('text-gray-500');
                    $('#btn-bar').addClass('text-gray-500').removeClass('bg-blue-50 text-blue-600');
                    // Destroy and recreate chart with updated data
                    if (window.categoriesData) {
                        categoryChart.destroy();
                        initCharts(window.categoriesData, window.monthlyData);
                    }
                }
            });

            $('#btn-bar').on('click', function() {
                if (currentChartType !== 'bar') {
                    currentChartType = 'bar';
                    $(this).addClass('bg-blue-50 text-blue-600').removeClass('text-gray-500');
                    $('#btn-pie').addClass('text-gray-500').removeClass('bg-blue-50 text-blue-600');
                    // Destroy and recreate chart with updated data
                    if (window.categoriesData) {
                        categoryChart.destroy();
                        initCharts(window.categoriesData, window.monthlyData);
                    }
                }
            });

            // Ambil data statistik
            $.get('/api/arsip1', function(data) {
                // Total arsip
                $('#total-arsip').text(data.length);

                // Hitung arsip bulan ini dan bulan lalu
                const sekarang = new Date();
                const bulanIni = sekarang.getMonth();
                const tahunIni = sekarang.getFullYear();
                const bulanLalu = bulanIni === 0 ? 11 : bulanIni - 1;
                const tahunBulanLalu = bulanIni === 0 ? tahunIni - 1 : tahunIni;

                const arsipBulanIni = data.filter(arsip => {
                    const tanggal = new Date(arsip.tanggal);
                    return tanggal.getMonth() === bulanIni && tanggal.getFullYear() === tahunIni;
                });

                const arsipBulanLalu = data.filter(arsip => {
                    const tanggal = new Date(arsip.tanggal);
                    return tanggal.getMonth() === bulanLalu && tanggal.getFullYear() === tahunBulanLalu;
                });

                $('#arsip-bulan-ini').text(arsipBulanIni.length);

                // Hitung persentase
                const persentase = arsipBulanLalu.length > 0 ?
                    Math.round(((arsipBulanIni.length - arsipBulanLalu.length) / arsipBulanLalu.length) * 100) : 0;

                const persentaseElement = $('#persentase-arsip');
                if (persentase > 0) {
                    persentaseElement.text(`+${persentase}%`).removeClass('text-red-600').addClass('text-green-600');
                } else if (persentase < 0) {
                    persentaseElement.text(`${persentase}%`).removeClass('text-green-600').addClass('text-red-600');
                } else {
                    persentaseElement.text('0%').removeClass('text-green-600 text-red-600').addClass('text-gray-600');
                }

                // Data untuk chart per kategori
                const kategoriCount = {};
                data.forEach(arsip => {
                    const kategori = arsip.kategori?.nama || 'Tidak Berkategori';
                    kategoriCount[kategori] = (kategoriCount[kategori] || 0) + 1;
                });

                const categoriesData = {
                    labels: Object.keys(kategoriCount),
                    data: Object.values(kategoriCount)
                };

                // Data untuk chart bulanan
                const monthlyData = new Array(12).fill(0);
                data.forEach(arsip => {
                    const tanggal = new Date(arsip.tanggal);
                    if (tanggal.getFullYear() === tahunIni) {
                        monthlyData[tanggal.getMonth()]++;
                    }
                });

                // Simpan data untuk chart switching
                window.categoriesData = categoriesData;
                window.monthlyData = monthlyData;

                // Inisialisasi charts
                initCharts(categoriesData, monthlyData);

                // Tampilkan 5 arsip terbaru
                const arsipTerbaru = data
                    .sort((a, b) => new Date(b.tanggal) - new Date(a.tanggal))
                    .slice(0, 5);

                let arsipHtml = '';
                if (arsipTerbaru.length > 0) {
                    arsipTerbaru.forEach(arsip => {
                        const tanggalFormatted = new Date(arsip.tanggal).toLocaleDateString('id-ID', {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric'
                        });

                        arsipHtml += `
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">${arsip.nomor_surat}</div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="text-sm text-gray-900 font-medium">${arsip.judul}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">${tanggalFormatted}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        ${arsip.kategori?.nama || 'Tidak ada kategori'}
                                    </span>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    arsipHtml = `
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p>Belum ada data arsip</p>
                            </td>
                        </tr>
                    `;
                }

                $('#arsip-terbaru').html(arsipHtml);
            }).fail(function() {
                $('#arsip-terbaru').html(`
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-red-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p>Gagal memuat data arsip</p>
                        </td>
                    </tr>
                `);
            });

            // Ambil data kategori
            $.get('/api/kategori', function(kategoriData) {
                $('#total-kategori').text(kategoriData.length);
            }).fail(function() {
                $('#total-kategori').text('0');
            });
        });
    </script>
</x-app-layout>
