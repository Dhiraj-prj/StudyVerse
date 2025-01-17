<div class="global-navbar">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary p-3">
        <div class="container">
            <a class="navbar-brand" href="/home">{{config('app.name')}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Faculties Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Faculties
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                            @php
                                $categories = App\Models\Category::where("navbar_status", "0")->where('status', '0')->where('is_deleted','0')->get();
                            @endphp

                            @foreach($categories as $cateitem)
                                <li><a class="dropdown-item" href="{{url('faculty/'.$cateitem->slug)}}">{{$cateitem->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- Notes Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="notesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Notes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="notesDropdown">
                            <li><a class="dropdown-item" href="notes.html?faculty=BBS&program=yearly">BBS</a></li>
                            <li><a class="dropdown-item" href="notes.html?faculty=BBA&program=semester">BBA</a></li>
                            <li><a class="dropdown-item" href="notes.html?faculty=BCA&program=yearly">BCA</a></li>
                        </ul>
                    </li>

                    <!-- Past Questions Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="questionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Past Questions
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="questionsDropdown">
                            <li><a class="dropdown-item" href="past-questions.html?faculty=BBS&program=yearly">BBS</a></li>
                            <li><a class="dropdown-item" href="past-questions.html?faculty=BBA&program=semester">BBA</a></li>
                        </ul>
                    </li>

                    <!-- Syllabus Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="syllabusDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Syllabus
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="syllabusDropdown">
                            <li><a class="dropdown-item" href="syllabus.html?faculty=BBS&program=yearly">BBS</a></li>
                            <li><a class="dropdown-item" href="syllabus.html?faculty=BCA&program=semester">BCA</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        @if (Auth::check())
                        <li> <a class="nav-link btn-danger  text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form> </li>
                            @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- CSS for Hover Effect -->
<style>
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
        transition: opacity 0.2s ease-in-out;
    }

    .dropdown-menu {
        border-radius: 0.5rem;
        padding: 0.5rem;
    }

    .nav-link {
        font-size: 1rem;
        font-weight: 500;
    }
</style>
