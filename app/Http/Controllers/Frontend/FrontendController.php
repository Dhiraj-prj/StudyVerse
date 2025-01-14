<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $all_categories = Category::where('status','0')->where('is_deleted','0')->orderBy('created_at','DESC')->paginate(5);
        $all_posts = POST::where('status','0')->where('is_deleted','0')->orderBy('created_at','DESC')->paginate(5);
        return view('frontend.index',compact('all_categories','all_posts'));
    }

    public function ViewCategoryPost(string $category_slug)  // Ensure no extra semicolon here
    {
        // Find category by slug, status, and is_deleted
        $category = Category::where('slug', $category_slug)
            ->where('status', '0')
            ->where('is_deleted', '0')
            ->first();

        if ($category) {
            // Get posts related to the category
            $posts = Post::where('category_id', $category->id)
                ->where('status', '0')
                ->orderBy('created_at','DESC')
                ->paginate(5);

            // Pass category and posts to the view
            return view('frontend.post.index', compact('category', 'posts'));
        } else {
            // If no category found, redirect to the homepage with an optional message
            return redirect('/')->with('status', 'Category not found.');
        }
    }

    public function viewPost(string $category_slug , string $post_slug){
         // Find category by slug, status, and is_deleted
         $category = Category::where('slug', $category_slug)
         ->where('status', '0')
         ->where('is_deleted', '0')
         ->first();

     if ($category) {
         // Get posts related to the category
         $posts = Post::where('category_id', $category->id)
             ->where('status', '0')
             ->where('slug', $post_slug)
             ->first();

        $latest_posts = Post::where('category_id', $category->id)
        ->where('status', '0')
        ->orderBy('created_at','DESC')
        ->get()
        ->take(1);

         // Pass category and posts to the view
         return view('frontend.post.view', compact('posts','latest_posts','category'));
     } else {
         // If no category found, redirect to the homepage with an optional message
         return redirect('/')->with('status', 'Category not found.');
     }
    }
}
