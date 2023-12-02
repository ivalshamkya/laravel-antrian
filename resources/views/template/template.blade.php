@extends('template.header')

<body class="antialiased">
    <nav class="fixed top-0 z-50 w-full px-1 md:px-14 bg-[#c7e4e8]">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-900 rounded-lg sm:hidden hover:bg-white focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="{{ route('dashboard') }}" class="flex ms-2 md:me-24">
                        <span
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">Antrian</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                    src="https://iconicentertainment.in/wp-content/uploads/2013/11/dummy-image-square.jpg"
                                    alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900" role="none">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Profile</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-[#62aac2] border-r border-gray-200 sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto ">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="#"
                        class="flex items-center p-1.5 rounded-lg text-white hover:bg-gray-100 group transition-all ease-in-out duration-300">
                        <ion-icon name="home"
                            class="p-2 border border-zinc-300 bg-white text-zinc-900 rounded-lg group-hover:border-zinc-700 group-hover:bg-zinc-800 group-hover:text-white"></ion-icon>
                        <span class="ms-3 group-hover:text-gray-900">Beranda</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-1.5 rounded-lg text-white hover:bg-gray-100 group transition-all ease-in-out duration-300">
                        <ion-icon name="volume-high"
                            class="p-2 border border-zinc-300 bg-white text-zinc-900 rounded-lg group-hover:border-zinc-700 group-hover:bg-zinc-800 group-hover:text-white"></ion-icon>
                        <span class="ms-3 group-hover:text-gray-900">Antrian</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-1.5 rounded-lg text-white hover:bg-gray-100 group transition-all ease-in-out duration-300">
                        <ion-icon name="document"
                            class="p-2 border border-zinc-300 bg-white text-zinc-900 rounded-lg group-hover:border-zinc-700 group-hover:bg-zinc-800 group-hover:text-white"></ion-icon>
                        <span class="ms-3 group-hover:text-gray-900">Rekap Data</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        
        <div class="p-4 border-gray-200 rounded-lg mt-14 h-screen">
            @yield('content')
        </div>
        @extends('template.footer')
    </div>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>