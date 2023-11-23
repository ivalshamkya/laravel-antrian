<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased bg-[#62aac2] flex flex-col justify-center items-center">
    <div class="max-w-3xl mt-5">
        <h1 class="text-4xl text-zinc-50 text-center font-medium mb-4">Login</h1>
        <div class="w-full bg-white rounded-xl py-14 px-20">
            <div id="alert" class="hidden items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium" id="alert-text">
                  
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert" aria-label="Close">
                  <span class="sr-only">Close</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                </button>
            </div>
            <div class="mb-5 flex flex-col">
                <input type="text" name="username" id="username" class="w-[25rem] py-1.5 px-4 rounded-full shadow-lg text-lg" placeholder="Username" required>
                @error('username')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-5 flex flex-col">
                <input type="password" name="password" id="password" class="w-[25rem] py-1.5 px-4 rounded-full shadow-lg text-lg" placeholder="Password" required>
                @error('password')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-between mb-5">
                <div>
                    <input type="checkbox" class="rounded-full" name="remember" id="remember" value="true">
                    <label for="remember">Remember me?</label>
                </div>
                <a href="" class="underline">Forgot Password?</a>
            </div>
            <div class="flex justify-center mb-4">
                <button type="button" id="loginButton" class="w-52 text-white bg-[#62aac2] hover:bg-cyan-700 focus:outline-none focus:ring-4 focus:ring-cyan-300 font-semibold rounded-full px-5 py-2.5 text-center me-2 mb-2 transition-all ease-in duration-150">Login</button>
            </div>
            <div class="flex justify-center">
                <span class="text-center">Don`t have an account? <a href="{{ url('/register') }}" class="text-blue-500 underline">Register</a></span>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {

            function parseCookies() {
                return document.cookie.split(';').reduce(function (acc, cookie) {
                    const [key, value] = cookie.trim().split('=');
                    acc[key] = decodeURIComponent(value);
                    return acc;
                }, {});
            }

            const cookies = parseCookies();
            
            const isRememberMe = cookies['remember'] === 'true' ? true : false;

            console.log(isRememberMe)

            if (isRememberMe) {
                let username = cookies['username']
                let password = cookies['password']
                console.log(cookies['username'])
                $('#username').val(username);
                $('#password').val(password);
            }
            
            $("#loginButton").on("click", function () {
                const username = $("#username").val();
                const password = $("#password").val();
                attemptLogin(username, password);
            });

            
            function rememberMe(username, password) {
                const expirationDate = new Date();
                expirationDate.setMonth(expirationDate.getMonth() + 1);
                document.cookie = `remember=true; expires=${expirationDate.toUTCString()}; path=/`;
                console.log(document.cookie)
            }


            function attemptLogin(username, password) {
                const rememberCheckbox = $("#remember");
                $.ajax({
                    url: "/auth/login",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        username: username,
                        password: password,
                        remember: rememberCheckbox.val()
                    },
                    success: function (data) {
                        console.log(data)
                        
                        if (data.success) {
                            let user_data = JSON.parse(data.user_data.value);
                            alert(data.message);
                            if(rememberCheckbox.val() == "true") {
                                const expirationDate = new Date();
                                expirationDate.setMonth(expirationDate.getMonth() + 1);
                                document.cookie = `remember=true; expires=${expirationDate.toUTCString()}; path=/`;
                                document.cookie = `username=${user_data.username}; expires=${expirationDate.toUTCString()}; path=/`;
                                document.cookie = `password=${user_data.password}; expires=${expirationDate.toUTCString()}; path=/`;
                            }
                            window.location.href = "/dashboard";
                        }
                        else {
                            $('#alert').removeClass('hidden').addClass('flex');
                            $('#alert-text').text(data.message);
                        }
                    },
                    error: function () {
                        alert("Error occurred during login.");
                    },
                });
            }
        });
    </script>
</body>
</html>