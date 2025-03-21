<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/bold/style.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>UP TREND</title>
</head>

<body>
    @include('user.navbar')
    <section class="bg-white py-8 antialiased md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                    <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                    <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl"><i class="ph-bold ph-package m-2"></i>Orders</h2>
                        <div class="mt-6">
                            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm md:p-6">
                                    <p class="text-green-500"><span class="font-bold text-black">Order Status: </span>To Receive</p>
                                    <div>
                                        <hr class="my-4 border-t-2 border-gray-200 w-full">
                                        <div class="space-y-4 md:flex md:gap-6 md:space-y-0">
                                            <a href="#" class="">
                                                <img class="h-40" src="{{ URL('images/shoes/aj1midwhite.jpg') }}" alt="Product" class="object-cover size-14 hover-image pb-[2px] hover:bg-black">
                                            </a>
                                            <div class="flex justify-between w-full">
                                                <div>
                                                <p class="text-base font-semibold">Product Name</p>
                                                <p class="text-base text-gray-400">Quantity: 1</p>
                                                </div>
                                                <p class="flex items-center text-base font-bold">₱999.00</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <hr class="my-4 border-t-2 border-gray-200 w-full">
                                        <div class="space-y-4 md:flex md:gap-6 md:space-y-0">
                                            <a href="#" class="">
                                                <img class="h-40" src="{{ URL('images/shoes/aj1midblackwhite.jpg') }}" alt="Product" class="object-cover size-14 hover-image pb-[2px] hover:bg-black">
                                            </a>
                                            <div class="flex justify-between w-full">
                                                <div>
                                                <p class="text-base font-semibold">Product Name</p>
                                                <p class="text-base text-gray-400">Quantity: 1</p>
                                                </div>
                                                <p class="flex items-center text-base font-bold">₱999.00</p>
                                            </div>
                                        </div>
                                    </div>
                                <hr class="my-4 border-t-2 border-gray-200 w-full">
                                <p class="text-end font-bold text-xl"><span class="text-base font-normal">Order Total: </span>₱1988.00</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

</body>
</html>