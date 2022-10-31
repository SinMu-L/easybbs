<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Comment extends Model
{
    use HasFactory;

    public $timestamps = true;

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

    public function topic()
    {
        return $this->belongsTo(Topic::class,'topic_id','id');
    }

    public function getCreatedAtAttribute($date)
    {
        if (Carbon::now() < Carbon::parse($date)->addDays(10)) {
            return Carbon::parse($date);
        }

        return Carbon::parse($date)->diffForHumans();
    }
}
