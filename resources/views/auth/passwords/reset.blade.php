
@extends('layouts.auth')

@section('main-content')
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container-xl px-4">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <!-- Basic forgot password form-->
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header justify-content-center"><h3 class="fw-light my-4">{{ __('Password Recovery') }}</h3></div>
                            <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger alert-icon" role="alert">
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
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


                                <div class="small mb-3 text-muted">{{ __('Choose a new password.') }}</div>
                                <!-- Forgot password form-->
                                <form method="POST" action="{{ route('password.update') }}">
                                    
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <!-- Form Group (email address)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="email">Email</label>
                                        <input class="form-control" disabled id="email" type="email" name="email" aria-describedby="emailHelp" placeholder="{{ __('Email address') }}" value="{{ $email ?? old('email') }}" required autofocus/>
                                    </div>

                                    <div class="mb-3">
                                        <label class="small mb-1" for="password">{{ __('Password') }}</label>
                                        <input class="form-control" id="password" type="password" name="password"  placeholder="{{ __('Password') }}" required />
                                    </div>

                                    <div class="mb-3">
                                        <label class="small mb-1" for="password_confirmation">{{ __('Confirm Password') }}</label>
                                        <input class="form-control" id="password_confirmation" type="password" name="password_confirmation"  placeholder="{{ __('Confirm Password') }}" " required />
                                    </div>
                                    <!-- Form Group (submit options)-->
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    @include('layouts.footer')
</div>
@endsection
