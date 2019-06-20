<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['create', 'store','confirmEmail']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('index.users.index', compact('users'));
    }

    /**
     * 用户注册
     * @return mixed
     */
    public function create()
    {
        return view('index.users.create');
    }

    /**
     * 用户展示
     * @param User $user
     * @return mixed
     */
    public function show(User $user)
    {
        //$this->authorize('update', $user);
        $statuses  = $user->statuses()->orderBy('created_at', 'desc')->paginate(10);
        return view('index.users.show', compact('user','statuses'));
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
        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '欢迎您,开启您的全新之旅吧');
        return redirect()->route('users.show', [$user]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
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
        $this->authorize('update', $user);
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

    /**
     * 删除用户
     * @param User $user
     * @return mixed
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }

    /**
     * 发邮件
     * @param $user
     */
    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'summer@example.com';
        $name = 'Summer';
        $to = $user->email;
        $subject = "感谢注册 Weibo 应用！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }

    /**
     * 邮箱激活
     * @param $token
     * @return mixed
     */
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('users.show', [$user]);
    }
     /**
     * 关注的人
     * @param User $user
     * @return mixed
     */
    public function followings(User $user)
    {
        $users = $user->followings()->paginate(30);
        $title = $user->name.'关注的人';
        return view('index.users.show_follow',compact('users','title'));
    }
     /**
     * 展示粉丝
     * @param User $user
     * @return mixed
     */
    public function followers(User $user)
    {
        $users = $user->followers()->paginate(30);
        $title = $user->name . '的粉丝';
        return view('index.users.show_follow', compact('users', 'title'));
    }
}
