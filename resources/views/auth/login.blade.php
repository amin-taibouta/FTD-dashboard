@extends('layouts.auth')

@section('main-content')
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container-xl px-4">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <!-- Basic login form-->
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                        
                            <div class="card-header justify-content-center">
                                <img with="150" height="75" src="{{ asset('img/ftd-logo.png') }}" class="img-fluid" alt="FTD logo" />
                                <h3 class="fw-light my-4">Login into your dashboard</h3>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                <div class="alert alert-danger alert-icon" role="alert">
                                    <div class="alert-icon-aside">
                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                    </div>
                                    <div class="alert-icon-content">
                                        <ul class="pl-4 my-2">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endif
                                <!-- Login form-->
                                <form method="POST" action="{{ route('login') }}" >
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <!-- Form Group (email address)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="email">Your Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autofocus />
                                    </div>
                                    <!-- Form Group (password)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="password">Password</label>
                                        <input class="form-control" id="password" type="password" name="password" placeholder="{{ __('Password') }}" required />
                                    </div>
                                    <!-- Form Group (remember password checkbox)-->
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }} />
                                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                                        </div>
                                    </div>
                                    <!-- Form Group (login box)-->
                                    @if (Route::has('password.request'))
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                    @endif
                                </form>
                            </div>
                            @if (Route::has('password.register'))
                            <div class="card-footer text-center">
                                <div class="small"><a href="{{ route('register') }}">{{ __('Create an Account!') }}</a></div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    @include('layouts.footer')
</div>
@endsection