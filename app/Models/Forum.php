<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class Forum extends Model
{
    use HasFactory,HasDateTimeFormatter;

    public function topics(){
        return $this->hasMany(Topic::class,'forum_id','id');
    }
}
