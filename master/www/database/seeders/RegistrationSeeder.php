<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Registration::insert([
            [
                'user_id' => 4, // Иван Иванов
                'master_class_id' => 1, // Геометрическая резьба по дереву
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5, // Смирнова Анна
                'master_class_id' => 2, // Шоколадные поделки
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6, // Кузнецов Дмитрий
                'master_class_id' => 3, // Моделирование зданий и сооружений
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7, // Федорова Елена
                'master_class_id' => 1, // Геометрическая резьба по дереву
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5, // Смирнова Анна
                'master_class_id' => 4, // Моделирование моделей транспорта
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4, // Иван Иванов
                'master_class_id' => 2, // Шоколадные поделки
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6, // Кузнецов Дмитрий
                'master_class_id' => 5, // Приготовление стейков
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7, // Федорова Елена
                'master_class_id' => 3, // Моделирование зданий и сооружений
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5, // Смирнова Анна
                'master_class_id' => 6, // Шоколадные поделки
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4, // Иван Иванов
                'master_class_id' => 4, // Моделирование моделей транспорта
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
