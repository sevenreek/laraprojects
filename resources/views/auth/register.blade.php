@extends('auth.base')

@section('content')

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form class="user" method="POST" action="{{ route('register') }}" id="register-form">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="First Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <div class="form-group" role="alert">
                                <strong style="color:red;">{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <div class="form-group" role="alert">
                                <strong style="color:red;">{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password" required autocomplete="new-password">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="password-confirm" placeholder="Repeat Password" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        @error('password')
                        <div class="form-group" role="alert">
                            <strong style="color:red;">{{ $message }}</strong>
                        </div>
                        @enderror
                        <a href="javascript:{}" class="btn btn-primary btn-user btn-block" onclick="document.getElementById('register-form').submit();">
                            Register Account
                        </a>
                    </form>
                    <hr>
                    <div class="text-center">
                        <!--<a class="small" href="forgot-password.html">Forgot Password?</a>-->
                    </div>
                    <div class="text-center">
                        <a class="small" href="{{url('login')}}">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection