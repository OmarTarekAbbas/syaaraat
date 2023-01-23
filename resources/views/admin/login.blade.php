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
            <div class="card-body">
                @if (session('notFound'))
                <div class="alert alert-danger" role="alert">
                    {{ session('notFound') }}
                </div>
                @endif
            </div>
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
            <form action="{{url('admin/login')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email Or Phone</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="emailOrPhone">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
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
            <a class="dropdown-item" href="{{url('admin/register')}}" style="color: blue; background: #CCCCFF;"> Register</a>
        </div>

    </div>
</div>
<div class="col-md-4">
</div>
</div>

@stop