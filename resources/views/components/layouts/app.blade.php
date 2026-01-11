<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background-color: #f8f7f4;
        }

        .main-container {
            width: 80%;
            margin: 0 auto;
            margin: 20px auto; 
            max-width: 1400px;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        @livewire('navigation')
        <main class="flex-grow">
            <div class="main-container px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
