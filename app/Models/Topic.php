<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BlueM\Tree;
use Facade\Ignition\Views\Engines\PhpEngine;

class Topic extends Model
{
    use HasFactory;

    public $commentStr;
    public $level = 0;

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'topic_id','id');
    }

    public function commentsFlatTree()
    {
        $data = $this->comments()->with('user')->get()->toArray();

        // $this->commentStr = '';
        // $children = [];
        // $i = 1;
        // foreach($data as $item){
        //     $item['t_id'] = $i++;
        //     $children[$item['pid']][] = $item;
        // }


        // // dd($children);
        // $this->t($children,0);
        // // echo $this->commentStr;
        // dd(123);
        // return $this->commentStr;

        $tree = new \BlueM\Tree($data, ['rootId' => 0, 'parent' => 'pid']);
        $res =  array_map(function (\BlueM\Tree\Node $node) {
            $comment = Comment::with('user')->find($node->toArray()['id']);
            $comment->depth = count($node->getAncestors());
            return $comment;
        }, $tree->getNodes());

        // dd($res);
        return $res;

    }

    public function t($comments,$n){
        if(isset($comments[$n])){
            $this->level ++;
            foreach($comments[$n] as $comment){
                // $this->commentStr .= "<div class='comment' style='margin-left:" .  5*$comment['t_id']   ."px'>";
                // $this->commentStr .=  "<span><a href='" . route('user.show',$comment['user']['id']) ."'>{$comment['user']['name']}</a>    - " . $comment['created_at'] ."</span>";
                // $this->commentStr .= "<br><span> {$comment['content'] }</span>";
                // $this->commentStr .= "<br><span><a href=" . route('add_comment',['topic_id'=>$this->id,'comment_id'=>$comment['id']])  . ">回复</a></span>";
                // $this->commentStr .= "</div>";
                echo str_repeat('-', $this->level).$comment['id'] .'-' . $comment['pid']. $comment['user']['name'] . '   ' . $comment['content'] . '<br>';
                $this->t($comments,$comment['id']);
            }
        }

    }


}
