@extends('layouts.app', ['class' => 'bg-dark'])

@section('content')
<div class="header bg-gradient-warning py-7 py-lg-8">
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-dark" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</div>
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <div class="text-muted text-center mt-2 mb-3">
                            <img class="brand-img" src="{{ asset('argon') }}/img/brand/Kampus.png" width="70%">
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-left text-muted mb-4">
                            <small>Login with Username & Password:</small>
                        </div>
                        <form role="form" method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                            @csrf
                            @if (session('errors'))
                                <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                    Internal Server Error:
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            <div class="form-group{{ $errors->has('u_username') ? ' has-danger' : '' }} mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('u_username') ? ' is-invalid' : '' }}" placeholder="{{ __('Username') }}" type="text" name="u_username" value="{{ old('u_username') }}" required autofocus>
                                </div>
                                @if ($errors->has('u_username'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('u_username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('u_password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><a type="button" title="Click to show / hide password" onclick="toggleLock()"><i class="fas fa-lock" id="ps-icon"></i></a></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('u_password') ? ' is-invalid' : '' }}" name="u_password" id="u_password" placeholder="{{ __('Password') }}" type="password" required>
                                </div>
                                @if ($errors->has('u_password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('u_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheckLogin">
                                    <span class="text-muted">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <div class="text-center">
                                {{-- <button type="button" class="btn btn-white my-4" id="btn-reset">{{ __('Forgot Password') }}</button> --}}
                                <button type="submit" class="btn btn-primary my-4">{{ __('Log In') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-light">
                                <small>{{ __('Forgot password?') }}</small>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer bg-dark text-white">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6">
                    <div class="copyright text-center text-xl-left text-muted">
                        &copy; {{ now()->year }}
                        <a href="https://github.com/Tsucie">
                            Tsucie at <img src="{{ asset('argon') }}/img/icons/common/github.svg" alt="" width="20px" height="auto">
                        </a></div>
                </div>
                <div class="col-xl-6">
                    <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                        <li class="nav-item">
                            Sistem Manajemen Kampus
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
@endsection
