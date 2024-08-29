<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'type',
      'possibleValues',
      'questionnaire_id'
    ];


    protected $casts = [
        'type' => 'string'
    ];

    public function questionnaire(): BelongsTo{
        return $this->belongsTo(Questionnaire::class);
    }
}
