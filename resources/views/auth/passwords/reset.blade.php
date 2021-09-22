@extends('layouts.app')

@section('title', 'Reset Password | WebAcquire')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card d-flex flex-row my-card login">
                    <div class="col-md-6 d-flex flex-column justify-content-center login-side-image">
                        <img src="{{ asset('images/auth/reset password/reset_password_side_img.png') }}" alt="image" width="400px">
                    </div>
                    <div class="col-md-6 login-body">
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}" id="reset-password-form">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
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
                                            class="form-control @error('email') is-invalid @enderror"
                                            name="email"
                                            value="{{ $email ?? old('email') }}"
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
                                    <div class="col-md-12">
                                        <input
                                            id="password-confirm"
                                            type="password"
                                            class="form-control"
                                            name="password_confirmation"
                                            placeholder="Confirm your password"
                                            autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Reset Password') }}
                                        </button>
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
            $.validator.addMethod('myPasswordPattern', function(value, element) {
            return this.optional(element) || (value.match(/[a-z]/) && value.match(/[0-9]/ && value.match(/[A-Z]/)));
        },
        'Password must contain at least one numeric, one capital and one small character.');
        $("#reset-password-form").validate({
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
                        myPasswordPattern: true,
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 8,
                        maxlength: 16,
                        myPasswordPattern: true,
                        equalTo: "#password"
                    }
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
