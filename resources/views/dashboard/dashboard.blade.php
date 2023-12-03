@extends('template.template')
@section('content')
    <nav class="flex mb-7" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                <ion-icon name="home" class="me-1.5"></ion-icon>
                Beranda
                </a>
            </li>
        </ol>
    </nav>
    <h1 class="text-xl mb-7">Beranda</h1>
    <div class="flex items-center gap-5">
        <a href="{{ route('antrian') }}" class="w-[200px] flex items-center gap-3 bg-[#95c6d7c7] text-zinc-800 p-5 rounded-lg shadow hover:scale-[1.03] transition-all ease-linear duration-150">
            <ion-icon name="volume-high" class="text-5xl"></ion-icon>
            <h1 class="text-lg font-medium">Antrian</h1>
        </a>
        <a href="{{ route('rekapdata') }}" class="w-[200px] flex items-center gap-3 bg-[#95c6d7c7] text-zinc-800 p-5 rounded-lg shadow hover:scale-[1.03] transition-all ease-linear duration-150">
            <ion-icon name="file-tray-full" class="text-5xl"></ion-icon>
            <h1 class="text-lg font-medium">Rekap Data</h1>
        </a>
    </div>
@endsection