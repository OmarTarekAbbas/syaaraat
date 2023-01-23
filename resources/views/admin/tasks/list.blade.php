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
            <div class="row">
                <div class="col-md-4">
                    <a class="btn btn-primary" href="{{url('admin/tasks/create')}}">
                        Add Tasks
                    </a>
                </div>

            </div>
            <br>
            <br>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Employee</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                    <tr>
                        <th scope="row">{{$task->id}}</th>
                        <td>{{$task->title}}</td>
                        @if($task->status == 1)
                        <td>Active</td>
                        @else
                        <td>notActive</td>
                        @endif
                        <td>{{$task->employees->firstName}}</td>
                        <!-- <td><a class="btn btn-primary" href="{{url('admin/tasks/'.$task->id.'/edit')}}">Edit</a></td>
                        <td>
                            <a class="btn btn-danger" href="{{url('admin/tasks/'.$task->id.'/delete')}}">Delete</a>
                        </td> -->

                    </tr>
                </tbody>
                @empty
            </table>
            <h5>No Task</h5>
            @endforelse
        </div>
    </div>

</div>

@stop