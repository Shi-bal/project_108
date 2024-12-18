<div class="sticky top-0 z-10">
    <nav class="w-full flex justify-between p-2 sm:p-4 lg:px-32 md:px-20 sm:px-14 items-center bg-white shadow-md">
        <div class="flex space-x-4 sm:space-x-8">
        <div class="flex justify-center">
            <a href="/"><img class="w-[30px] sm:w[30px] md:w-[40px]" src="{{ asset('logos/uptrend.png') }}" alt="Logo"></a>
        </div>
        <div class="flex items-center justify-center">
            <a href="/shop_page" class="font-semibold text-lg"> Shop</a>
        </div>
        </div>

        <div class="">
            <div class="space-x-4">
                <!-- Search Icon with Animated Input Field -->
                <div class="relative inline-block">
                    <form id="searchForm" action="{{ route('shop_page') }}" method="GET" class="relative inline-block">
                        <button id="searchButton" class="inline-flex items-center justify-center focus:outline-none" type="button">
                            <i id="searchIcon" class="ph-bold ph-magnifying-glass"></i>
                        </button>
                        <input
                            id="searchBar"
                            name="query"
                            type="text"
                            class="absolute right-0 bg-slate-100 ring-1 ring-black ring-opacity-5 opacity-0 invisible transition-all duration-200 w-0 h-6 focus:w-48 focus:opacity-100 focus:visible focus:px-4 focus:py-2 focus:border-black focus:ring-black" 
                            placeholder="Search"
                            onkeyup="fetchSuggestions()">
                    </form>

                    <!-- Auto-suggest Results -->
                    <ul id="suggestions" class="absolute right-0 bg-white border w-48 mt-1 hidden max-h-40 overflow-y-auto z-10"></ul>
                </div>

                <script>
                    document.getElementById('searchButton').addEventListener('click', function(event) {
                        event.stopPropagation();
                        var searchBar = document.getElementById('searchBar');
                        var searchIcon = document.getElementById('searchIcon');
                        
                        // Toggle search bar visibility
                        if (searchBar.classList.contains('w-0')) {
                            searchBar.classList.remove('w-0', 'opacity-0', 'invisible');
                            searchBar.classList.add('w-48', 'opacity-100', 'visible');
                            searchIcon.classList.add('hidden');
                            searchBar.focus();
                        } else {
                            // Check if input is not empty
                            if (searchBar.value.trim() !== "") {
                                document.getElementById('searchForm').submit(); // Submit the form
                            } else {
                                searchBar.classList.remove('w-48', 'opacity-100', 'visible');
                                searchBar.classList.add('w-0', 'opacity-0', 'invisible');
                                searchIcon.classList.remove('hidden');
                            }
                        }
                    });

                    document.addEventListener('click', function(event) {
                        var searchBar = document.getElementById('searchBar');
                        var searchIcon = document.getElementById('searchIcon');
                        var suggestions = document.getElementById('suggestions');
                        if (!document.getElementById('searchButton').contains(event.target) && !searchBar.contains(event.target)) {
                            searchBar.classList.remove('w-48', 'opacity-100', 'visible');
                            searchBar.classList.add('w-0', 'opacity-0', 'invisible');
                            searchIcon.classList.remove('hidden');
                            suggestions.classList.add('hidden');
                        }
                    });

                    // Function to fetch search suggestions
                    function fetchSuggestions() {
                        const query = document.getElementById('searchBar').value;

                        if (query.length > 2) {  // Trigger suggestions only if query length is greater than 2
                            fetch(`/search-suggestions?q=${query}`)
                                .then(response => response.json())
                                .then(data => {
                                    const suggestionsContainer = document.getElementById('suggestions');
                                    suggestionsContainer.innerHTML = '';
                                    
                                    if (data.length > 0) {
                                        suggestionsContainer.classList.remove('hidden');
                                        data.forEach(product => {
                                            const li = document.createElement('li');
                                            li.classList.add('px-4', 'py-2', 'cursor-pointer');
                                            li.textContent = product.product_title;
                                            li.onclick = function() {
                                                document.getElementById('searchBar').value = product.product_title;
                                                document.getElementById('searchForm').submit();
                                            };
                                            suggestionsContainer.appendChild(li);
                                        });
                                    } else {
                                        suggestionsContainer.classList.add('hidden');
                                    }
                                });
                        } else {
                            document.getElementById('suggestions').classList.add('hidden');
                        }
                    }
                </script>

                <!-- User Icon with Dropdown -->
                <div class="relative inline-block group">
                    <!-- Trigger button with User Icon -->
                    <button class="inline-flex items-center justify-center focus:outline-none">
                        <i class="ph-bold ph-user"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="origin-top-right absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-focus-within:opacity-100 group-focus-within:visible transition-all duration-200">
                        <div class="py-1" role="menu" aria-orientation="vertical">
                            @if (Route::has('login'))
                                @auth
                                    <!-- Logout Option -->
                                    <form class="hover:bg-gray-100" method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="font-semibold block px-4 py-2 text-sm text-gray-700" role="menuitem">
                                            Logout
                                        </button>
                                    </form>
                                @else
                                    <!-- Login and Register Links -->
                                    <a href="{{ route('login') }}" class="font-semibold block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Login</a>
                                    <a href="{{ route('register') }}" class="font-semibold block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Register</a>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Heart Icon -->
                <a href="{{route('wishlist.view')}}">
                    <button><i class="ph-bold ph-heart-straight"></i></button>
                </a>

                <!-- Bag Icon with Order Dropdown -->
                <div class="relative inline-block group">
                    <!-- Trigger button with Bag Icon -->
                    <a href="{{ route('showcart.view') }}">
                        <button><i class="ph-bold ph-bag"></i></button>
                    </a>

                    <!-- Dropdown Menu for Order (only visible when logged in) -->
                    @auth
                    <div class="origin-top-right absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-focus-within:opacity-100 group-focus-within:visible transition-all duration-200">
                        <div class="py-1" role="menu" aria-orientation="vertical">



                            <form class="hover:bg-gray-100" method="GET" action="/show_cart">
                                @csrf
                                <button type="submit" class="font-semibold block px-4 py-2 text-sm text-gray-700" role="menuitem">
                                    Bag
                                </button>
                            </form>
                            <form class="hover:bg-gray-100" method="GET" action="{{route('order.page')}}">
                                @csrf
                                <button type="submit" class="font-semibold block px-4 py-2 text-sm text-gray-700" role="menuitem">
                                    Order
                                </button>
                            </form>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</div>
