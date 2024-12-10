<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'master_class_id'];

    /**
     * Связь с пользователем, который зарегистрировался.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Связь с мастер-классом, на который зарегистрировались.
     */
    public function masterClass(): BelongsTo
    {
        return $this->belongsTo(MasterClass::class);
    }
}
