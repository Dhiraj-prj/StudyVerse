@extends('layouts.master')

@section('title','Faculty')
@section('content')

<div>
    <div class="container-fluid px-4">

        <div class="card mt-4">
            <div class="card-header">
                <h4 class="float-start">View Users</h4>
            </div>

            <div class="card-body">

                @if (@session('message'))
                 <div class="alert alert-success">{{ session('message') }}</div>
                @endif



                <div class="table-responsive">
                <table id="myTable" class="table display table-bordered table-fixed" style="border-top: 1px solid #dee2e6;">
                    <thead>
                        <tr>
                            <th style="width: 5%;">S.N.</th>
                            <th style="width: 20%;">Name</th>
                            <th style="width: 10%;">Phone Number</th>
                            <th style="width: 10%;">Email</th>
                            <th style="width: 10%;">Date of Birth</th>
                            <th style="width: 10%;">Role</th>
                            <th style="width: 15%;">Status</th>
                            <th style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $item)
                        <tr>
                            <td>{{ $index + 1}}</td>
                            <td>{{ $item -> name}}</td>
                            <td>{{ $item -> phone}}</td>
                            <td>{{ $item -> email}}</td>
                            <td>{{ $item -> dob}}</td>
                            <td>{{ $item -> role_as=='1' ? "Admin":"Registered User"}}</td>
                            <td>{{ $item->created_at}}</td>
                            <td>

                               <a href="{{url('admin/edit-users/'.$item->id)}}"><button class="btn btn-success"><i class="fas fa-edit"></i></button></a>
                               <a href="{{('delete-category/'.$item->id)}}"><button class="btn btn-danger"><i class="fas fa-eye"></i></button></a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>






        </div>
</div>


@endsection

