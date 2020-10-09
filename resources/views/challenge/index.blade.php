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
        @if(Auth::user()->isTeacher())
        <div style="margin-bottom: 10px;">
            <div class="col-sm-12">
                <form action="/challenges/create" method="get" style="margin-left: -14px;">
                    <button type="submit" class="btn btn-primary">
                         Add Challenge
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
                        <th>Challenge</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($challenges as $challenge)
                    <tr>
                      <td>{{$loop->index + 1}}</td>
                      <td>Challenge {{$loop->index + 1}}</td>
                      <td>{{$challenge->created_at}}</td>
                      <td>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal{{$loop->index + 1}}">Answer</button>
                                <div class="modal" id="myModal{{$loop->index + 1}}">
                                    <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                        <h4 class="modal-title">Question {{$loop->index + 1}}</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                        <p>{{$challenge->description}}</p>

                                        </div>

                                        <div class="modal-footer">
                                        <form action="/challenges/answer/{{$challenge->id}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <label>(Viết thường, không dấu, mỗi từ cách nhau 1 khoảng trống, ví dụ: cau tra loi)</label>
                                            <input type="text" name="answer" id="answer" style="margin-bottom: 3%;" placeholder="Answer here..." class="form-control  @error('answer') is-invalid @enderror"><br>
                                            @error('answer')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input type="submit" value="Submit" class="btn btn-primary">
                                        </form>
                                        </div>

                                    </div>
                                    </div>
                                </div>
                        @if(Auth::user()->isTeacher())
                        <a href="/challenges/delete/{{$challenge->id}}" method="post">
                          <button onclick="return confirm('Do you want to delete this challenge?')" class="btn btn-danger btn-sm">
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
