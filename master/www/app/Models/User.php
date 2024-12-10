<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'phone', 'role', 'img'];

    /**
     * Связь с мастер-классами (только для ведущего).
     */
    public function masterClasses(): HasMany
    {
        return $this->hasMany(MasterClass::class);
    }

    /**
     * Связь с регистрациями пользователя.
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Проверяет, является ли пользователь ведущим мастер-класса.
     */
    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    /**
     * Проверяет, является ли пользователь посетителем.
     */
    public function isVisitor(): bool
    {
        return $this->role === 'visitor';
    }
}
