<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Иванова Ольга Ивановна',
                'email' => 'olga.ivanova@example.com',
                'password' => Hash::make('password'),
                'phone' => '89001234567',
                'role' => 'teacher',
            ],
            [
                'name' => 'Петров Алексей Николаевич',
                'email' => 'alexey.petrov@example.com',
                'password' => Hash::make('password'),
                'phone' => '89007654321',
                'role' => 'teacher',
            ],
            [
                'name' => 'Сидоров Игорь Владимирович',
                'email' => 'igor.sidorov@example.com',
                'password' => Hash::make('password'),
                'phone' => '89009876543',
                'role' => 'teacher',
            ],
            [
                'name' => 'Иван Иванович Иванов',
                'email' => 'ivan.ivanov@example.com',
                'password' => Hash::make('password'),
                'phone' => '89001112233',
                'role' => 'visitor',
            ],
            [
                'name' => 'Смирнова Анна Сергеевна',
                'email' => 'anna.smirnova@example.com',
                'password' => Hash::make('password'),
                'phone' => '89004567890',
                'role' => 'visitor',
            ],
            [
                'name' => 'Кузнецов Дмитрий Алексеевич',
                'email' => 'dmitriy.kuznetsov@example.com',
                'password' => Hash::make('password'),
                'phone' => '89007894561',
                'role' => 'visitor',
            ],
            [
                'name' => 'Федорова Елена Николаевна',
                'email' => 'elena.fedorova@example.com',
                'password' => Hash::make('password'),
                'phone' => '89005432189',
                'role' => 'visitor',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

