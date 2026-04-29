<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamActivityLog extends Model
{
    use SoftDeletes;

    protected $table = 'activity_logs';

    protected $fillable = [
        'participant_id',
        'type',
        'description',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
