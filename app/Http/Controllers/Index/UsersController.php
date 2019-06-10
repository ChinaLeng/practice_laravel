<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
class UsersController extends Controller
{
    /**
     * 用户注册
     * @return mixed
     */
    public function create(){
        return view('index.users.create');
    }

    /**
     * 用户展示
     * @param User $user
     * @return mixed
     */
    public function show(User $user){
        return view('index.users.show',compact('user'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        session()->flash('success','欢迎您,开启您的全新之旅吧');
        return redirect()->route('users.show',[$user]);
    }

}
