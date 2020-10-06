<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Hash;
use Log;

class PostController extends Controller
{
    function post(Request $req) {
        $validatedData = $req->validate([
            'title' => 'required|max:30',
            'content' => 'required',
            'theme' => 'required',
            'password' => 'max:28',
            'delpassword' => 'required|max:28',
        ]);
        //宣伝バサミ
        $content = $req->content;
        $content = strip_tags($content, ['p', 'a', 'h1', 'h2', 'blockquote', 'app-pr', 'strong', 'em']);
        $post = new Post;
        $post->title = $req->title;
        $post->content = $content;
        $post->theme_id = $req->theme;
        //password 塗るだったらデータもなるに
        if($req->password) {
            $post->password = Hash::make($req->password);
        } else {
            $post->password = null;
        }
        $post->delpassword = Hash::make($req->delpassword);
        $post->save();
        return redirect()->route('view', ['id' => $post->id]);
    }
    public static function view($id) {
        try {
            $post = Post::where('id', $id)->first();
        } catch(\Exception $e) {
            abort(500);
            Log::error('DB connect Error found at PostController view() Error:'.$e);
        }
        //is null
        abort_if(! $post, 404);

        //Password Locked
        if ($post->password) {
            //Session available?
            if(session('password-lockid') && $post->id == session('password-lockid')) {
                return view('view', ['post' => $post]);
            }
            return view('password', ['id' => $post->id]);
        }
        return view('view', ['post' => $post]);
    }
    function password(Request $req) {
        $post = Post::where('id', $req->id)->first();
        abort_if(! $post, 404);
        //check password
        if(Hash::check($req->password, $post->password)) {
            session(['password-lockid' => $req->id]);
        } else {
            //dontmuch
            return back();
        }
        return redirect()->route('view', ['id' => $req->id]);
    }
    function delete(Request $req) {
        $post = Post::where('id', $req->id)->first();
        abort_if(! $post, 404);
        if(Hash::check($req->password, $post->delpassword)) {
            $post->delete();
            return response('削除が完了しました <a href="/">戻る</a>');
        } else {
            //dontmuch
            return back();
        }
        return back();
    }
}
