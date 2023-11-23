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
        <h1 class="text-4xl text-zinc-50 text-center font-medium mb-4">Register</h1>
        <form method="POST" action="{{ url('/auth/register') }}" class="w-full bg-white rounded-xl py-14 px-20">
            @csrf
            <div class="mb-5 flex flex-col">
                <input type="text" name="name" id="name" class="w-[25rem] py-1.5 px-4 rounded-full shadow-lg text-lg" placeholder="Name" required>
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-5 flex flex-col">
                <input type="text" name="username" id="username" class="w-[25rem] py-1.5 px-4 rounded-full shadow-lg text-lg" placeholder="Username" required>
                @error('username')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-5 flex flex-col">
                <input type="email" name="email" id="email" class="w-[25rem] py-1.5 px-4 rounded-full shadow-lg text-lg" placeholder="Email" required>
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-5 flex flex-col">
                <input type="password" name="password" id="password" class="w-[25rem] py-1.5 px-4 rounded-full shadow-lg text-lg" placeholder="Password" required>
                @error('password')
                    <span class="text-sm italic text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-center mb-4">
                <button type="submit" class="w-52 text-white bg-[#62aac2] hover:bg-cyan-700 focus:outline-none focus:ring-4 focus:ring-cyan-300 font-semibold rounded-full px-5 py-2.5 text-center me-2 mb-2 transition-all ease-in duration-150">Register</button>
            </div>
            <div class="flex justify-center">
                <span class="text-center">Already have an account? <a href="{{ url('/') }}" class="text-blue-500 underline">Log In</a></span>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>
</html>
