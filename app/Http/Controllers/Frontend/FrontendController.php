<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Program;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $setting = Setting::find(1);
        $all_categories = Program::where('status','0')->where('is_deleted','0')->orderBy('created_at','DESC')->paginate(5);
        $all_posts = POST::where('status','0')->where('is_deleted','0')->orderBy('created_at','DESC')->paginate(5);
        return view('frontend.index',compact('all_categories','all_posts','setting'));
    }

    public function ViewProgramPost(string $Program_slug)  // Ensure no extra semicolon here
    {
        // Find Program by slug, status, and is_deleted
        $Program = Program::where('slug', $Program_slug)
            ->where('status', '0')
            ->where('is_deleted', '0')
            ->first();

        if ($Program) {
            // Get posts related to the Program
            $posts = Post::where('Program_id', $Program->id)
                ->where('status', '0')
                ->orderBy('created_at','DESC')
                ->paginate(5);

            // Pass Program and posts to the view
            return view('frontend.post.index', compact('Program', 'posts'));
        } else {
            // If no Program found, redirect to the homepage with an optional message
            return redirect('/')->with('status', 'Program not found.');
        }
    }

    public function viewPost(string $Program_slug , string $post_slug){
         // Find Program by slug, status, and is_deleted
         $Program = Program::where('slug', $Program_slug)
         ->where('status', '0')
         ->where('is_deleted', '0')
         ->first();

     if ($Program) {
         // Get posts related to the Program
         $posts = Post::where('Program_id', $Program->id)
             ->where('status', '0')
             ->where('slug', $post_slug)
             ->first();

        $latest_posts = Post::where('Program_id', $Program->id)
        ->where('status', '0')
        ->orderBy('created_at','DESC')
        ->get()
        ->take(1);

         // Pass Program and posts to the view
         return view('frontend.post.view', compact('posts','latest_posts','Program'));
     } else {
         // If no Program found, redirect to the homepage with an optional message
         return redirect('/')->with('status', 'Program not found.');
     }
    }
}
