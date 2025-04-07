<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskShareLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'token',
        'expires_at',
    ];

    protected $dates = ['expires_at'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function isExpired(): bool
    {
        return now()->greaterThan($this->expires_at);
    }
}
