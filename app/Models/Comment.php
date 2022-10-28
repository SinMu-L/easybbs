<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'topic_id',
        'user_id',
        'pid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    // public function topic()
    // {
    //     return $this->belongsTo(Topic::class,'topic_id','id');
    // }
}
