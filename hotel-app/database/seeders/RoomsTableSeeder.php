<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    public function run()
    {
        // Truncate the rooms table to avoid duplicates
        DB::table('rooms')->truncate();

        $roomTypes = [
            'Deluxe Room' => [
                'description' => 'A luxurious deluxe room with all modern amenities.',
                'price_range' => [250, 350],
                'max_children' => 2,
                'max_adults' => 2,
                'free_pickup' => true,
                'is_ac' => true, // AC
                'image' => 'room1.jpg',
            ],
            'Single Room' => [
                'description' => 'A cozy single room for solo travelers.',
                'price_range' => [80, 120],
                'max_children' => 0,
                'max_adults' => 1,
                'free_pickup' => false,
                'is_ac' => false, // Non-AC
                'image' => 'room1.jpg',
            ],
            'Double Room' => [
                'description' => 'A spacious room with two beds, perfect for small families.',
                'price_range' => [150, 200],
                'max_children' => 2,
                'max_adults' => 2,
                'free_pickup' => false,
                'is_ac' => true, // AC
                'image' => 'room1.jpg',
            ],
            'Penthouse Suite' => [
                'description' => 'An extravagant suite with stunning views and luxurious facilities.',
                'price_range' => [500, 700],
                'max_children' => 3,
                'max_adults' => 3,
                'free_pickup' => true,
                'is_ac' => true, // AC
                'image' => 'room1.jpg',
            ],
            'Presidential Suite' => [
                'description' => 'The ultimate in luxury with exclusive amenities and services.',
                'price_range' => [800, 1200],
                'max_children' => 4,
                'max_adults' => 4,
                'free_pickup' => true,
                'is_ac' => true, // AC
                'image' => 'room2.jpg',
            ],
            'Triple Room' => [
                'description' => 'Perfect for groups or families of three.',
                'price_range' => [200, 300],
                'max_children' => 2,
                'max_adults' => 3,
                'free_pickup' => false,
                'is_ac' => false, // Non-AC
                'image' => 'room2.jpg',
            ],
            'Executive Room' => [
                'description' => 'A premium room with additional work-friendly amenities.',
                'price_range' => [300, 400],
                'max_children' => 1,
                'max_adults' => 2,
                'free_pickup' => true,
                'is_ac' => true, // AC
                'image' => 'room2.jpg',
            ],
            'Queen’s Room' => [
                'description' => 'A regal room with a queen-size bed and elegant decor.',
                'price_range' => [200, 300],
                'max_children' => 1,
                'max_adults' => 2,
                'free_pickup' => false,
                'is_ac' => false, // Non-AC
                'image' => 'room1.jpg',
            ],
        ];

        $rooms = [];

        foreach ($roomTypes as $type => $details) {
            $numberOfRooms = rand(10, 20); // Generate 10-20 rooms per type

            for ($i = 1; $i <= $numberOfRooms; $i++) {
                $price = rand($details['price_range'][0], $details['price_range'][1]);
                $rooms[] = [
                    'room_type' => $type,
                    'description' => $details['description'],
                    'price' => $price,
                    'price_range' => '$' . $details['price_range'][0] . ' - $' . $details['price_range'][1],
                    'is_ac' => $details['is_ac'], // Add AC/Non-AC status
                    'available_from' => now()->format('Y-m-d'),
                    'available_to' => now()->addDays(rand(30, 60))->format('Y-m-d'),
                    'available_rooms' => rand(1, 5),
                    'max_children' => $details['max_children'],
                    'max_adults' => $details['max_adults'],
                    'free_pickup' => $details['free_pickup'],
                    'image' => $details['image'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Batch insert the rooms in chunks of 1000
        foreach (array_chunk($rooms, 1000) as $chunk) {
            DB::table('rooms')->insert($chunk);
        }

        // Output a success message
        $this->command->info('Rooms table seeded successfully with AC and Price Range!');
    }
}
