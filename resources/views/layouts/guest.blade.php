<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="icon" href="{{ url('images/tuki.ico') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="bg-blue-gray-800">
    <div class="grid grid-cols-3 ">
        <div class="flex justify-center items-center">
            <img src="/images/NDB.png" alt="NDB Logo" class="w-6/12">
        </div>
        <div class="flex justify-center items-center">
            <img src="/images/tuki.png" alt="Tuki Logo" class="w-8/12">
        </div>
        <div class="flex justify-center items-center">
            <img src="/images/Kaspersky.png" alt="Kaspersky Logo" class="w-8/12">
        </div>
    </div>
    <div class="font-sans text-gray-900 antialiased container mx-auto -mt-12">
        {{ $slot }}
    </div>
    <footer>
        <div
            class=" text-blue-gray-500 my-6 flex items-center justify-center w-10/12 mx-auto bg-blue-gray-900 rounded-md p-5 border-collapse shadow-2xl ring-offset-purple-600 bg-blend-darken">
            <span>© Copyright 2021</span>
            <span class="hover:text-yellow-900 text-yellow-500">
                <a href="/">
                    Tuki Challenge
                </a></span>.
            <span class="">Todos los derechos reservados. Desarrollado por
                <a class="text-yellow-500" href="https://jsonnan.com">
                    Jasson López
                </a>
            </span>
        </div>
    </footer> @livewireScripts
</body>

</html>
