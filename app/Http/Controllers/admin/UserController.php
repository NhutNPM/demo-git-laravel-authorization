<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\admin\UserRequest;
use App\Http\Controllers\Controller;

use App\Models\Group;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        if (Auth::user()->user_id == 0)
            $lists = User::all();
        else
            $lists = User::where('user_id', $userId)->get();
        return view('admin.user.list', compact('lists'));
    }

    public function create()
    {
        $groups = Group::all();
        return view('admin.user.add', compact('groups'));
    }

    public function postCreate(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);
        $user->group_id = $request->group_id;
        $user->user_id = Auth::user()->id;
        $user->save();
        return redirect()->route('admin.user.index')->with('msg', 'Thêm người dùng thành công');
    }

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        // 
        $request->session()->put('id', $user->id);
        // 
        $groups = Group::all();
        return view('admin.user.update', compact('groups', 'user'));
    }

    public function postUpdate(UserRequest $request)
    {
        $id = session('id');
        $user = User::find($id);
        // 
        $this->authorize('update', $user);
        // 
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password))
            $user->password =  Hash::make($request->password);
        $user->group_id = $request->group_id;
        $user->save();
        // 
        $request->session()->forget('id');
        // 
        return back()->with('msg', 'Cập nhật người dùng thành công');
    }

    public function delete(User $user)
    {
        $this->authorize('delete', $user);
        if (Auth::id() != $user->id) {
            User::destroy($user->id);
            return redirect()->route('admin.user.index')->with('msg', 'Xóa thành công!');
        } else
            return redirect()->route('admin.user.index')->with('msg', 'Không thể xóa tài khoản này!');
    }
}
