@extends('layouts.master')
@section('content')
<section>
    <div class="tab-content" style="margin-right: 15%; margin-top: 5%;">
        <div class="card">
        <div class="card-body">
        <div class="e-profile">
            <div class="row">
                <div
                    class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                    <div class="text-center text-sm-left mb-2 mb-sm-0">
                        <h2 class="pt-sm-2 pb-1 mb-0 text-nowrap">
                            {{$user->fullname}}
                        </h2>
                    </div>
                </div>
            </div>
            <form class="form" novalidate="" action="#" method="post">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="hidden" name="id"
                                value="{{$user->id}}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <label><b>Full Name: </b></label>
                            </div>
                            <div class="col">
                                {{$user->fullname}}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label for="phonenumber"><b>Phone number:</b></label>
                            </div>
                            <div class="col">
                                <p>{{$user->phonenumber}}</p>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label for="email"><b>Email: </b></label>
                            </div>
                            <div class="col">
                                <p>{{$user->email}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-end">
                        <a href='javascript:history.back(1);' style="float: right;"><button type="button" class="btn btn-primary">Back</button></a>
                    </div>
                </div>
            </form>
        </div>
        </div>
        </div>
        </div>
</section>
@endsection
