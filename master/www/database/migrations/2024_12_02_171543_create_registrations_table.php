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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id(); // ID записи
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ID пользователя
            $table->foreignId('master_class_id')->constrained('master_classes')->onDelete('cascade'); // ID мастер-класса
            $table->timestamps(); // Поля created_at и updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
