<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaticPagesController extends Controller
{
    //首页
    public function home(){
        return view('index.static_pages.home');
    }
}
