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

    <body>
    @include('user.navbar')
    
    <div class="mb-5 sm:mb-10 lg:mb-20 relative">
        <div class="bg-cover">
            <img class="" src="{{ URL('images/general/streetcropped.jpg') }}"alt=""/>
        </div>
        <div class="flex absolute inset-0 justify-center items-center space-x-3">
            <img class="w-[100px]" src="{{ asset('logos/uptrendnobg.png') }}" alt="Logo">
        </div>
    </div>

    
    <div class="mt-10 sm:mt-20">
            <div class="flex justify-center items-center flex-col">
                <p class="font-bold text-2xl sm:font-extrabold sm:text-6xl mb-2 text-center">KEEP UP WITH THE TREND</p>
                <p class="mb-6 text-center">Elevate your look with UP Trend.</p>
                <a href="/shop_page" class="bg-black text-white font-medium px-3 py-1 rounded-3xl">Shop Now</a>
            </div>
    </div>

    <div class="p-10 sm:p-20">
    <div>
        <p class="font-semibold text-2xl sm:font-medium sm:text-2xl">Popular products</p>
    </div>
    
    <div class="flex justify-center mt-4 sm:mt-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($popularProducts as $product)
                <div class="">
                    <div class="items-center justify-center">
                        <a href="{{ url('product_details', $product->product_id) }}" class="">
                            <img src="/product/{{$product->image1}}" alt="{{ $product->product_title }}" class="object-cover">
                        </a>
                    </div>
                    <div class="py-4">
                        <p class="text-lg font-semibold">{{ $product->product_title }}</p>
                        <p class="text-gray-500">{{ $product->description}}</p>
                        <div class="mt-2">
                            <p class="text-lg">₱{{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    </div>
    </body>
</html>