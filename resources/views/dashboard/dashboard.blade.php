@extends('template.template')
@section('content')
    <nav class="flex mb-7" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
            </svg>
            Beranda
            </a>
        </li>
        </ol>
    </nav>
    <h1 class="text-xl mb-7">Beranda</h1>
    <div class="flex items-center gap-5">
        <a href="" class="w-[200px] flex items-center gap-3 bg-[#95c6d7c7] text-zinc-800 p-5 rounded-lg shadow hover:scale-[1.03] transition-all ease-linear duration-150">
            <ion-icon name="volume-high" class="text-5xl"></ion-icon>
            <h1 class="text-lg font-medium">Antrian</h1>
        </a>
        <a href="" class="w-[200px] flex items-center gap-3 bg-[#95c6d7c7] text-zinc-800 p-5 rounded-lg shadow hover:scale-[1.03] transition-all ease-linear duration-150">
            <ion-icon name="file-tray-full" class="text-5xl"></ion-icon>
            <h1 class="text-lg font-medium">Rekap Data</h1>
        </a>
    </div>
@endsection