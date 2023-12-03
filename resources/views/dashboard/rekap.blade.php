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
        </ol>
    </nav>
    <h1 class="text-xl mb-7">Rekap Data</h1>
    <div class="w-full flex items-center gap-5">
        <div class="w-full relative outline outline-zinc-300/70 shadow sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-slate-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal (D/M/Y)
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jumlah
                        </th>
                        <th scope="col" class="px-6 py-3 text-end">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($rekapdata) > 0)
                        
                    @foreach ($rekapdata as $data)    
                        <tr class="odd:bg-white even:bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium text-zinc-800 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4 text-zinc-800 whitespace-nowrap">
                                {{ date_format($data->created_at, 'd/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-zinc-800 whitespace-nowrap">
                                {{ $data->jumlah }}
                            </td>
                            <td class="px-6 py-4 flex justify-end"> 
                                <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots-{{ $loop->iteration }}" data-dropdown-placement="bottom" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300" type="button">
                                    <ion-icon name="ellipsis-vertical" class="text-xl text-zinc-800"></ion-icon>
                                </button>
                                
                                <div id="dropdownDots-{{ $loop->iteration }}" class="float-right z-10 hidden bg-white divide-y divide-gray-100 border rounded-lg shadow-lg w-44">
                                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownMenuIconButton">
                                        <li>
                                            <a href="{{ url('/rekapdata', $data->id) }}" class="flex items-center gap-1.5 px-4 py-2 hover:bg-gray-100">
                                                <ion-icon name="eye" class="text-lg"></ion-icon>
                                                View
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('edit-rekap', $data->id) }}" class="flex items-center gap-1.5 px-4 py-2 hover:bg-gray-100">
                                                <ion-icon name="create" class="text-lg"></ion-icon>
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="flex items-center gap-1.5 px-4 py-2 hover:bg-gray-100">
                                                <ion-icon name="print" class="text-lg"></ion-icon>
                                                Cetak
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="py-2">
                                        <button type="button" onclick="deleteAntrian({{ $data->id }})" class="del-btn w-full flex items-center gap-1.5 px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                                            <ion-icon name="trash" class="text-lg"></ion-icon>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="px-6 py-4 text-center text-zinc-700" colspan="4">
                                Belum ada data!
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
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