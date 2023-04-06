<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

     public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
