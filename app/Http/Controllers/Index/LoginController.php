<?php

namespace App\Http\Controllers\Index;

use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function create(){
        return view('index.login.create');
    }
    public function store(Request $request){
        $credentials = $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required'
        ]);
        if(Auth::attempt($credentials,$request->has('remember'))){
            session()->flash('success','欢迎回来');
            $back = route('users.show',[Auth::user()]);
            return redirect()->intended($back);
        }else{
            session()->flash('danger','您输入的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }
    }
    public function logout(){
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
}
