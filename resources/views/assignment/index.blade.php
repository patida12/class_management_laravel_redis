@extends('layouts.master')
@section('content')
<section>
    <div class="tab-content">
        @if (session('error_upload'))
            <div class="alert alert-danger alert-dismissible fade show w-50" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('error_upload') }}
            </div>
        @endif

        @if (session('success_upload'))
            <div class="alert alert-success alert-dismissible fade show w-50" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success_upload') }}
            </div>
        @endif

        @if (session('success_delete'))
            <div class="alert alert-success alert-dismissible fade show w-50" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success_delete') }}
            </div>
        @endif
        @if(Auth::user()->isTeacher())
        <div style="margin-bottom: 10px;">
            <div class="col-sm-12">
                <form action="/assignment/create" method="get" style="margin-left: -14px;">
                    <button type="submit" class="btn btn-primary">
                         Add Assignment
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
                        <th>Name</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignments as $assignment)
                    <tr>
                      <td>{{$loop->index + 1}}</td>
                      <td>{{$assignment->name}}</td>
                      <td>{{$assignment->created_at}}</td>
                      <td>
                        <a href="/submission/assignment/{{$assignment->id}}">
                            <button class="btn btn-sm btn-info">
                                Submission
                              </button>
                        </a>
                        <a href="/assignment/download/{{$assignment->id}}">
                            <button class="btn btn-sm btn-warning">
                                Download
                              </button>
                        </a>
                        @if(Auth::user()->isTeacher())
                        <a href="/assignment/delete/{{$assignment->id}}" method="post">
                          <button onclick="return confirm('Do you want to delete this assignment?')" class="btn btn-danger btn-sm">
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
