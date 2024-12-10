<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MasterClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'group_size',
        'price',
        'img',
        'user_id',
        'category_id',
    ];

    /**
     * Связь с моделью User (ведущий мастер-класса).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Связь с моделью Category (Вид творчества).
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Связь с регистрациями.
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Прошло ли время занятия.
     *
     */
    public function isPast(): int
    {
        return $classStartTime = Carbon::parse($this->date . ' ' . explode('-', $this->time)[0].':00')->isPast();
    }

    /**
     * Доступные места.
     */
    public function getAvailableSlotsAttribute(): int
    {
        return $this->group_size - $this->registrations()->count();
    }

    /**
     * Проверяет доступность мастер-класса.
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        $classStartTime = Carbon::parse($this->date . ' ' . explode('-', $this->time)[0] . ':00');

        if ($classStartTime->isPast()) {
            return false;
        }

        if ($this->available_slots <= 0) {
            return false;
        }

        if (!Auth::check()) {
            return false;
        }

        if (Auth::user()->role === 'teacher') {
            return false;
        }

        $isRegistered = $this->registrations()
            ->where('user_id', Auth::id())
            ->exists();
        if ($isRegistered) {
            return false;
        }

        return true;
    }
}
