@extends('layouts.app')

@section('title',$post->meta_title )

@section('meta_description', $post->meta_description )

@section('meta_keyword',$post->meta_keyword)

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row">
            <!-- Main Content Area -->
            <div class="col-md-9">
                <div class="Program-heading">
                    <h4>{!! $post->name !!}</h4>
                </div>

                <div class="mt-3">
                    <h6>{{ $post->Program->name . ' / ' . $post->name }}</h6>
                </div>

                <div class="card card-shadow">
                    <div class="card-body post-description">
                        {!! $post->description !!}
                    </div>
                </div>


                <div class="mt-4">
                    <h6>Associated Files</h6>
                    @if($files && $files->count() > 0)  <!-- Check if $files is not null and contains data -->
                        @foreach($files as $file)
                            <div class="file-iframe mb-3">

                                <iframe src="{{ asset('storage/' . $file->file_path) }}" width="100%" height="400" frameborder="0"></iframe>
                            </div>
                        @endforeach
                    @else
                        <p>No associated files available.</p>  <!-- Display message if no files found -->
                    @endif
                </div>

                @if(session('message'))
                    <h6 class="alert alert-warning mb-3">{{ session('message') }}</h6>
                @endif

                <div class="comment-area mt-4">
                    <div class="card card-body">
                        <h6 class="card-title">Leave a comment</h6>
                        <form action="{{ url('comments') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_slug" value="{{ $post->slug }}">
                            <textarea name="comment_body" class="form-control" rows="3" required></textarea>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>

                @forelse ($post->comments as $comment)
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
                            <a href="{{ url('program/' . $latest_post_item->Program->slug . '/' . $latest_post_item->slug) }}" class="text-decoration-none">
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
