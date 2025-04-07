<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'priority',
        'status',
        'due_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shareLinks()
    {
        return $this->hasMany(TaskShareLink::class);
    }

    public function revisions()
    {
        return $this->hasMany(TaskRevision::class);
    }
}
