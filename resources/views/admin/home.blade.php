@extends('admin.master')
@section('content')
<?php
$login = \Session::get('admin');

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br>
            <br>
            <br>
            <br>
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if($login)
                    Welcome
                    @else
                    <a class="dropdown-item" href="{{url('admin/register')}}" style="color: blue; background: #CCCCFF;"> Register</a>
                    <h6>New around here?</h4> <a class="dropdown-item" href="{{url('admin/login')}}" style="color: blue; background: #CCCCFF;"> Sign up</a>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

@stop