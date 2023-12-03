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
            Edit
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
    <h1 class="text-xl mb-7">Edit Rekap Data</h1>

    <div class="w-full flex items-center gap-5">
        <div class="w-full relative outline outline-zinc-300/70 shadow rounded-lg p-5">
            <form class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <input type="hidden" class="hidden" name="id" id="id" value="{{ $data->id }}">
                <div class="space-y-1.5">
                    <label for="created_at">Tanggal</label>
                    <input type="date" name="created_at" id="created_at" value="{{ date_format($data->created_at, 'Y-m-d') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Tanggal" required>
                </div>
                <div class="space-y-1.5">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" value="{{ $data->jumlah }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Jumlah" required>
                </div>
                <div class="">
                    <button type="button" id="save-btn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 focus:outline-none">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $('#save-btn').click(() => {
            var id = $('#id').val();
            var jumlah = $('#jumlah').val();
            var created_at = $('#created_at').val();

            $.ajax({
                url: '/api/antrian/edit',
                type: 'PUT',
                data: {
                    id: id,
                    jumlah: jumlah,
                    created_at: created_at,
                },
                success: function (response) {
                    console.log('Update successful:', response);
                    alert('Antrian berhasil diupdate!');
                    window.location.reload();
                },
                error: function (error) {
                    console.error('Update failed:', error);
                    alert('Antrian gagal diupdate!');
                }
            });
        });
    </script>
@endsection