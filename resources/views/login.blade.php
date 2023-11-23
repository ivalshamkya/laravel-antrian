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
        <form class="w-full bg-white rounded-xl p-10">
            <div class="mb-5">
                <input type="text" name="username" class="w-96 py-1.5 px-4 rounded-full shadow-lg text-lg" placeholder="Username" required>
            </div>
            <div class="mb-5">
                <input type="password" name="password" class="w-96 py-1.5 px-4 rounded-full shadow-lg text-lg" placeholder="Password" required>
            </div>
            <div class="flex justify-between mb-5">
                <div>
                    <input type="checkbox" class="rounded-full" name="remember" id="remember" value="true">
                    <label for="remember">Remember me?</label>
                </div>
                <a href="" class="underline">Forgot Password?</a>
            </div>
            <div>
                <button class="submit" class="py-1.5 px-4 text-center rounded-full font-semibold bg-red-500">Login</button>
            </div>
        </form>
    </div>
</body>
</html>