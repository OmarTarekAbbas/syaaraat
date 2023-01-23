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
                    <a class="btn btn-primary" href="{{url('admin/employees/create')}}">
                        Add Employees
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="input-group">

                        <form action="{{url('admin/employees') }}" method="get">
                            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" name="search" value="{{request()->search}}" />
                            <br>
                            <button type="submit" class="btn btn-outline-primary">search</button>
                        </form>

                    </div>
                </div>
            </div>
            <br>
            <br>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Image</th>
                        <th scope="col">Department</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                    <tr>
                        <th scope="row">{{$employee->id}}</th>
                        <td>{{$employee->firstName .' '. $employee->lastName}}</td>
                        <td>{{$employee->firstName}}</td>
                        <td>{{$employee->lastName}}</td>
                        <td>{{$employee->salary}} $</td>
                        <td><img src="{{ url('upload/employee/',  $employee->image ) }}" width="50%"></td>
                        <td>{{$employee->departments->title}}</td>
                        <td><a class="btn btn-primary" href="{{url('admin/employees/'.$employee->id.'/edit')}}">Edit</a></td>
                        <td>
                            <a class="btn btn-danger" href="{{url('admin/employees/'.$employee->id.'/delete')}}">Delete</a>
                        </td>

                    </tr>
                </tbody>
                @empty
            </table>
            <h5>No Employees</h5>
            @endforelse
        </div>
    </div>

</div>

@stop