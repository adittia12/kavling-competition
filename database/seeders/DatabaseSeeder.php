<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Directors;
use App\Models\Kavlings;
use App\Models\User;
use App\Models\ValueParameters;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user = [[
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin12345'),
        ],[
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user12345'),
        ]];

        foreach ($user as $key => $users) {
            User::create([
                'name' => $users['name'],
                'email' => $users['email'],
                'password' => $users['password'],
            ]);
        }


        $kavling = [
            ['name_kavling' => 'Kavling 1'],
            ['name_kavling' => 'Kavling 2'],
            ['name_kavling' => 'Kavling 3'],
            ['name_kavling' => 'Kavling 4'],
            ['name_kavling' => 'Kavling 5'],
            ['name_kavling' => 'Kavling 6'],
            ['name_kavling' => 'Kavling 7'],
            ['name_kavling' => 'Kavling 8'],
            ['name_kavling' => 'Kavling 9'],
            ['name_kavling' => 'Kavling 10'],
            ['name_kavling' => 'Kavling 11'],
            ['name_kavling' => 'Kavling 12'],
            ['name_kavling' => 'Kavling 13'],
            ['name_kavling' => 'Kavling 14'],
            ['name_kavling' => 'Kavling 15'],
            ['name_kavling' => 'Kavling 16'],
            ['name_kavling' => 'Kavling 17'],
            ['name_kavling' => 'Kavling 18'],
            ['name_kavling' => 'Kavling 19'],
            ['name_kavling' => 'Kavling 20'],
            ['name_kavling' => 'Kavling 21'],
        ];

        foreach ($kavling as $value) {
            Kavlings::create([
                'name_kavling' => $value['name_kavling'],
            ]);
        }

        $directors = [[
            'name' => 'Dwina Septiani Wijaya',
            'position' => 'Direktur Utama',
            'photo' => 'direksi/dwina_septiani_wijaya.jpg'
        ], [
            'name' => 'Gandung Anggoro Murdani',
            'position' => 'Direktur SDM & TI',
            'photo' => 'direksi/gandung_anggoro_murdani.jpg'
        ], [
            'name' => 'Saiful Bahri',
            'position' => 'Direktur Currency & Security Solution',
            'photo' => 'direksi/saiful_bahri.jpg'
        ], [
            'name' => 'Fajar Rizki',
            'position' => 'Direktur Keuangan dan Manajemen Risiko',
            'photo' => 'direksi/fajar_rizki.jpg'
        ], [
            'name' => 'Farah Fitria Rahmayanti',
            'position' => 'Direktur Digital Business',
            'photo' => 'direksi/farah_fitria_rahmayanti.jpg'
        ]];

        foreach ($directors as $value) {
            Directors::create([
                'name' => $value['name'],
                'position' => $value['position'],
                'photo' => $value['photo'],
            ]);
        }

        $parameter = [
            ['name_parameter' => 'Sustainable'],
            ['name_parameter' => '3R'],
            ['name_parameter' => 'Estetika'],
            ['name_parameter' => 'AKHLAK'],
        ];

        foreach ($parameter as $value) {
            ValueParameters::create([
                'name_parameter' => $value['name_parameter'],
            ]);
        }
    }
}
