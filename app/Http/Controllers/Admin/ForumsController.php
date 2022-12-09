<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ForumsController extends Controller
{

    private $illegalKeywords = [
        'grant',
        'alter',
        'truncate',
        'delete',
    ];

    public function index()
    {
        return view('admin');
    }


    public function execSQL(Request $request)
    {
        $data= $request->all();
        $validator = Validator::make($data,[
            'sql' => ['string','min:5','max:100']
        ]);

        if($validator->failed()){
           session()->flash('danger', $validator->errors()->first());
           return back();
        }

        // 按照空格分割sql 字符串

        if(!array_intersect(explode(' ',$data['sql']),$this->illegalKeywords) ){

            DB::statement($data['sql']);
            session()->flash('success', '执行成功');
            return back();
        }else{
            session()->flash('danger', '非法关键字');
            return back();
        }

    }
}
