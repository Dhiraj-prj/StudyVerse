
<!-- Link to Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">

@extends('layouts.master')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4 class="float-start">Edit Post</h4>
        </div>

        <div class="card-body">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            <!-- Form to edit a post -->
            <form action="{{ url('admin/edit-post/' . $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Post Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $post->name }}" required>
                </div>

                <div class="form-group">
                    <label for="program">Program</label>
                    <select id="program" name="Program_id" class="form-control">
                        <option value="">Select Program</option>
                        @foreach($categories as $Program)
                            <option value="{{ $Program->id }}" {{ $Program->id == $post->Program_id ? 'selected' : '' }}>
                                {{ $Program->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="subProgram">Level</label>
                    <select id="subProgram" name="subProgram" class="form-control">
                        {{-- <option value="{{$post->subProgram}}"></option> --}}
                    </select>
                </div>

                <div class="mb-3">
                    <label for="">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ $post->slug }}">
                </div>

                <div class="mb-3">
                    <label for="">Description</label>
                    <textarea id="mySummernote" name="description" rows="5" class="form-control">{{ $post->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="">Youtube IFrame</label>
                    <input type="text" name="yt_iframe" class="form-control" value="{{ $post->yt_iframe }}">
                </div>

                <h4>SEO Tags</h4>
                <div class="mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ $post->meta_title }}">
                </div>

                <div class="mb-3">
                    <label for="">Meta Description</label>
                    <textarea name="meta_description" rows="4" class="form-control">{{ $post->meta_description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="">Meta Keywords</label>
                    <input type="text" name="meta_keyword" class="form-control" value="{{ $post->meta_keyword }}">
                </div>

                <h4>Status</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <input type="checkbox" name="status" {{ $post->status ? 'checked' : '' }}>
                            <label for="">Status</label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
        </div>
    </div>

    @endsection

    @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const programSelect = document.getElementById('program');
            const subProgramSelect = document.getElementById('subProgram');

            function populateSubProgram() {
                const ProgramId = programSelect.value;

                // Update the subProgram select to show loading text or default
                subProgramSelect.innerHTML = '<option value="">{{ $post->subProgram ? "Loading current level..." : "Select Level" }}</option>';

                if (!ProgramId) return;

                // Fetch levels for the selected Program
                fetch(`/admin/get-levels/${ProgramId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing options
                        subProgramSelect.innerHTML = '<option value="">Select Level</option>';

                        // Check if the response contains data (levels)
                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(level => {
                                const option = document.createElement('option');
                                option.value = level.id;
                                option.textContent = level.name;

                                // Pre-select the current subProgram if it's the same level
                                if (String(level.id) === String("{{ $post->subProgram }}")) {
                                    option.selected = true;
                                }

                                subProgramSelect.appendChild(option);
                            });
                        } else {
                            // If no levels found, show a message in the dropdown
                            subProgramSelect.innerHTML = '<option value="">No levels available</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching levels:', error);
                        alert('Failed to fetch levels. Please try again later.');
                        subProgramSelect.innerHTML = '<option value="">Error fetching levels</option>';
                    });
            }

            // Initially populate the subProgram when the page loads
            if (programSelect) {
                populateSubProgram();
                programSelect.addEventListener('change', populateSubProgram);
            }
        });
    </script>
    @endsection
