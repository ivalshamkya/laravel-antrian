<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite('resources/css/app.css')
</head>
<body class="antialiased bg-[#62aac2] flex flex-col justify-center items-center">
    <div class="max-w-3xl mt-5">
        <h1 class="text-4xl text-zinc-50 text-center font-medium mb-4">Login</h1>
        <form method="post" action="{{ route('login') }}" class="w-full bg-white rounded-xl py-14 px-20">
            @csrf
            <div class="mb-5">
                <input type="text" name="username" id="username" class="w-[25rem] py-1.5 px-4 rounded-full shadow-lg text-lg" placeholder="Username" required>
            </div>
            <div class="mb-5">
                <input type="password" name="password" id="password" class="w-[25rem] py-1.5 px-4 rounded-full shadow-lg text-lg" placeholder="Password" required>
            </div>
            <div class="flex justify-between mb-5">
                <div>
                    <input type="checkbox" class="rounded-full" name="remember" id="remember" value="true">
                    <label for="remember">Remember me?</label>
                </div>
                <a href="" class="underline">Forgot Password?</a>
            </div>
            <div class="flex justify-center mb-4">
                <button type="submit" class="w-52 text-white bg-[#62aac2] hover:bg-cyan-700 focus:outline-none focus:ring-4 focus:ring-cyan-300 font-semibold rounded-full px-5 py-2.5 text-center me-2 mb-2 transition-all ease-in duration-150">Login</button>
            </div>
            <div class="flex justify-center">
                <span class="text-center">Don`t have an account yet? <a href="{{ url('/register') }}" class="text-blue-500 underline">Register</a></span>
            </div>
        </form>
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
                let username = cookies['username'] || ""
                let password = cookies['password'] || ""
                attemptLogin(username, password);
            }
            
            $("#loginButton").on("click", function () {
                const username = $("#username").val();
                const password = $("#password").val();
                attemptLogin(username, password);
            });

            
            function rememberMe(username, password) {
                const expirationDate = new Date();
                expirationDate.setMonth(expirationDate.getMonth() + 1);
                document.cookie = `remember=true; username=${username}; password=${password}; expires=${expirationDate.toUTCString()}; path=/`;
            }


            function attemptLogin(username, password) {
                const rememberCheckbox = $("#remember");
                $.ajax({
                    url: "/login",
                    method: "POST",
                    data: {
                        username: username,
                        password: password,
                    },
                    success: function (data) {
                        alert(data.message);
                        if(rememberCheckbox.val() == "true") {
                            rememberMe(username, password);
                        }

                        if (data.success) {
                            window.location.href = "/dashboard";
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