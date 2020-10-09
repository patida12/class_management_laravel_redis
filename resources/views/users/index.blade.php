@extends('layouts.master')
@section('content')
<section>
    <div class="tab-content">
        @if (session('success_delete'))
        <div class="alert alert-success alert-dismissible fade show w-50" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success_delete') }}
        </div>
        @endif
        @if (session('success_update'))
            <div class="alert alert-success alert-dismissible fade show w-50" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success_update') }}
            </div>
        @endif
        @if (session('success_add'))
            <div class="alert alert-success alert-dismissible fade show w-50" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success_add') }}
            </div>
        @endif

        @if(Auth::user()->isTeacher())
        <div style="margin-bottom: 10px;">
            <div class="col-sm-12">
                <form action="/students/create" method="get" style="margin-left: -14px;">
                    <button type="submit" class="btn btn-primary">
                         Add Student
                    </button>
                </form>
            </div>
        </div>
        @endif

        <div class="table-wrapper-scroll-y my-custom-scrollbar">
            <table id="table" class="table table-hover table-bordered table-striped table-inverse table-wrapper-scroll-y" cellspacing="0">
                <thead class="thead-inverse">
                    <tr style="background-color: #555; color: white;">
                        <th>STT</th>
                        <th>User Name</th>
                        <th>Full Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>{{$loop->index + 1}}</td>
                      <td>{{$user->username}}</td>
                      <td>{{$user->fullname}}</td>
                      <td>
                        <a href="/users/show/{{$user->id}}">
                            <button class="btn btn-sm btn-info">
                                Show
                              </button>
                        </a>
                        @if(Auth::user()->isTeacher())
                        <a href="/students/edit/{{$user->id}}">
                            <button class="btn btn-sm btn-warning">
                                Edit
                              </button>
                        </a>
                        <a href="/students/delete/{{$user->id}}" method="post">
                          <button onclick="return confirm('Do you want to delete this student?')" class="btn btn-danger btn-sm">
                            Delete
                          </button>
                        </a>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
