<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_data_id',
        'keyword',
        'weight',
    ];

    protected $casts = [
        'weight' => 'decimal:2',
    ];

    public function trainingData()
    {
        return $this->belongsTo(TrainingData::class);
    }
}
