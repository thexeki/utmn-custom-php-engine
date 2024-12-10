<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('master_classes', function (Blueprint $table) {
            $table->id(); // ID мастер-класса
            $table->string('title'); // Название мастер-класса
            $table->text('description'); // Описание мастер-класса
            $table->date('date'); // Дата мастер-класса
            $table->string('time'); // Время проведения занятия (например, '9-11')
            $table->string('img')->nullable(); // URL изображения
            $table->integer('group_size'); // Максимальное количество человек в группе
            $table->decimal('price', 8, 2); // Стоимость мастер-класса
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Ведущий мастер-класса
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Категория мастер-класса
            $table->timestamps(); // Поля created_at и updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_classes');
    }
};

