<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ID пользователя
            $table->string('name'); // Имя пользователя
            $table->string('email')->unique(); // Email пользователя
            $table->string('img')->nullable(); // URL изображения
            $table->string('password', 255); // Хэшированный пароль
            $table->string('phone')->nullable(); // Телефон пользователя
            $table->enum('role', ['visitor', 'teacher'])->default('visitor'); // Роль пользователя
            $table->timestamps(); // Поля created_at и updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
