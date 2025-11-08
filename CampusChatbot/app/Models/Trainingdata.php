<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingData extends Model
{
    use HasFactory;

    protected $table = 'training_data';

    protected $fillable = [
        'question',
        'answer',
        'category',
        'priority',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'priority' => 'integer',
    ];

    public function keywords()
    {
        return $this->hasMany(Keyword::class);
    }

    public function chatHistories()
    {
        return $this->hasMany(ChatHistory::class, 'matched_training_id');
    }
}
