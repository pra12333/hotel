<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('{{ asset('storage/images/hotel.jpg') }}');">
    <div class="w-full max-w-md bg-white bg-opacity-90 rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-6">Welcome Back!</h2>
        <p class="text-gray-600 text-center mb-8">Sign in to your account</p>
        <form method="POST" action="{{route('login')}}">
            @csrf 
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" required
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>
                <a href="#" class="text-sm text-indigo-600 hover:underline">Forgot your password?</a>
            </div>
            <button type="submit"
                class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Sign In
            </button>
        </form>
        <p class="mt-6 text-center text-gray-600">
            Don't have an account?
            <a href="#" class="text-indigo-600 font-medium hover:underline">Sign up</a>
        </p>
    </div>
</body>
</html>
