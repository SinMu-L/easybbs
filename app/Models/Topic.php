<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BlueM\Tree;
use Facade\Ignition\Views\Engines\PhpEngine;

class Topic extends Model
{
    use HasFactory;

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
        dd($data);
        $this->t($data,0);
        $children = [];

        foreach($data as $item){
            $children[$item['pid']][$item['id']] = &$item['content'];
            unset($item);
        }

        dd($children);




        return $children;



    }

    public function t($dept_items,$root_id){
        $dep_child = [];
        $dept_items_init = [];

        for($i = 0; $i < count($dept_items); $i++){
            // 获取 pid = $root_id 的所有item
            $child = [];
            foreach($dept_items as $item){
                if($item['pid'] == $root_id){
                    $child[] = $item;
                }
            }
            $dep_child[] = $child;
        }

        if(!$dept_items){
            return 'hello';
        }else{
            // $this->t($dep_child,);
        }
    }







}
