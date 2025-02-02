<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Booking - E Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold text-center mb-6">Modify Your Booking</h1>
        <form action="{{ route('booking.edit', $booking->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="check_in">Check-in Date</label>
        <input 
            type="date" 
            id="check_in" 
            name="check_in" 
            value="{{ old('check_in', $booking->check_in) }}" 
            class="w-full px-3 py-2 border rounded @error('check_in') border-red-500 @enderror"
        >
        @error('check_in')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="check_out">Check-out Date</label>
        <input 
            type="date" 
            id="check_out" 
            name="check_out" 
            value="{{ old('check_out', $booking->check_out) }}" 
            class="w-full px-3 py-2 border rounded @error('check_out') border-red-500 @enderror"
        >
        @error('check_out')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="adults">Number of Adults</label>
        <input 
            type="number" 
            id="adults" 
            name="adults" 
            value="{{ old('adults', $booking->adults) }}" 
            class="w-full px-3 py-2 border rounded @error('adults') border-red-500 @enderror"
        >
        @error('adults')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('confirmation', $booking->id) }}" 
           class="bg-gray-300 text-gray-700 py-2 px-4 rounded hover:bg-gray-400">
            Cancel
        </a>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Save Changes
        </button>
    </div>
    @foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach



</form>

        
    </div>
</body>
</html>
