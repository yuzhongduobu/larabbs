<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function root(){
        return view('pages.root');
        // 控制器 root() 方法中加载了视图 pages.root
    }
}
