<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'user_id',
        'slug'
    ];


    public function questions(): HasMany{
        return $this->hasMany(Question::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function responses(): HasMany{
        return $this->hasMany(Response::class);
    }
}
