@extends('layouts.app')

@section('title', "$posts->meta_title")

@section('meta_description', "$posts->meta_description")

@section('meta_keyword', "$posts->meta_keyword")

@section('content')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="category-heading">
                        <h4>{!! $posts->name !!}</h4>
                    </div>

                    <div class="mt-3"> <h6>{{ $posts->category->name.' / '. $posts->name }}</h6> </div>

                    <div class="card card-shadow">
                        <div class="card-body">
                            {!! $posts->description !!}
                        </div>
                    </div>
                </div>

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
                            <a href="{{ url('faculty/'.$latest_post_item->category->slug.'/'.$latest_post_item->slug) }}" class="text-decoration-none"> 
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
