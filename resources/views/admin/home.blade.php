
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css'); }}">
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/bold/style.css"/>
        <script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>UP TREND</title>
    </head>

    <body class=" bg-slate-100">
    @include('admin.navbar')
    <div class="p-4 sm:ml-64">
        <div class="grid grid-cols-3 space-x-4">
                <div class="bg-white p-4 rounded-md">
                    <p class="text-lg font-bold">Available Users:</p>
                    <p>{{ $userCount }}</p>
                </div>
                <div class="bg-white p-4 rounded-md">
                    <p class="text-lg font-bold"">Total Orders:</p>
                    <p>{{ $orderCount }}</p>
                </div>
                <div class="bg-white p-4 rounded-md">
                    <p class="text-lg font-bold"">Total Sales:</p>
                    <p>₱{{ $totalSales }}</p>
                </div>
            </div>
            
    </div>

    </body>
</html>
