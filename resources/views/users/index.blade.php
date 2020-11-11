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

        @if(Auth::user()->isTeacher() && !$isListTeacher)
        <div style="margin-bottom: 10px;">
            <div class="col-lg-6">
                <form action="/students/create" method="get" style="margin-left: -14px;">
                    <button type="submit" class="btn btn-primary">
                         Add Student
                    </button>
                </form>
            </div>
        </div>
        @endif
        @if(!$isListTeacher)
        <div>
        <form method="POST" action="/students">
            @csrf
            <div class="row">
                <div class="form-group col-2">
                    <select class="form-control @error('searchBy') is-invalid @enderror" id="searchBy" name="searchBy">
                        <option value="" selected disabled>Search By</option>
                        <option value="fullname">Name</option>
                        <option value="email">Email</option>
                        <option value="phonenumber">Phone Number</option>
                    </select>
                    @error('searchBy')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group col-3">
                    <input class="form-control @error('keyword') is-invalid @enderror" type="text" placeholder="Search.." name="keyword" id="keyword">
                    @error('keyword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group" style="margin-top: -1px;">
                    <button class="btn btn-secondary btn-md" type="submit"><i class="fa fa-search"></i></button>
                </div>

            </div>

            </form>
        </div>
        <br>
        @endif

        <div class="table-wrapper-scroll-y my-custom-scrollbar">
            <table id="table" class="table table-hover table-bordered table-striped table-inverse table-wrapper-scroll-y" cellspacing="0">
                <thead class="thead-inverse">
                    <tr style="background-color: #555; color: white; text-align: center">
                        <th>STT</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>{{$loop->index + 1}}</td>
                      <td>{{$user->fullname}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->phonenumber}}</td>
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
                        @if(Auth::user()->isTeacher() && !$isListTeacher)
                        <a href="/students/delete/{{$user->id}}" method="post">
                          <button onclick="return confirm('Do you want to delete this student?')" class="btn btn-danger btn-sm">
                            Delete
                          </button>
                        </a>
                        @endif
                        @endif
                      </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if(!$isListTeacher && !$isSearching)
            <div class="d-flex justify-content-center">
                {!! $users->links() !!}
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
