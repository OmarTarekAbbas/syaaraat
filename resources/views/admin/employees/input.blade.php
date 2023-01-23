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

            <form action="{{ isset($getEmployee) ? url('admin/employees',$getEmployee->id) : url('admin/employees') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                @isset($getEmployee)
                <input type="hidden" name="_method" value="PUT" />
                @endisset
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="firstName" value="{{ isset($getEmployee) ? $getEmployee->firstName : old('firstName') }}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lastName" value="{{ isset($getEmployee) ? $getEmployee->lastName : old('lastName') }}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Salary</label>
                    <input type="text" class="form-control" name="salary" value="{{ isset($getEmployee) ? $getEmployee->salary : old('salary') }}">
                </div>
                <div class="mb-3">
                    @isset($getEmployee)
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <img src="{{ url('upload/employee/',  $getEmployee->image ) }}" width="50%">
                        </div>
                    </div>
                    @endisset
                    <div class="form-group">

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="image" type="file"  placeholder="image" id="image" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="department_id" required>
                        @foreach($departments as $department)
                        <option  value="{{$department->id}}">{{$department->title}}</option>
                        @endforeach

                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>

    </div>
</div>
<div class="col-md-4">
</div>
</div>
@stop