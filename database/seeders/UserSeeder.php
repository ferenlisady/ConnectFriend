<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Billy Davidson',
                'email' => 'billydavidson@gmail.com',
                'gender' => 'male',
                'field_of_work' => 'Design, Art, Photography',
                'linkedin_username' => 'https://www.linkedin.com/in/billydavidson',
                'phone_number' => '089523456790',
                'current_job' => 'Designer',
                'password' => bcrypt(Str::random(8)),
                'profile_picture' => 'assets/profile1.jpg',
                'coin' => '100',
                'visibility' => true,
            ],
            [
                'name' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'gender' => 'male',
                'field_of_work' => 'marketing, business, sales',
                'linkedin_username' => 'https://www.linkedin.com/in/johndoe',
                'phone_number' => '089523456791',
                'current_job' => 'Marketing Manager',
                'password' => bcrypt(Str::random(8)),
                'profile_picture' => 'assets/profile2.jpg',
                'coin' => '100',
                'visibility' => true,
            ],
            [
                'name' => 'Alice Smith',
                'email' => 'alicesmith@gmail.com',
                'gender' => 'female',
                'field_of_work' => 'finance, consulting, accounting',
                'linkedin_username' => 'https://www.linkedin.com/in/alicesmith',
                'phone_number' => '089523456792',
                'current_job' => 'Financial Consultant',
                'password' => bcrypt(Str::random(8)),
                'profile_picture' => 'assets/profile3.jpg',
                'coin' => '100',
                'visibility' => true,
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bobjohnson@gmail.com',
                'gender' => 'male',
                'field_of_work' => 'engineering, construction, design',
                'linkedin_username' => 'https://www.linkedin.com/in/bobjohnson',
                'phone_number' => '089523456793',
                'current_job' => 'Civil Engineer',
                'password' => bcrypt(Str::random(8)),
                'profile_picture' => 'assets/profile4.jpg',
                'coin' => '100',
                'visibility' => true,
            ],
            [
                'name' => 'Sarah Lee',
                'email' => 'sarahlee@gmail.com',
                'gender' => 'female',
                'field_of_work' => 'education, teaching, art',
                'linkedin_username' => 'https://www.linkedin.com/in/sarahlee',
                'phone_number' => '089523456794',
                'current_job' => 'Professor',
                'password' => bcrypt(Str::random(8)),
                'profile_picture' => 'assets/profile5.jpg',
                'coin' => '100',
                'visibility' => true,
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michaelbrown@gmail.com',
                'gender' => 'male',
                'field_of_work' => 'healthcare, medicine, lifestyle',
                'linkedin_username' => 'https://www.linkedin.com/in/michaelbrown',
                'phone_number' => '089523456795',
                'current_job' => 'Doctor',
                'password' => bcrypt(Str::random(8)),
                'profile_picture' => 'assets/profile6.jpg',
                'coin' => '100',
                'visibility' => true,
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emilydavis@gmail.com',
                'gender' => 'female',
                'field_of_work' => 'design, architecture, art',
                'linkedin_username' => 'https://www.linkedin.com/in/emilydavis',
                'phone_number' => '089523456796',
                'current_job' => 'Architect',
                'password' => bcrypt(Str::random(8)),
                'profile_picture' => 'assets/profile7.jpg',
                'coin' => '100',
                'visibility' => true,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
