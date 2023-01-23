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
            @if(count($errors)>0)
            <div class="col-sm-12 alert alert-danger msg_danger_min bounce-in-bottom text-capitalize">
                <span class="closebtn" style="margin-left: 15px;color: black;font-weight: bold;float: right;font-size: 22px;cursor: pointer;transition: 0.3s;line-height: 20px;" onclick="this.parentElement.style.display='none';">&times;</span>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{url('admin/register')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{old('email')}}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Phone</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone" value="{{old('phone')}}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" >
                </div>
                <ul>
                    <li>Password :English uppercase characters (A – Z)</li>
                    <li>Password :English lowercase characters (a – z)</li>
                    <li>Password :Base 10 digits (0 – 9)</li>
                    <li>Password :Non-alphanumeric (For example: !, $, #, or %)</li>
                    <li>Password :Unicode characters</li>
                </ul>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div class="dropdown-divider"></div>
            <h6>New around here?</h4> <a class="dropdown-item" href="{{url('admin/login')}}" style="color: blue; background: #CCCCFF;"> Sign up</a>
        </div>

    </div>
</div>
<div class="col-md-4">
</div>
</div>

@stop