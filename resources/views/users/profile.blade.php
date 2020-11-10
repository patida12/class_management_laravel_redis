@extends('layouts.master')
@section('content')
<section>
<div class="tab-content" style="margin-right: 15%;">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show w-50" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
      <div class="card-body">
        <div class="e-profile">
          <div class="row">
            <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
              <div class="text-center text-sm-left mb-2 mb-sm-0">
                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{$user->username}}</h4>

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
            </div>
            <div class="row">
              <div class="col d-flex justify-content-end">
                <button name="submit" class="btn btn-primary" type="submit">Save Changes</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
