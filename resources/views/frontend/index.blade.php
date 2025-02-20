@extends('layouts.app')

@section('title', $setting->meta_title)

@section('meta_description', $setting->meta_description)

@section('meta_keyword', $setting->meta_keyword)

@section('content')

<!-- Program Heading -->
@if(isset($program))
    <div class="program-heading">
        <h4>{{ $program->name }}</h4>
    </div>
@endif

<!-- Posts Section -->
@if(isset($posts) && count($posts) > 0)
    @foreach ($posts as $postitem)
        <div class="card card-shadow mt-4">
            <div class="card-body">
                <a href="{{ url('program/'.$program->slug .'/' . $postitem->slug)}}" class="text-decoration-none">
                    <h2 class="post-heading">{{ $postitem->name }}</h2>
                </a>
                <div class="container">
                    <div class="float-start">
                        <h6>Posted on: {{ $postitem->created_at->format('d-m-Y') }}</h6>
                    </div>
                    <div class="float-end">
                        <h6>Posted by: {{ $postitem->user->name }}</h6>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

<!-- About Section -->
<div class="py-4 bg-light lazy-bg" style="background-image: url('{{ asset('images/HomeAboutSection (1).png') }}'); background-size: cover; background-position: center;">
    <div class="container py-2">
        <div class="row">
            <div class="col-md-5 text-white py-5">
                <h2 class="font-weight-bold text-primary">{{ config('app.name') }}</h2>
                <div class="underline"></div>
                <p class="lead text-light">
                    StudyVerse is a comprehensive online learning platform designed to support students in their academic journey.
                    We provide past questions, study notes, and syllabus to make learning more accessible.
                </p>
                <p class="lead text-light">Join us and enhance your learning experience with the tools and support you need to excel.</p>
            </div>
        </div>
    </div>
</div>

<!-- Programs Section -->
<div class="py-4 bg-white mt-5 shadow-sm">
    <div class="container">
        <div class="row mb-5 text-center">
            <div class="col-md-12">
                <h3 class="font-weight-bold text-dark">Programs</h3>
                <div class="underline mx-auto mb-4"></div>
            </div>

            @foreach ($all_programs as $programItem)
                <div class="col-md-3 mb-4">
                    <div class="card border-0 rounded-lg shadow-sm hover-shadow">
                        <div class="card-body text-center">
                            <a href="{{ url('program/'.$programItem->slug) }}" class="text-decoration-none text-dark">
                                <h5 class="mb-0">{{ $programItem->name }}</h5>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination for Programs -->
        <div class="row">
            <div class="col-md-12 text-center">
                {{ $all_programs->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Latest Posts Section -->
<div class="py-4 bg-light">
    <div class="container">
        <div class="row mb-5 text-center">
            <div class="col-md-12">
                <h3 class="font-weight-bold text-dark">Latest Posts</h3>
                <div class="underline mx-auto mb-4"></div>
            </div>

            @foreach ($all_posts as $post)
                <div class="col-md-3 mb-4">
                    <div class="card border-0 rounded-lg shadow-sm hover-shadow">
                        <div class="card-body">


                            <a href="{{ $post->program ? url('program/'.$post->program->slug.'/'.$post->slug) : '#' }}" class="text-decoration-none text-dark">
                                <h5 class="mb-0">{{ $post->name }}</h5>
                            </a>

                            <p class="text-muted small mb-0">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post->description ?? 'No description available'), 100, '...') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="text-center mt-4">
                <a href="{{ url('posts') }}" class="btn btn-primary custom-btn">See More</a>
            </div>
        </div>

        <!-- Pagination for Posts -->
        <div class="row">
            <div class="col-md-12 text-center">
                {{ $all_posts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Advertisement Section -->
<div class="py-3 text-white" style="background-color: #8e71d1">
    <div class="container">
        <div class="border text-center p-5 bg-light shadow-sm rounded-lg">
            <h3 class="font-weight-bold text-dark">Advertise Here</h3>
        </div>
    </div>
</div>

@endsection



<style>
    /* Hover effects */
    .card:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }
    .custom-btn:hover {
        transform: scale(1.1);
        opacity: 0.9;
        transition: transform 0.3s ease;
    }
    .bg-dark:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }
    .card-body:hover a {
        color: #007bff;
        text-decoration: underline;
        transition: color 0.3s ease, text-decoration 0.3s ease;
    }
    h3:hover {
        transform: scale(1.05);
        color: #0056b3;
        transition: transform 0.3s ease, color 0.3s ease;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const lazyBackgrounds = document.querySelectorAll('.lazy-bg');

        const loadBackground = (element) => {
            const bgUrl = element.getAttribute('data-bg');
            if (bgUrl) {
                element.style.backgroundImage = `url(${bgUrl})`;
                element.classList.remove('lazy-bg');
            }
        };

        const inViewport = (element) => {
            const rect = element.getBoundingClientRect();
            return rect.top <= window.innerHeight && rect.bottom >= 0;
        };

        const onScroll = () => {
            lazyBackgrounds.forEach(element => {
                if (inViewport(element)) {
                    loadBackground(element);
                }
            });
        };

        window.addEventListener('scroll', onScroll);
        onScroll(); // Check initially in case the image is already in the viewport
    });
</script>
