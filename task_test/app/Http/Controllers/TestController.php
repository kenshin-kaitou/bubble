<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $values = Test::all();
        //クエリビルダ
        DB::table('tests')->where('text', '=', 'aaa')
            ->select('id', 'text')
            ->get();
        dd($values);
        return view('tests.test',compact('values'));
    }
}
