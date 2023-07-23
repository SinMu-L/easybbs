<?php

namespace App\Admin\Api;

use App\Models\Forum;
use Illuminate\Http\Request;

class ForumApi
{
    public function index(Request $request){
        $q = $request->get('q');
        return  Forum::where('forum_name', 'like', "%{$q}%")->paginate(null,['id','forum_name as text']);


    }
}
