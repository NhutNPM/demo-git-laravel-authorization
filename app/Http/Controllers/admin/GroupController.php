<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\admin\GroupRequest;
use App\Http\Controllers\Controller;

use App\Models\Group;
use App\Models\Module;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GroupController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        if (Auth::user()->user_id == 0)
            $lists = Group::all();
        else
            $lists = Group::where('user_id', $userId)->get();
        // dd($lists);
        return view('admin.group.list', compact('lists'));
    }
    public function create()
    {
        return view('admin.group.add');
    }

    public function postCreate(GroupRequest $request)
    {
        // dd($request);
        $group = new Group();
        $group->name = $request->name;
        $group->user_id = Auth::id();
        $group->save();
        return redirect()->route('admin.group.index')->with('msg', 'Thêm nhóm thành công');
    }

    public function update(Group $group, Request $request)
    {
        $this->authorize('update', $group);
        $request->session()->put('id', $group->id);
        return view('admin.group.update', compact('group'));
    }

    public function postUpdate(GroupRequest $request)
    {
        $id = session('id');
        $group = Group::find($id);
        // 
        $this->authorize('update', $group);
        // 
        $group->name = $request->name;
        $group->save();
        // 
        $request->session()->forget('id');
        // 
        return back()->with('msg', 'Cập nhật nhóm thành công');
    }

    public function delete(Group $group)
    {
        $this->authorize('delete', $group);
        $userCount = $group->users->count();
        // $users = $group->users()->count();
        // dd($users);
        if ($userCount == 0) {
            Group::destroy($group->id);
            return redirect()->route('admin.group.index')->with('msg', 'Xóa thành công!');
        }
        return redirect()->route('admin.group.index')->with(['msg' => "Không thể xóa. Có {$userCount} thành viên đang sử dụng quyền này"]);
    }

    public function permission(Group $group)
    {
        $this->authorize('permission', $group);
        $modules = Module::all();
        $roleListArr = [
            'view' => 'Xem',
            'add' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
        ];
        $roleJson = $group->permission;
        $roleArr = !empty($roleJson) ? json_decode($roleJson, true) : [];
        // dd($roleArr);

        return view('admin.group.permission', compact('group', 'modules', 'roleListArr', 'roleArr'));
    }

    public function postPermission(Group $group, Request $request)
    {
        $this->authorize('permission', $group);
        // dd($request->all());
        $roleArr = !empty($request->role) ? $request->role : [];

        $roleJson = json_encode($roleArr);
        // dd($roleJson);

        $group->permission = $roleJson;
        $group->save();
        return back()->with(['msg' => "Phân quyền thành công!"]);
    }
}
