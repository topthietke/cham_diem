<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'total_score',
        'rubric_scores',
        'judge_score_note',
        'strengths',
        'improvements',
        'critical_error',
        'diagnosis',
        'coaching_plan',
        'raw_ai_response',
    ];

    protected $casts = [
        'total_score' => 'integer',
        'rubric_scores' => 'array',
        'strengths' => 'array',
        'improvements' => 'array',
        'diagnosis' => 'array',
        'coaching_plan' => 'array',
    ];

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }
}
