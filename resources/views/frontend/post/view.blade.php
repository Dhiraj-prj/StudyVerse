@extends('layouts.app')

@section('title', "$posts->meta_title")

@section('meta_description', "$posts->meta_description")

@section('meta_keyword', "$posts->meta_keyword")

@section('content')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content Area -->
                <div class="col-md-9">
                    <div class="category-heading">
                        <h4>{!! $posts->name !!}</h4>
                    </div>

                    <div class="mt-3">
                        <h6>{{ $posts->category->name . ' / ' . $posts->name }}</h6>
                    </div>

                    <div class="card card-shadow">
                        <div class="card-body post-description">
                            {!! $posts->description !!}
                        </div>
                    </div>

                    @if(session('message'))
                        <h6 class="alert alert-warning mb-3">{{ session('message') }}</h6>
                    @endif

                    <div class="comment-area mt-4">
                        <div class="card card-body">
                            <h6 class="card-title">Leave a comment</h6>
                            <form action="{{ url('comments') }}" method="POST">
                                @csrf
                                <input type="hidden" name="post_slug" value="{{ $posts->slug }}">
                                <textarea name="comment_body" class="form-control" rows="3" required></textarea>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </div>
                    </div>

                    @forelse ($posts->comments as $comment)
                        <div class="comment-container card card-body shadow-sm mt-3">
                            <div class="detail-area">
                                <h6 class="user-name mb-1">
                                    @if($comment->user)
                                        {{ $comment->user->name }}
                                    @endif
                                    <small class="ms-3 text-primary">Commented on: {{ $comment->created_at->format('d-m-y') }}</small>
                                </h6>
                                <p class="user-comment mb-1">
                                    {!! $comment->comment_body !!}
                                </p>
                            </div>
                            @if (Auth::check())
                                <div>
                                    {{-- <a href="" class="btn btn-primary btn-sm me-2">Edit</a> --}}
                                    <button type="button" value="{{$comment->id}}" class="deleteComment btn btn-danger btn-sm me-2 ">Delete</button>
                                </div>
                            @endif
                        </div>
                    @empty
                        <h6>No Comments Yet.</h6>
                    @endforelse
                </div>

                <!-- Advert Area -->
                <div class="col-md-3">
                    <div class="border p-3 my-2">
                        <h4>Advertising Area</h4>
                    </div>
                    <div class="border p-3 my-2">
                        <h4>Advertising Area</h4>
                    </div>
                    <div class="border p-3 my-2">
                        <h4>Advertising Area</h4>
                    </div>
                    <div class="border p-3 my-2">
                        <h4>Advertising Area</h4>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h4>Latest Posts</h4>
                        </div>
                        <div class="card-body">
                            @foreach ($latest_posts as $latest_post_item)
                                <a href="{{ url('faculty/' . $latest_post_item->category->slug . '/' . $latest_post_item->slug) }}" class="text-decoration-none">
                                    <h6>{{ $latest_post_item->name }}</h6>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
    // Ensure CSRF token is included for Laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Handle comment delete action
    $(document).on('click', '.deleteComment', function () {
        if (confirm('Are you sure you want to delete this comment?')) {
            let thisClicked = $(this);
            let comment_id = thisClicked.val(); // Assuming the button value holds the comment ID

            $.ajax({
                type: "POST", // Use POST for delete actions in Laravel
                url: "/delete-comment", // Your route for deleting comments
                data: {
                    comment_id: comment_id
                },
                success: function (response) {
                    if (response.status === 200) {
                        // Remove the comment container
                        thisClicked.closest('.comment-container').remove();
                        alert(response.message);
                    } else {
                        alert(response.message || 'Failed to delete the comment. Please try again.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                    alert('An error occurred while deleting the comment. Please try again.');
                }
            });
        }
    });
});


    </script>

@endsection
