<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'userName',
        'questionnaire_id',
        'question_id',
        'response',
        'responseGroupId'
    ];


    public function question(): BelongsTo{
        return $this->belongsTo(Question::class);
    }

    public function questionnaire(): BelongsTo{
        return $this->belongsTo(Questionnaire::class);
    }
}
