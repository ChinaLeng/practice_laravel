<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Status;

class StaticPagesController extends Controller
{
    //首页
    public function home(){
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(30);
        }
        return view('index.static_pages.home',compact('feed_items'));
    }
}
