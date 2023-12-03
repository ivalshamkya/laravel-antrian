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
                <a href="{{ route('antrian') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                Antrian
                </a>
            </li>
        </ol>
    </nav>
    <h1 class="text-xl mb-14">Antrian</h1>
    <div class="w-full flex flex-col justify-center items-center">
        <h1 class="text-2xl mb-2">Nomor Antrian:</h1>
        <div class="max-w-md w-full flex flex-col justify-center items-center h-80 text-zinc-800 bg-white p-5 border border-zinc-300 rounded-lg shadow">
            <h1 class="text-center my-auto text-7xl font-semibold" id="nomor">
                000
            </h1>
            <div class="w-full flex flex-row justify-between items-center">
                <button type="button" id="prev-antrian" class="p-3 rounded-full">
                    <ion-icon name="play-skip-back" class="text-3xl text-zinc-500 hover:text-zinc-800"></ion-icon>
                </button>
                <button type="button" id="next-antrian" class="p-3 rounded-full">
                    <ion-icon name="play-skip-forward" class="text-3xl text-zinc-500 hover:text-zinc-800"></ion-icon>
                </button>
            </div>
        </div>
        <div class="max-w-md w-full grid grid-cols-3 justify-center items-center gap-2 mt-3">
            <div class="flex justify-start items-center">
                <button type="button" id="speak-button" class="group w-28 h-28 p-2 bg-white border border-zinc-300 rounded-lg shadow flex flex-col items-center justify-center transition-all ease-linear duration-100">
                    <ion-icon name="volume-high" class="text-3xl text-zinc-500 group-hover:text-blue-600"></ion-icon>
                    <h1 class="text-lg group-hover:text-blue-600">Panggil</h1>
                </button>
            </div>
            <div class="flex justify-center items-center">
                <button type="button" class="group w-28 h-28 p-2 bg-white border border-zinc-300 rounded-lg shadow flex flex-col items-center justify-center transition-all ease-linear duration-100">
                    <ion-icon name="print" class="text-3xl text-zinc-500 group-hover:text-zinc-800"></ion-icon>
                    <h1 class="text-lg">Cetak</h1>
                </button>
            </div>
            <div class="flex justify-end items-center">
                <button type="button" id="reset-antrian" class="group w-28 h-28 p-2 bg-white border border-zinc-300 rounded-lg shadow flex flex-col items-center justify-center transition-all ease-linear duration-100">
                    <ion-icon name="refresh" class="text-3xl text-zinc-500 group-hover:text-red-600"></ion-icon>
                    <h1 class="text-lg group-hover:text-red-600">Reset</h1>
                </button>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>

        const MAX_ANTRIAN = {{ Config::get('app.max_antrian') }};
        const CURRENT_DATE = new Date().toISOString().split('T')[0];

        console.log(CURRENT_DATE)

        $(document).ready(() => {
            var nomorAntrian = {{ $antrian->jumlah ? $antrian->jumlah : 1 }};

            $('#nomor').text(nomorAntrian.toString().padStart(3, '0'));

            var textArea = $("#nomor");
            var speakButton = $("#speak-button");
    
            speakButton.on("click", () => {
                let text = parseInt(textArea.text());

                var speech = new SpeechSynthesisUtterance(text);
                var voices = window.speechSynthesis.getVoices();

                speech.default = false;

                speech.voice = voices.filter(function(voice) { return voice.name == 'Google ID English Female'; })[0];

                speech.lang = 'id-ID';

                window.speechSynthesis.speak(speech);
                
            });

            $('#prev-antrian').on('click', () => {
                if(nomorAntrian > 1) {

                    var formData = new FormData();
                    formData.append('created_at', CURRENT_DATE);

                    nomorAntrian -= 1;

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '/api/antrian/decrease',
                        type: 'PUT',
                        data: {
                            'created_at': CURRENT_DATE
                        },
                        success: function (response) {
                            console.log('Update successful:', response);
                            updateNomorAntrian(nomorAntrian);
                        },
                        error: function (error) {
                            console.error('Update failed:', error);
                        }
                    });
                }
            });
            
            $('#next-antrian').on('click', () => {
                if(nomorAntrian < MAX_ANTRIAN) {

                    var formData = new FormData();
                    formData.append('created_at', CURRENT_DATE);

                    nomorAntrian += 1;

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '/api/antrian/increase',
                        type: 'PUT',
                        data: {
                            'created_at': CURRENT_DATE
                        },
                        success: function (response) {
                            console.log('Update successful:', response);
                            updateNomorAntrian(nomorAntrian);
                        },
                        error: function (error) {
                            console.error('Update failed:', error);
                        }
                    });
                }
            });

            $('#reset-antrian').on('click', () => {

                var formData = new FormData();
                formData.append('created_at', CURRENT_DATE);

                nomorAntrian = 1;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/api/antrian/reset',
                    type: 'PUT',
                    data: {
                        'created_at': CURRENT_DATE
                    },
                    success: function (response) {
                        console.log('Update successful:', response);
                        updateNomorAntrian(nomorAntrian);
                    },
                    error: function (error) {
                        console.error('Update failed:', error);
                    }
                });
            });
        });

        function updateNomorAntrian( nomor = 1 ) 
        {
            $('#nomor').text(nomor.toString().padStart(3, '0'));
        }

    </script>
@endsection