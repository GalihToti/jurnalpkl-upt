<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SI-PRAKERIN')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/GalihToti/jurnalpkl-upt@main/public/build/app-Fb7wQ0u4.css">
    @stack('styles')
</head>

<body class="font-sans bg-gray-50 min-h-screen pt-16">

    {{-- Navbar --}}
    <nav id="navbar" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 shadow-lg fixed top-0 left-0 w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            {{-- Logo dan Brand --}}
            <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                <img src="{{ asset('images/logo.png') }}" alt="Logo SIPRAKERIN" 
                     class="h-10 w-auto group-hover:scale-110 transition-transform duration-300">
                <span class="text-xl font-bold tracking-wide">SI-PRAKERIN</span>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center space-x-8">
                <a href="/" 
                   class="font-medium transition-all duration-300 
                   {{ request()->is('/') ? 'text-yellow-300' : 'text-gray-100 hover:text-yellow-300' }}">
                   Beranda
                </a>
                <a href="/prakerin/create" 
                   class="font-medium transition-all duration-300 
                   {{ request()->is('prakerin/create') ? 'text-yellow-300' : 'text-gray-100 hover:text-yellow-300' }}">
                   Pendaftaran
                </a>
                <a href="/prakerin" 
                   class="font-medium transition-all duration-300 
                   {{ request()->is('prakerin') ? 'text-yellow-300' : 'text-gray-100 hover:text-yellow-300' }}">
                   Detail Prakerin
                </a>
                <a href="/jurnal/create" 
                   class="font-medium transition-all duration-300 
                   {{ request()->is('jurnal/create') ? 'text-yellow-300' : 'text-gray-100 hover:text-yellow-300' }}">
                   Jurnal
                </a>
                <a href="/jurnal" 
                   class="font-medium transition-all duration-300 
                   {{ request()->is('jurnal') ? 'text-yellow-300' : 'text-gray-100 hover:text-yellow-300' }}">
                   Detail Jurnal
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button id="menu-btn" class="md:hidden text-white hover:scale-110 transition-transform duration-300 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="md:hidden hidden mt-4 space-y-2 max-w-7xl mx-auto">
            <a href="/" 
               class="block py-3 px-4 rounded-lg transition-all duration-300 
               {{ request()->is('/') ? 'bg-yellow-300 text-[#3b5b8c] font-semibold' : 'text-gray-100 hover:bg-white/10' }}">
               Beranda
            </a>
            <a href="/prakerin/create" 
               class="block py-3 px-4 rounded-lg transition-all duration-300 
               {{ request()->is('prakerin/create') ? 'bg-yellow-300 text-[#3b5b8c] font-semibold' : 'text-gray-100 hover:bg-white/10' }}">
               Pendaftaran
            </a>
            <a href="/jurnal/create" 
               class="block py-3 px-4 rounded-lg transition-all duration-300 
               {{ request()->is('jurnal/create') ? 'bg-yellow-300 text-[#3b5b8c] font-semibold' : 'text-gray-100 hover:bg-white/10' }}">
               Jurnal
            </a>
            <a href="/prakerin" 
               class="block py-3 px-4 rounded-lg transition-all duration-300 
               {{ request()->is('prakerin') ? 'bg-yellow-300 text-[#3b5b8c] font-semibold' : 'text-gray-100 hover:bg-white/10' }}">
               Detail Prakerin
            </a>
            <a href="/jurnal" 
               class="block py-3 px-4 rounded-lg transition-all duration-300 
               {{ request()->is('jurnal') ? 'bg-yellow-300 text-[#3b5b8c] font-semibold' : 'text-gray-100 hover:bg-white/10' }}">
               Detail Jurnal
            </a>
        </div>
    </nav>

    {{-- Content --}}
    <main class="container mx-auto mt-4">
        @yield('content')
    </main>

    <script>
        // Mobile menu toggle
        document.getElementById('menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            const icon = this.querySelector('i');
            
            menu.classList.toggle('hidden');
            
            // Change icon
            if (menu.classList.contains('hidden')) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            } else {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            }
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.remove('bg-[#3b5b8c]');
                navbar.classList.add('bg-[#3b5b8c]/95', 'backdrop-blur-sm');
            } else {
                navbar.classList.add('bg-[#3b5b8c]');
                navbar.classList.remove('bg-[#3b5b8c]/95', 'backdrop-blur-sm');
            }
        });

        // Close mobile menu on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                const menu = document.getElementById('mobile-menu');
                const icon = document.querySelector('#menu-btn i');
                if (menu && !menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                    if (icon) {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                }
            }
        });
    </script>

    @stack('scripts')
    @yield('scripts')
</body>

</html>