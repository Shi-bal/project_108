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

        @if(session()->has('error'))
            <div class="flex justify-center items-center w-full fixed top-0 right-0 left-0 z-50">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white bg-opacity-90 rounded-lg shadow">
                        <button type="button" class="close absolute top-3 end-2.5 text-gray-500 hover:text-red-500 " data-dismiss="alert" onclick="closeAlert()">
                            <i class="ph-bold ph-x"></i>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <h3 class="mt-5 mb-5 text-lg font-normal text-red-500">{{ session()->get('error') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(session()->has('message'))
            <div class="flex justify-center items-center w-full fixed top-0 right-0 left-0 z-50">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white bg-opacity-90 rounded-lg shadow">
                        <button type="button" class="close absolute top-3 end-2.5 text-gray-500 hover:text-red-500 " data-dismiss="alert" onclick="closeAlert()">
                            <i class="ph-bold ph-x"></i>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <h3 class="mt-5 mb-5 text-lg font-normal text-green-500">{{ session()->get('message') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <?php $shippingFee = 300; ?>

        <section class="bg-white py-8 antialiased md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl">Shopping Cart</h2>

                <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                    <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                        <div class="space-y-6">
                            <?php $totalprice=0; ?>
                            @foreach($cartItems as $item)
                            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm md:p-6">
                                    <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                        <a href="#" class="shrink-0 md:order-1">
                                            <img class="h-40" src="{{ $item->image1 }}" alt="Product Image" class="object-cover size-14 hover-image pb-[2px] hover:bg-black">
                                        </a>
                                        <div class="flex items-center justify-between md:order-3 md:justify-end">
                                            <div class="text-end md:order-4 md:w-32">
                                                <p class="text-base font-bold text-gray-900 ">₱{{ number_format($item->price, 2) }}</p>
                                            </div>
                                        </div>
                                        <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                            <div>
                                                <a href="#" class="text-base font-medium text-gray-900 hover:underline ">{{ $item->product_title }}</a>
                                            </div>
                                            <div class="flex items-center gap-4">
                                                <p class="text-sm font-medium hover:underline">{{ $item->size }}</p>
                                                <a href="">
                                                    <button type="submit" class="text-sm font-medium hover:underline text-red-600">
                                                        <i class="fa-solid fa-x me-1.5 text-red-600"></i> Remove
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <?php $totalprice = $totalprice + $item->price ?>
                        </div>
                    </div>

                    <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                        <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
                            <p class="text-xl font-semibold text-gray-900">Cart summary</p>

                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="text-base font-normal text-gray-500">Bag</dt>
                                        <dd class="text-base font-medium text-gray-900 ">₱{{ number_format($item->price * $item->quantity, 2) }}</dd>
                                    </dl>
                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="text-base font-normal text-gray-500">Shipping Fee</dt>
                                        <dd class="text-base font-medium text-gray-900 ">₱{{ number_format($shippingFee, 2) }}</dd>
                                    </dl>
                                </div>

                                <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                    <dt class="text-base font-bold text-gray-900">Total</dt>
                                    <dd class="text-base font-bold text-gray-900">₱{{ number_format($totalprice + $shippingFee, 2) }}</dd>
                                </dl>
                            </div>

                            <form action="" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center rounded-lg bg-black px-5 py-2.5 text-sm font-medium text-white">
                                    Proceed to checkout
                                </button>
                            </form>

                            <div class="flex items-center justify-center gap-2">
                                <span class="text-sm font-normal text-gray-500">or</span>
                                <a href="/userpage" title="" class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline">
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </body>
</html>
