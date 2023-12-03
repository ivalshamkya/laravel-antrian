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
        <li class="inline-flex items-center">
            <ion-icon name="chevron-forward-outline"></ion-icon>
        </li>
        <li class="inline-flex items-center">
            <a href="{{ route('rekapdata') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
            Rekap Data
            </a>
        </li>
        <li class="inline-flex items-center">
            <ion-icon name="chevron-forward-outline"></ion-icon>
        </li>
        <li class="inline-flex items-center">
            <a href="" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
            {{ $data->id }}
            </a>
        </li>
        </ol>
    </nav>
    <h1 class="text-xl mb-7">Detail Rekap Data</h1>

    <div class="w-full flex items-center gap-5">
        <div class="w-full relative outline outline-zinc-300/70 shadow sm:rounded-lg p-5">
            <h1 class="text-2xl font-semibold mb-3">{{ date_format($data->created_at, 'l, d F Y') }}</h1>
            <h1 class="text-xl text-zinc-600">Jumlah antrian: <span class="text-zinc-900 font-semibold">{{ $data->jumlah }}</span></h1>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function deleteAntrian(id) {
            if(confirm('Apakah kamu yakin untuk hapus data antrian ini?')) {
                if(id > 0) {
                    $.ajax({
                        url: '/api/antrian/' + id,
                        type: 'DELETE',
                        success: function (response) {
                            console.log('Delete successful:', response);
                            alert('Antrian berhasil dihapus!');
                            window.location.reload();
                        },
                        error: function (error) {
                            console.error('Delete failed:', error);
                            alert('Antrian gagal dihapus!');
                        }
                    });
                }
            }
        }
    </script>
@endsection