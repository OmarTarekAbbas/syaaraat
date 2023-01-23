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
            <a class="btn btn-warning" href="{{url('admin/departments')}}">
                Back
            </a>
            <br>
            <br>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Department Title</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Count Employees</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <th scope="row">{{$department->id}}</th>
                        <td>{{$department->title}}</td>
                        <td>{{$searchSalaryEmployeeByDepartments}} $</td>
                        <td>{{$countEmployeeByDepartments}}</td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>

</div>

@stop