<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\PostFormRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::where('is_deleted', false)->get();
        return view('admin.post.index', compact('posts'));
    }


    public function create()
    {
        // Fetch categories that are active (status = 0) and not deleted
        $categories = Category::where('status', 0)->where('is_deleted', 0)->get();

        // Pass the categories to the Blade view
        return view('admin.post.create', compact('categories'));
    }

    public function store(PostFormRequest $request)
    {
        // Validate the request data
        $data = $request->validated();

        // Save the data into the Post model
        $post = new Post();
        $post->category_id = $data['category_id'];
        $post->subcategory = $data['subcategory'];
        $post->name = $data['name'];
        $post->postType = $data['postType'];
        $post->slug = $this->generateSlug($data['name'], $data['slug'] ?? null);
        $post->description = $data['description'] ?? null;
        $post->yt_iframe = $data['yt_iframe'] ?? null;
        $post->meta_title = $data['meta_title'] ?? null;
        $post->meta_description = $data['meta_description'] ?? null;
        $post->meta_keyword = $data['meta_keyword'] ?? null;
        $post->status = $request->has('status') ? 1 : 0;
        $post->created_by = Auth::user()->id;

        $post->save();

        $posts = Post::where('is_deleted', false)->get();

        // Redirect with a success message
        session()->regenerate();
        return view('admin.post.index', compact('posts'))->with('message', 'Post created successfully.');
    }

    public function edit($post_id)
    {
        // Find the post by ID and return with categories
        $post = Post::find($post_id);
        if (!$post) {
            return redirect('admin/posts')->with('error', 'Post not found!');
        }

        $categories = Category::all();
        return view('admin.post.edit', compact('post', 'categories'));
    }

    public function update(PostFormRequest $request, $post_id)
    {
        // Validate the request data
        $data = $request->validated();

        // Find the post by ID
        $post = Post::find($post_id);
        if (!$post) {
            return redirect('admin/post')->with('error', 'Post not found!');
        }

        // Update post fields with validated data
        $post->name = $data['name'];
        $post->postType = $data['postType'];
        $post->slug = $this->generateSlug($data['name']);
        $post->description = $data['description'];
        $post->category_id = $data['category_id'];
        $post->yt_iframe = $data['yt_iframe'];
        $post->meta_title = $data['meta_title'];
        $post->meta_description = $data['meta_description'];
        $post->meta_keyword = $data['meta_keyword'];

        // Update checkbox values
        $post->status = $request->has('status'); // Active or not

        // Save the updated post
        $post->update();

        return redirect('admin/post')->with('message', 'Post updated successfully!');
    }

    public function destroy($post_id){
        $post = Post::findOrFail($post_id);
        $post->is_deleted = true; // Soft delete
        $post->update();

        return redirect('admin/post')->with('success', 'Post deleted successfully.');
    }

    private function generateSlug($name, $slug = null)
    {
        // If the slug is empty, generate it based on the name
        if (empty($slug)) {
            // Convert to lowercase, remove special characters, and replace spaces with hyphens
            $slug = strtolower(trim($name)); // Lowercase and trim the name
            $slug = preg_replace('/[^a-z0-9 -]/', '', $slug); // Remove special characters
            $slug = preg_replace('/\s+/', '-', $slug); // Replace spaces with dashes
            $slug = preg_replace('/-+/', '-', $slug); // Replace multiple dashes with a single one
        }

        // Check if the slug already exists in the posts table, and append a number if necessary
        $count = Post::where('slug', $slug)->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1); // Append a number to make the slug unique
        }

        return $slug;
    }

    public function getLevels($categoryId)
    {
        // Fetch category using categoryId
        $category = Category::find($categoryId);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404); // Return error if category not found
        }

        // // Debugging output to check if category levelType is correct
        // \Log::info("Category LevelType: " . $category->levelType);

        $levels = [];
        if ($category->levelType == 1) { // Semester type
            $levels = [
                ['id' => 1, 'name' => 'Semester I'],
                ['id' => 2, 'name' => 'Semester II'],
                ['id' => 3, 'name' => 'Semester III'],
                ['id' => 4, 'name' => 'Semester IV'],
                ['id' => 5, 'name' => 'Semester V'],
                ['id' => 6, 'name' => 'Semester VI'],
                ['id' => 7, 'name' => 'Semester VII'],
                ['id' => 8, 'name' => 'Semester VIII'],
            ];
        } elseif ($category->levelType == 2) { // Year type
            $levels = [
                ['id' => 1, 'name' => 'Year I'],
                ['id' => 2, 'name' => 'Year II'],
                ['id' => 3, 'name' => 'Year III'],
                ['id' => 4, 'name' => 'Year IV'],
            ];
        }

        return response()->json($levels); // Return levels as JSON
    }
}
