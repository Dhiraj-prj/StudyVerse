@extends('layouts.app')

@section('title', config("app.name"))

@section('content')

<!-- About Section -->
<div class="py-4 bg-light" style="background-image: url('{{ asset('images/HomeAboutSection.png') }}'); background-size: cover; background-position: center;">
    <div class="container py-2">
        <div class="row">
            <div class="col-md-5 text-white py-5"> <!-- Changed to col-md-3 for the text area -->
                <h2 class="font-weight-bold text-primary">{{ config('app.name') }}</h2>
                <div class="underline mb-4"></div>
                <p class="lead text-light">
                    StudyVerse is a comprehensive online learning platform designed to support students in their academic journey.
                    We provide past questions, study notes, and syllabi to make learning more accessible. Join us and enhance
                    your learning experience with the tools and support you need to excel.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Faculties Section -->
<div class="py-4 bg-white mt-5 shadow-sm">
    <div class="container">
        <div class="row mb-5 text-center">
            <div class="col-md-12">
                <h3 class="font-weight-bold text-dark">Faculties</h3>
                <div class="underline mx-auto mb-4"></div>
            </div>

            @foreach ($all_categories as $category)
                <div class="col-md-3 mb-4">
                    <div class="card border-0 rounded-lg shadow-sm hover-shadow">
                        <div class="card-body text-center">
                            <a href="{{ url('faculty/'.$category->slug) }}" class="text-decoration-none text-dark">
                                <h5 class="mb-0">{{ $category->name }}</h5>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="text-center mt-4">
                <a href="{{ url('faculty') }}" class="btn btn-primary custom-btn">See More</a>
            </div>
        </div>

        <!-- Pagination for Faculties -->
        <div class="row">
            <div class="col-md-12 text-center">
                {{ $all_categories->links('pagination::bootstrap-5') }}
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
                            <a href="{{ url('faculty/'.$post->category->slug.'/'.$post->slug) }}" class="text-decoration-none text-dark">
                                <h5 class="mb-0">{{ $post->name }}</h5>
                            </a>
                            <p class="text-muted small mb-0">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post->description), 100, '...') }}
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
<div class="py-3 bg-dark text-white">
    <div class="container">
        <div class="border text-center p-5 bg-light shadow-sm rounded-lg">
            <h3 class="font-weight-bold text-dark">Advertise Here</h3>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    /* Background image for About Section */
    .bg-light {
        background-color: #f8f9fa;
    }

    .bg-white {
        background-color: #ffffff;
    }

    .bg-dark {
        background-color: #343a40;
    }

    .text-dark {
        color: #343a40;
    }

    .text-muted {
        color: #6c757d;
    }

    /* Button Style */
    .custom-btn {
        background-color: #007bff;
        color: white;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 30px;
        transition: all 0.3s ease;
    }

    .custom-btn:hover {
        background-color: #0056b3;
        opacity: 0.8;
    }

    /* Card Styles */
    .card {
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .card-body {
        padding: 20px;
    }

    .card-shadow {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .hover-shadow:hover {
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }

    /* Heading Styles */
    h3 {
        font-size: 2rem;
        font-weight: 700;
        color: #343a40;
    }

    /* Underline for headings */
    .underline {
        width: 60px;
        height: 3px;
        background-color: #007bff;
        margin: 0 auto;
    }

    /* Spacing */
    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .mb-0 {
        margin-bottom: 0;
    }

    .text-center {
        text-align: center;
    }

    .lead {
        font-size: 1.25rem;
        color: #6c757d;
    }

    .font-weight-bold {
        font-weight: 700;
    }

    .p-5 {
        padding: 3rem;
    }

    .mx-auto {
        margin-left: auto;
        margin-right: auto;
    }

    .rounded-lg {
        border-radius: 12px;
    }
</style>
@endsection
