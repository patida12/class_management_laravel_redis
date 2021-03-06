@extends('layouts.master')
@section('content')
<div class="tab-content">
@if(!Auth::user()->isTeacher())
<div class="row" style="margin-left: 10%">
    <div class="col-md-8">
        <div class="card">
            <h3 class="card-header bg-primary text-center" style="color: white">{{ __('Add Submission') }}</h3>

            <div class="card-body">
                <form action="/submission/upload/{{$id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="uploaded_file" name="uploaded_file" class="form-control-file  @error('uploaded_file') is-invalid @enderror">
                    @error('uploaded_file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <input type="submit" value="Upload file" style="margin-bottom: 1%; margin-top: 1%;">
                    <a class="btn btn-danger" href='javascript:history.back(1);' style="float: right;">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@else
<h2>You don't have permisson!</h2>
@endif
</div>
@endsection
