@extends('layouts.master')
@section('content')
<section>
<div class="tab-content" style="margin-right: 15%;">
    <div class="card">
      <div class="card-body">
        <div class="e-profile">
          <div class="row">
            <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
              <div class="text-center text-sm-left mb-2 mb-sm-0">
                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{$user->username}}</h4>
                <div class="mt-2">
                <i class="fa fa-inbox fa-2x btn" data-toggle='modal' data-target='#myModal'></i>
                <span class="badge">{{'count'}}</span>
                <div class="modal" id="myModal">
                  <div class="modal-dialog">
                  <div class="modal-content">

                      <div class="modal-header" style="background-color: blue; color: white;">
                      <h4 class="modal-title">Inbox</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <div class="modal-body">

{{--
                                <form action="sendMess.php" id="form_upload" method="POST">
                                    <input type="hidden" name="idSender" style="margin-top: 1%; margin-bottom: 1%;" value="{{$user->id}}" />
                                    <input type="hidden" name="idReceiver" style="margin-top: 1%; margin-bottom: 1%;" value="{{$idSender}}" />
                                    <input type="hidden" name="nameReceiver" style="margin-top: 1%; margin-bottom: 1%;" value="{{$sender}}" />
                                    <input type="submit" name="submit" value="Read" class="btn btn-primary btn-sm"><br>
                                </form>
                              </div> --}}

                      </div>
                  </div>
                  </div>
              </div>
                </div>
                <div class="mt-4">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-block btn-secondary">
                            <i class="fas fa-sign-out-alt"></i>
                              <span>Logout</span>
                        </button>
                    </form>
                </div>
              </div>
            </div>
          </div>
          <form method="POST" action="/users/updateProfile">
            @csrf
            <div class="row">
              <div class="col">
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <label for="phonenumber">{{ __('Phone Number') }}</label>
                        <input id="phonenumber" type="text" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{$user->phonenumber}}" required autocomplete="phonenumber" autofocus>

                        @error('phonenumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-6 mb-3">
                <div class="mb-2"><b>Change Password</b></div>

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="********" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="********" required autocomplete="new-password">
                    </div>
                  </div>
                </div>
              </div>
              {{-- <div class="col">
                  <div class="form-group">
                    <input type="hidden" name="id" value="{{$user->id}}" />
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="fullname" value="{{$user->fullname}}" />
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="username" value="{{$user->username}}" />
                  </div>
              </div> --}}
            </div>
            <div class="row">
              <div class="col d-flex justify-content-end">
                <button name="submit" class="btn btn-primary" type="submit">Save Changes</button>
              </div>
            </div>
          </form>
        </div><a href="/home"><button class="btn btn-primary">Back</button></a>
      </div>
    </div>
  </div>
</section>
@endsection
