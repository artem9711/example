<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(9);
        $randomPost = Post::get()->random(4);
        $likedPosts = Post::withCount('likedUsers')->orderBy('liked_users_count', 'ASC')->get()->take(4);
        return view('post.index', compact('posts', 'randomPost', 'likedPosts'));
    }

    public function show(Post $post)
    {
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->get()
            ->take(3);
        $date = Carbon::parse($post->created_ad);
        return view('post.show', compact('post', 'date', 'relatedPosts'));
    }
}
