<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Avatar;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $avatars = [
            [
                'name' => 'Superhero Avatar',
                'price' => 110,
                'image' => 'assets/superhero_avatar.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cartoon Avatar',
                'price' => 40,
                'image' => 'assets/cartoon_avatar.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Animal Avatar',
                'price' => 20,
                'image' => 'assets/animal_avatar.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fantasy Avatar',
                'price' => 150,
                'image' => 'assets/fantasy_avatar.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($avatars as $avatar) {
            Avatar::create($avatar);
        }
    }
}
