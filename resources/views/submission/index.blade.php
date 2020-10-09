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
        @if(!Auth::user()->isTeacher())
        <div style="margin-bottom: 10px;">
            <div class="col-sm-12">
            <form action="/submission/create/{{$assignment->id}}" method="get" style="margin-left: -14px;">
                    <button type="submit" class="btn btn-primary">
                         Add Submission
                    </button>
                </form>
            </div>
        </div>
        @endif

        @if(Auth::user()->isTeacher())
        <div class="table-wrapper-scroll-y my-custom-scrollbar">
            <table id="table" class="table table-hover table-bordered table-striped table-inverse table-wrapper-scroll-y" cellspacing="0">
                <thead class="thead-inverse">
                    <tr style="background-color: #555; color: white;">
                        <th>STT</th>
                        <th>Student</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignment->submissions as $submission)
                    <tr>
                      <td>{{$loop->index + 1}}</td>
                      <td>{{$submission->user->fullname}}</td>
                      <td>{{$submission->name}}</td>
                      <td>{{$submission->created_at}}</td>
                      <td>
                        <a href="/submission/download/{{$submission->id}}">
                            <button class="btn btn-sm btn-warning">
                                Download
                            </button>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        <a class="btn btn-danger" href='/assignment'>Back</a>
    </div>
</section>
@endsection
