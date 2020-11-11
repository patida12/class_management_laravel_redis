<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{asset('./favicon.ico')}}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Class Management Laravel</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="{{ asset('./css/app.css')}}" type="text/css">
</head>

<body>
    <header style="height: 60px">
        <h3><i class="fa fa-graduation-cap">ClassManagement</i></h3>
    </header>

    <section style="margin-top: 30px;">
        <ul id="ul_index" class="nav flex-column" >
            <li class="nav-item">
                <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="{{ url('home') }}"><i class="fa fa-home"> Home</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Request::is('chat') ? 'active' : '' }}" href="{{ url('chat') }}"><i class="fa fa-comments"> ChatRoom</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('assignment') ? 'active' : '' }}" href="{{ url('assignment') }}"><i class="fa fa-book"> Assignment</i></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{ Request::is('teachers') ? 'active' : '' }}" href="{{ url('teachers') }}"><i class="fa fa-user"> Teachers</i></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{ Request::is('students') ? 'active' : '' }}" href="{{ url('students') }}"><i class="fa fa-users"> Students</i></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{ Request::is('challenges') ? 'active' : '' }}" href="{{ url('challenges') }}"><i class="fa fa-gamepad"> Challenge</i></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{ Request::is('users/profile') ? 'active' : '' }}" href="{{ url('users/profile') }}"><i class="fa fa-user-circle"> Profile</i></a>
            </li>
        </ul>
    </section>
    @section('content') @show

</body>

</html>
