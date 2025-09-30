<aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 border-r border-gray-100 lg:border-r lg:flex lg:flex-col">
    <div class="p-6 border-b border-gray-100 flex-shrink-0">
        <h2 class="text-xl font-bold text-gray-800 tracking-tight">Karang Duren Arsip</h2>
    </div>
    <nav class="p-4 flex-grow overflow-y-auto">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-3 text-gray-600 rounded-xl transition-all duration-200 hover:bg-blue-50 hover:text-blue-600 hover:shadow-sm group {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-500' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3 {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-400' }}"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('arsip.index') }}"
                    class="flex items-center p-3 text-gray-600 rounded-xl transition-all duration-200 hover:bg-blue-50 hover:text-blue-600 hover:shadow-sm group {{ request()->routeIs('arsip.*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-500' : '' }}">
                    <i class="fas fa-folder-open mr-3 {{ request()->routeIs('arsip.*') ? 'text-blue-600' : 'text-gray-400' }}"></i>
                    <span class="font-medium">Arsip</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kategori-surat.index') }}"
                    class="flex items-center p-3 text-gray-600 rounded-xl transition-all duration-200 hover:bg-blue-50 hover:text-blue-600 hover:shadow-sm group {{ request()->routeIs('kategori-surat.*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-500' : '' }}">
                    <i class="fas fa-file-alt mr-3 {{ request()->routeIs('kategori-surat.*') ? 'text-blue-600' : 'text-gray-400' }}"></i>
                    <span class="font-medium">Kategori Surat</span>
                </a>
            </li>
            <li>
                <a href="{{ route('about') }}"
                    class="flex items-center p-3 text-gray-600 rounded-xl transition-all duration-200 hover:bg-blue-50 hover:text-blue-600 hover:shadow-sm group {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-500' : '' }}">
                    <i class="fas fa-info-circle mr-3 {{ request()->routeIs('about') ? 'text-blue-600' : 'text-gray-400' }}"></i>
                    <span class="font-medium">About</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
<div id="sidebar-backdrop" class="fixed inset-0 z-20 bg-black bg-opacity-50 hidden transition-opacity duration-300 ease-in-out lg:hidden" onclick="toggleSidebar()"></div>
