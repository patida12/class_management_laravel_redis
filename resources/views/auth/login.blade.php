@extends('layouts.app')

@section('content')
<body class="mt-2">
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show w-25 m-auto" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('error') }}
        </div>
    @endif
    <div class="modal-dialog mt-5">
        <div class="modal-content">
            <div class="modal-header" style="background-color: blue; color: white;">
                <h3 class="modal-title">Log in!</h3>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="post" action="/authenticate">
                        <div class="form-group">
                            <label for="username">{{ __('User Name') }}</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" required>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection

