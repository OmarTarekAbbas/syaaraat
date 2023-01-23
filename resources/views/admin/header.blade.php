<!DOCTYPE html>
<html lang="en">
<?php
$login = \Session::get('admin');

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


</head>
@if($login)

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('admin/home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('admin/users')}}">Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('admin/departments')}}">Departments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('admin/employees')}}">Employees</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('admin/tasks')}}">Tasks</a>
            </li>
        </ul>
    </div>
</nav>
@endif