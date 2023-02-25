<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\admin\PostRequest;
use App\Http\Controllers\Controller;

use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        // $lists = Post::all();
        $lists = Post::orderBy('created_at', 'desc')
            ->where('user_id', $userId)
            ->get();
        // dd($lists);
        return view('admin.post.list', compact('lists'));
    }
    public function create()
    {
        return view('admin.post.add');
    }

    public function postCreate(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::id();
        $post->save();
        return redirect()->route('admin.post.index')->with('msg', 'Thêm bài viết thành công');
    }

    public function update(Post $post, Request $request)
    {
        $this->authorize('update', $post);
        $request->session()->put('id', $post->id);
        return view('admin.post.update', compact('post'));
    }

    public function postUpdate(PostRequest $request)
    {
        $id = session('id');
        $post = Post::find($id);
        // 
        $this->authorize('update', $post);
        // 
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        // 
        $request->session()->forget('id');
        return back()->with('msg', 'Cập nhật bài viết thành công');
    }

    public function delete(Post $post)
    {
        $this->authorize('delete', $post);
        Post::destroy($post->id);
        return redirect()->route('admin.post.index')->with('msg', 'Xóa bài viết thành công!');
    }
}
