<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Review - E Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .star {
            cursor: pointer;
            transition: color 0.2s;
        }
        .star:hover {
            color: #fbbf24; /* Tailwind yellow-400 */
        }
        .selected {
            color: #f59e0b; /* Tailwind yellow-500 */
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-blue-900 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold">
                <a href="#" class="hover:text-blue-300">E Hotel</a>
            </div>
            <div class="flex items-center space-x-6">
                <a href="#" class="hover:text-blue-300">Home</a>
                <a href="#" class="hover:text-blue-300">Bookings</a>
                <a href="#" class="hover:text-blue-300">Contact</a>
                <form action= "{{route('logout') }}" method="POST">
                    @csrf 
                    <button type="button" onclick="showLogoutModal()" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
    Logout
</button>
</form>
            </div>
        </div>
    </nav>

    <!-- Review Page Content -->
    <main class="container mx-auto py-10">
        <h1 class="text-4xl font-extrabold text-gray-800 text-center mb-8">Post a Review</h1>
        
        <div class="bg-white shadow-lg rounded-lg p-6">
            <form id= "reviewForm" action="{{route('review.store',['roomId' => $room->id]) }} " method="POST" class="space-y-6">
                @csrf 
                <input type="hidden" name="room_id" value="{{$room->id}}">
                <!-- Hotel Information -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Hotel Name: <span class="font-medium">E Hotel</span></h2>
                    <p class="text-gray-600"><span class="font-bold">Stayed:</span> 2024-12-01 to 2024-12-05</p>
                </div>

                <!-- Star Rating -->
                <div>
                    <label class="block text-gray-600 font-bold mb-2">Rating</label>
                    <div id="star-container" class="flex space-x-2 text-gray-400 text-3xl">
                        <!-- Stars (Interactive) -->
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                    <input type="hidden" name="rating" id="rating" required>
                    <p id= "ratingError" class="text-red-500 text-sm hidden">Please select a rating. </p>
                </div>

                <!-- Review Text -->
                <div>
                    <label class="block text-gray-600 font-bold mb-2">Your Review</label>
                    <textarea 
                    name="review" 
    id="reviewText" 
    rows="6" 
    class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500" 
    placeholder="Write about your experience..."
    required></textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="button" onclick="submitReview()" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-8 rounded-lg shadow font-bold">
                        Submit Review
                    </button>
                </div>
            </form>
        </div>
    </main>
    <!-- Logout Confirmation Modal -->
<div id="logoutModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
        <h2 class="text-lg font-bold text-gray-800">Confirm Logout</h2>
        <p class="text-gray-600 mt-2">Are you sure you want to log out?</p>
        <div class="flex justify-end space-x-4 mt-4">
            <button onclick="closeLogoutModal()" class="bg-gray-300 text-gray-700 py-2 px-4 rounded hover:bg-gray-400">
                Cancel
            </button>
            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-6 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 E Hotel. All Rights Reserved.</p>
        </div>
    </footer>
<!-- Script for Star Rating and Ajax -->
 <script>
const stars = document.querySelectorAll(".star");
        const ratingInput = document.getElementById("rating");
        const ratingError = document.getElementById("ratingError");

        stars.forEach(star => {
            star.addEventListener("mouseover", () => {
                const value = star.getAttribute("data-value");
                highlightStars(value);
            });

            star.addEventListener("click", () => {
                const value = star.getAttribute("data-value");
                ratingInput.value = value;
                highlightStars(value, true);
                ratingError.classList.add("hidden");
            });
        });

        function highlightStars(value, isPermanent = false) {
            stars.forEach(star => {
                const starValue = star.getAttribute("data-value");
                if (starValue <= value) {
                    star.classList.add(isPermanent ? "selected" : "hover");
                } else {
                    star.classList.remove("selected", "hover");
                }
            });
        }
        function submitReview() {
    const reviewText = document.querySelector("textarea[name='review']").value;
    const rating = ratingInput.value;
    const roomId = document.querySelector("input[name='room_id']").value;

    if (!rating) {
        ratingError.classList.remove("hidden");
        return;
    }

    fetch('{{ route('review.store',['roomId' => $room->id]) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify({ review: reviewText, rating: rating,room_id: roomId })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert(data.message);
            document.getElementById("reviewForm").reset();
            highlightStars(0, true);
        } else {
            alert("Failed to submit the review: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error submitting review:", error);
        alert("An error occurred. Please try again.");
    });
}
// Modal Functions
function showLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }
        
    </script>

</body>
</html>
