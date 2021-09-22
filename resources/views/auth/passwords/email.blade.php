@extends('layouts.app')

@section('title', 'Forgot Password | WebAcquire')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card d-flex flex-row my-card login">
                    <div class="col-md-6 d-flex flex-column justify-content-center login-side-image">
                        <img src="{{ asset('images/auth/forgot password/forgot_password_side_img.png') }}" alt="image" width="400px">
                    </div>
                    <div class="col-md-6 login-body">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}" id="forgot-password-form">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-12 m-0 text-center ml-3 p-0">
                                        <img
                                            src="{{ asset('images/auth/forgot password/forgot_password_person.png') }}"
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

                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Send Password Reset Link') }}
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
        $("#forgot-password-form").validate({
            rules:
                {
                    email: {
                        required: true,
                        email: true
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
