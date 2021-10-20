@extends('layouts.frontpage')

@section('content')

    <div class="row">
        <div class="col-6">

        </div>
        <div class="col-6">
            <div class="login-container">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h1 class="mb-3">Login</h1>
                        <div class="mb-4">
                            <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-danger btn-login">Login</button>
                        </div>

                        <div class="mb-4 d-flex justify-content-between p-3">
                            <a class="pe-enabled" data-bs-toggle="modal" data-bs-target="#registration">New user</a>
                            <a class="pe-enabled">Forgot password</a>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="registration" tabindex="-1" aria-labelledby="registration" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Registration</h1>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-4">
                            <input placeholder="Username" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input placeholder="Confirm password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="mb-1 d-flex justify-content-between">
                            <button type="button" class="pe-enabled btn btn-dark btn-register" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="pe-enabled btn btn-danger btn-register">Register</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        window.Echo.connector.pusher.connection.bind('connected', () => {
            console.log('connected');
        });

        Echo.channel('home')
            .listen('NewMessage', (e) => {
                console.log(e.message);
            });
    </script>

@endsection
