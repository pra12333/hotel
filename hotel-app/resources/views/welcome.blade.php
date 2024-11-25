<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Living</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@9/swiper-bundle.min.css" />
</head>
<body class="bg-gray-100 relative">
    <!-- Top Bar -->
    <div class="bg-blue-100 text-gray-700 text-sm py-2">
        <div class="container mx-auto flex justify-between items-center">
            <div>
                <span>📍 Colombo, Sri Lanka</span> | <span>📞 0123456789</span>
            </div>
            <div class="flex items-center space-x-4">
            <div class="flex space-x-4">
    <a href="{{route('login')}}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300">
        Login
    </a>
    <a href="{{ route('register') }}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition duration-300">
    Signup
</a>

</div>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-google"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="bg-blue-900 text-white">
    <div class="container mx-auto flex justify-between items-center py-4">
    <div class="text-2xl font-bold">
        <a href="#">
            <img src="{{ asset('storage/images/royal.jpg') }}" alt="E Hotel Logo" class="h-12">
        </a>
    </div>
   
            <ul class="flex space-x-6">
                <li><a href="#" class="hover:text-blue-300">Home</a></li>
                <li><a href="#" class="hover:text-blue-300">About</a></li>
                <li><a href="#" class="hover:text-blue-300">Services</a></li>
                <li><a href="#" class="hover:text-blue-300">Rooms</a></li>
                <li><a href="#" class="hover:text-blue-300">Gallery</a></li>
                <li><a href="#" class="hover:text-blue-300">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section with Swiper Carousel -->
    <div class="swiper mySwiper relative h-[80vh] bg-cover bg-center">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('storage/images/bed.jpg') }}');">
                <div class="text-center text-white">
                    <h1 class="text-5xl font-bold mb-4">Welcome to eHotel</h1>
                    <p class="text-2xl mb-6">Luxury Living</p>
                    <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full">
                        Get Started →
                    </a>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('storage/images/room1.jpg') }}');">
    <a href="{{ route('rooms') }}" class="block w-full h-full text-white">
        <div class="flex flex-col items-center justify-center h-full text-center">
            <h1 class="text-5xl font-bold mb-4">Deluxe Room</h1>
            <p class="text-2xl mb-6">Experience the city view</p>
        </div>
    </a>
</div>
            <!-- Slide 3 -->
            <div class="swiper-slide flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('storage/images/room2.jpg') }}');">
                <div class="text-center text-white">
                    <h1 class="text-5xl font-bold mb-4">Executive Suite</h1>
                    <p class="text-2xl mb-6">Premium amenities with luxury</p>
                    <a href="{{ route('rooms') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full">
                        Book Now →
                    </a>
                </div>
            </div>
        </div>

        <!-- Left Arrow -->
        <button class="hero-arrows left-4 swiper-button-prev p-3 rounded-full shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <!-- Right Arrow -->
        <button class="hero-arrows right-4 swiper-button-next p-3 rounded-full shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <!-- Pagination Dots -->
        <div class="swiper-pagination"></div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-gray-900 text-gray-300 py-10">
        <div class="container mx-auto px-4">
            <!-- Social Media Links -->
            <div class="flex justify-center space-x-6 mb-6">
                <a href="#" class="text-gray-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 320 512">
                        <path d="M279.14 288l14.22-92.66h-88.91V141.09c0-25.35 12.42-50.06 52.24-50.06H293V6.26S277.2 0 248.33 0c-73.44 0-121.17 44.38-121.17 124.72v70.62H80v92.66h47.16V512h92.66V288z" />
                    </svg>
                </a>
                <a href="#" class="text-gray-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 512 512">
                        <path d="M459.4 151.7c.325 4.548 .325 9.097 .325 13.645 0 138.72-105.583 298.558-298.558 298.558A296.348 296.348 0 0 1 0 393.528a214.667 214.667 0 0 0 25.045 1.465 208.515 208.515 0 0 0 129.127-44.843A104.146 104.146 0 0 1 20.804 296.8c5.806 .97 11.579 1.615 17.435 1.615 8.516 0 16.933-1.135 24.854-3.269a104.16 104.16 0 0 1-83.675-102.156v-1.338a104.59 104.59 0 0 0 47.045 13.114 104.156 104.156 0 0 1-32.247-138.881 295.787 295.787 0 0 0 214.505 108.972A117.917 117.917 0 0 1 110.455 58.88a104.113 104.113 0 0 1 48.439 13.334c15.674-3.084 30.889-8.832 44.263-16.765a104.15 104.15 0 0 1-46.211 57.527c13.874-1.544 27.238-5.369 39.446-10.931a104.465 104.465 0 0 1-26.0 26.961z" />
                    </svg>
                </a>
                <a href="#" class="text-gray-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 496 512">
                        <path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 .3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5 .3-6.2 2.3zm44.2-1.7c-2.9 .7-4.9 2.6-4.6 4.9 .3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8z" />
                    </svg>
                </a>
                <a href="#" class="text-gray-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 448 512">
                        <path d="M100.3 480H7.4V165.9h92.9zm-46.4-366C24.8 114 0 89.2 0 58.8 0 27.6 24.8 0 55.6 0c30.8 0 55.6 27.6 55.6 58.8 0 30.4-24.8 55.2-55.6 55.2zM447.8 480H354.9v-167c0-40.4-14.5-68-50.7-68-27.6 0-44 18.5-51.3 36.4-2.6 6.4-3.3 15.2-3.3 24V480h-92.9s1.2-287 0-317.1h92.9v45c12.4-19.2 34.6-46.4 84.1-46.4 61.4 0 107.4 40 107.4 125.8V480z" />
                    </svg>
                </a>
            </div>

            <!-- Footer Links -->
            <div class="text-center text-sm">
                <p>&copy; 2024 eHotel. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/swiper@9/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.mySwiper', {
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 5000,
                },
                slidesPerView: 1,
                spaceBetween: 20,
            });
        });
    </script>
</body>
</html>
