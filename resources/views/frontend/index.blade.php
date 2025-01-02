@extends('layouts.app')

{{-- @section('title',{{ config('app.name')}}) --}}

{{-- @section('title')
    StudyVerse
@endsection --}}

@section('title', config("app.name"))
@section('content')

<div class="py-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="border p-3 bg-light shadow">
                    <h4>{{ config('app.name') }}</h4>
                    <div class="underline"></div>
                    <p style="text-align: justify">
                        StudyVerse is a comprehensive online learning platform designed to support students in their academic journey. We understand the challenges students face when it comes to finding relevant resources, and that's why StudyVerse provides a range of tools to make learning more accessible and effective. Our platform is tailored to provide an interactive and personalized experience that caters to students' unique needs, ensuring they have the right resources to succeed.
                        One of the standout features of StudyVerse is our extensive collection of past questions, study notes, and syllabus. We regularly post past exam questions across various subjects, helping students prepare more efficiently for upcoming tests. Our well-organized and easy-to-understand study notes cover key concepts, offering concise and detailed explanations that complement your learning. Additionally, we ensure that the syllabus for each subject is readily available, helping students stay on track and align their studies with the curriculum.
                        At StudyVerse, we believe in the power of collaboration. Our platform fosters a supportive community where students can share knowledge, discuss topics, and help each other out. Whether you're preparing for exams or looking to deepen your understanding of a subject, StudyVerse is your one-stop resource hub. Join us today and enhance your learning experience with the tools and support you need to excel.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-4">
    <div class="container">
        <div class="border text-center p-3 bg-light shadow">
            <h3>Advertise here</h3>
        </div>
    </div>
</div>

@endsection
