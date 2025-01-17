@extends('layouts.master')

@section('title','Faculty')

@section('content')


<div>
    <div class="container-fluid px-4">

        <div class="card mt-4">
            <div class="card-header">
                <h4 class="float-start">View Faculty</h4>
                <a href="{{url('admin/add-faculty')}}" class="btn btn-primary float-end btn-sm"> Add Faculty</a>
            </div>

            <div class="card-body">

                @if (@session('message'))
                 <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                <div class="table-responsive">
                <table id="myTable" class="table table-bordered table-stripped display table-fixed" style="border-top: 1px solid #dee2e6;">
                    <thead>
                        <tr style="margin-top:10ox;">
                            <th style="width: 10%;">S.N.</th>
                            <th style="width: 30%;">Faculty Name</th>
                            <th style="width: 10%;">Level Type</th>
                            <th style="width: 15%;">Status</th>
                            <th style="width: 10%;">Created by</th>
                            <th style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $index => $item)
                        <tr>
                            <td>{{ $index + 1}}</td>
                            <td>{{ $item -> name}}</td>
                            <td>{{ $item -> levelType == '1' ? "Semester":"Year"}}</td>
                            <td>{{ $item -> status=='1' ? "Hidden":"Shown"}}</td>
                            <td>{{ $item->Created_by->name ?? 'N/A' }}</td>
                            <td>

                               <a href="{{url('admin/edit-category/'.$item->id)}}"><button class="btn btn-success"><i class="fas fa-edit"></i></button></a>
                               <a href="{{('delete-category/'.$item->id)}}"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
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

