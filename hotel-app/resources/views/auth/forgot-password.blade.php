<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-blue-500">
    <div class="bg-white p-10 rounded-xl shadow-xl w-[420px]">
        <h2 class="text-3xl font-bold text-gray-700 text-center mb-4">Forgot Password</h2>
        <p class="text-md text-gray-600 text-center mb-6">Enter your email to receive a reset link</p>

        <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" required
                    class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition duration-300">
                Send Reset Link
            </button>
        </form>

        @if(session('success'))
            <p class="mt-4 text-green-600 text-center text-lg font-medium">{{ session('success') }}</p>
        @endif
    </div>
</body>
</html>

