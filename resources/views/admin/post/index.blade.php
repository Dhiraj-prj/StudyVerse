@extends('layouts.master') <!-- Change this to your main layout -->

@section('title', 'Posts')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="float-start">View Posts</h4>
            <a href="{{ url('admin/add-post') }}" class="btn btn-primary float-end">Add Post</a>
        </div>

        <div class="card-body">

            @if (session('message'))
            <div id="message" class="alert alert-success">{{ session('message') }}</div>
            <script>
                // Wait for 3 seconds before hiding the message
                setTimeout(function() {
                    document.getElementById('message').style.display = 'none';
                }, 3000); // 3000 milliseconds = 3 seconds
            </script>
        @endif


            <div class="table-responsive">
            <table id="myTable" class="table display table-bordered" style="border-top: 1px solid #dee2e6;">
                <thead>
                    <tr>
                        <th style="width: 20%;">S.N.</th>
                        <th style="width: 20%;">Post Title</th>
                        <th style="width: 20%;">Faculty</th>
                        <th style="width: 10%;">Level</th>
                        <th style="width: 7%;">Created by</th>
                        <th style="width: 8%;">State</th>
                        <th style="width: 10%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($posts as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ optional($item->Category)->name }}</td>
                                <td>{{ $item->subcategory }}</td>
                                <td>{{ optional($item->Created_by)->name ?? 'N/A' }}</td>
                                <td>{{ $item->status == 1 ? 'Hidden' : 'Visible' }}</td>
                                <td>
                                    <a href="{{ url('admin/edit-post/'.$item->id) }}">
                                        <button class="btn btn-success"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ url('admin/delete-post/'.$item->id) }}">
                                        <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

@endsection
