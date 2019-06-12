<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store']
        ]);
    }

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

    /**
     * 用户注册
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
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
        Auth::login($user);
        session()->flash('success', '欢迎您,开启您的全新之旅吧');
        return redirect()->route('users.show', [$user]);
    }

    public function edit(User $user)
    {
        return view('index.users.edit', compact('user'));
    }

    /**
     * 用户更新资料
     * @param User $user
     * @param Request $request
     * @return mixed
     */
    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);
        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success','个人资料修改成功');
        return redirect()->route('users.show', $user->id);
    }

}
