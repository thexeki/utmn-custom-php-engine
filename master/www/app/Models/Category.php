<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'img'];

    /**
     * Связь с моделью MasterClass (Мастер-классы в категории).
     */
    public function masterClasses(): HasMany
    {
        return $this->hasMany(MasterClass::class);
    }
}
