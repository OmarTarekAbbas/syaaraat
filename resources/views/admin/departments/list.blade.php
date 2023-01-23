@extends('admin.master')
@section('content')

<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div class="box">
            <br>
            <br>
            <br>
            <br>
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="card-body">
                @if (session('notFound'))
                <div class="alert alert-danger" role="alert">
                    {{ session('notFound') }}
                </div>
                @endif
            </div>
            <a class="btn btn-primary" href="{{url('admin/departments/create')}}">
                Add Departments
            </a>
            <br>
            <br>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Department</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($departments as $department)
                    <tr>
                        <th scope="row">{{$department->id}}</th>
                        <td>{{$department->title}}</td>
                        <td>
                        <a class="btn btn-primary" href="{{url('admin/departments/'.$department->id.'/edit')}}">Edit</a>
                            <a class="btn btn-danger" href="{{url('admin/departments/'.$department->id.'/delete')}}">Delete</a>
                            <a class="btn btn-success" href="{{url('admin/departments/'.$department->id.'/search')}}">Search</a>
                        </td>

                    </tr>
                </tbody>
                @empty
            </table>
            <h5>No Departments</h5>
            @endforelse
        </div>
    </div>

</div>

@stop