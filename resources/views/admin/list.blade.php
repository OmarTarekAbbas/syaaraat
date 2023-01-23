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

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                    <tr>
                        <th scope="row">{{$admin->id}}</th>
                        <td>{{$admin->email}}</td>
                        <td>{{$admin->phone}}</td>
                    </tr>
                    @endforeach


                </tbody>
            </table>

        </div>
    </div>

</div>

@stop