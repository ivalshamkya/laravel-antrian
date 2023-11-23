@extends('template.header')
<body class="antialiased">
    <nav class="fixed top-0 left-0 right-0 bg-[#c7e4e8] text-white pl-72">
        <div class="w-screen mx-auto flex items-center justify-between">
            <div class="flex items-center w-[577px] justify-between">
                <button class="text-3xl" id="sidebar-toggle">
                    <ion-icon name="menu"></ion-icon>
                </button>
            </div>
            <div class="flex justify-between">
                <button class="bg-purple-200 px-[36px] py-[10px] rounded-[47px]">
                    <p class="text-purple-700">Sign in</p>
                </button>
                <button class="bg-purple-600 px-[36px] py-[10px] rounded-[47px]">
                    <p class="text-white">Sign Up</p>
                </button>
            </div>
        </div>
    </nav>
    <aside class="w-72 h-screen bg-[#62aac2] p-5 fixed top-0 z-10 transition-transform transform -translate-x-full" id="sidebar"> <!-- Added 'fixed' and adjusted top position -->
        <h1 class="text-white text-3xl text-center mb-5">Antrian</h1>
        <ul class="gap-6 space-y-5">
            <li class="group"><a href="" class="w-full flex items-center gap-2 text-white font-semibold text-xl"><ion-icon name="home"></ion-icon>Beranda</a></li>
            <li class="group"><a href="" class="w-full flex items-center gap-2 text-white font-semibold text-xl"><ion-icon name="volume-high"></ion-icon>Antrian</a></li>
            <li class="group"><a href="" class="w-full flex items-center gap-2 text-white font-semibold text-xl"><ion-icon name="document-outline"></ion-icon>Rekap Data</a></li>
        </ul>
    </aside>
    <main class="ml-72 flex gap-5 mt-[100px]"> <!-- Adjusted margin-top to account for the fixed navbar -->
        @yield('content')
        @extends('template.footer')
    </main>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        document.getElementById('sidebar-toggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        });
    </script>
</body>
</html>
