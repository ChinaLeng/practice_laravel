<?php

namespace App\Http\Controllers\Index;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 文章发布
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);
        Auth::user()->statuses()->create([
            'content' => $request['content']
        ]);
        session()->flash('success', '发布成功');
        return redirect()->back();
    }

    /**
     * 删除文章
     * @param Status $status
     * @return mixed
     */
    public function destroy(Status $status)
    {
        $this->authorize('destroy', $status);
        $status->delete();
        session()->flash('success', '微博已被成功删除！');
        return redirect()->back();
    }
}
