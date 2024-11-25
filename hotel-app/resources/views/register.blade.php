<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('{{ asset('storage/images/hall.jpeg') }}');">
    <div class="w-full max-w-lg bg-white bg-opacity-90 rounded-lg shadow-lg p-8">
        <h2 class="text-4xl font-extrabold text-gray-900 text-center mb-6">Create Your Account</h2>
        <p class="text-gray-600 text-center mb-8">Fill in the details to register</p>
        <form action="{{route('register')}}" method="POST">
            @csrf 
            <!-- Name Field -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" required
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <!-- Email Field -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" required
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>
            </div>
            <!-- Register Button -->
            <button type="submit"
                class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Register
            </button>
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        </form>
        <!-- Already have an account -->
        <p class="mt-6 text-center text-gray-600">
            Already have an account?
            <a href="#" class="text-indigo-600 font-medium hover:underline">Sign in</a>
        </p>
    </div>
</body>
</html>
