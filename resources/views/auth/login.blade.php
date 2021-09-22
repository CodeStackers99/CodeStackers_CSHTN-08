@extends('layouts.app')

@section('title', 'Login | WebAcquire')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card d-flex flex-row my-card login">
                    <div class="col-md-6 d-flex flex-column justify-content-center login-side-image">
                        <img src="{{ asset('images/auth/Login/login_side_img.png') }}" alt="image" width="400px">
                    </div>
                    <div class="col-md-6 login-body">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}" id="login-form">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-12 m-0 text-center ml-3 p-0">
                                        <img
                                            src="{{ asset('images/auth/Login/login_person.png') }}"
                                            alt="image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input
                                                id="email"
                                                type="email"
                                                class="form-control @error('email') is-invalid @enderror user-select-none"
                                                name="email"
                                                placeholder="Enter your email"
                                                value="{{ old('email') }}"
                                                autocomplete="email"
                                                autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input
                                                id="password"
                                                type="password"
                                                class="form-control @error('password') is-invalid @enderror user-select-none"
                                                name="password"
                                                placeholder="Enter your password"
                                                autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label user-select-none" for="remember" >
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12 d-flex justify-content-between m-0 login-last-row">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="nav-link mr-0 pr-0" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function mediaWatcherFunction(mediaWatcher) {
            if (mediaWatcher.matches) {
                $(".card").addClass("p-0");
            } else {
                $(".card").removeClass("p-0");
            }
        }
        var mediaWatcher = window.matchMedia("(max-width: 992px)");
        mediaWatcherFunction(mediaWatcher);
        mediaWatcher.addListener(mediaWatcherFunction);
    </script>

    <script>
        $("#login-form").validate({
            rules:
                {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        maxlength: 16,
                    },
                },

            errorElement: 'p',
            errorPlacement: function(error, element) {
                if (error) {
                    error.insertAfter(element);
                    error.addClass('text-danger');
                }
            }
        });
    </script>
@endsection
