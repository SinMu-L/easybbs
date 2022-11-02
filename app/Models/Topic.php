<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Topic extends Model
{
    use HasFactory;
    public $timestamps = true;


    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'topic_id','id');
    }

    public function forum()
    {
        return $this->hasOne(Forum::class,'id','forum_id');
    }

    public function commentsFlatTree()
    {
        $data = $this->comments()->with('user')->get()->toArray();



        $tree = new \BlueM\Tree($data, ['rootId' => 0, 'parent' => 'pid']);
        $res =  array_map(function (\BlueM\Tree\Node $node) {
            $comment = Comment::with('user')->find($node->toArray()['id']);
            $comment->depth = count($node->getAncestors());
            return $comment;
        }, $tree->getNodes());

        // dd($res);
        return $res;

    }





}
