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

            <form action="{{ isset($getTask) ? url('admin/tasks',$getTask->id) : url('admin/tasks') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                @isset($getTask)
                <input type="hidden" name="_method" value="PUT" />
                @endisset
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ isset($getTask) ? $getTask->title : old('title') }}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Status</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="status" required>
                        <option value="1">Active</option>
                        <option value="0">notActive</option>

                    </select>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="employee_id" required>
                        @foreach($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->firstName}} {{$employee->lastName}}</option>
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