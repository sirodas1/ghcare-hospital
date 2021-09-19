@extends('layouts.logins')

@section('content')
<div class="col">
    <div class="row justify-content-center">
        <span class="form-header">USER LOGIN</span>
    </div>
    <br>
    @error('email')
        <div class="row justify-content-center">
            <div class="col-10 bg-danger px-4 py-2">
                <span class="text-light">{{ $message }}</span>
            </div>
        </div>
    @enderror
    <br>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group mb-5">
            <div class="col-md-12">
                <div class="row justify-content-center">
                    <label for="user_type" class="form-label text-secondary">Select User Type:</label>
                    <div class="col-8 pt-1 px-0">
                        <select name="user_type" id="user_type" class="form-control input-green">
                            <option>Root User</option>
                            <option>Doctor</option>
                            <option>Pharmacist</option>
                            <option>Nurse</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="row login-input" style="">
                    <div class="col-1 py-2 px-1">
                        <img src="/img/id-card@2x.png" class="img img-fluid form-icons" width="50px">
                    </div>
                    <div class="col-11 pt-1 px-0">
                        <input id="email" type="email" class="form-control input-green" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                    </div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="row login-input" style="">
                    <div class="col-1 py-2 pl-2 pr-0">
                        <img src="/img/padlock@2x.png" class="img img-fluid form-icons">
                    </div>
                    <div class="col-11 pt-1 px-0">
                        <input id="password" type="password" class="form-control input-green @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <br>
        <div class="form-group mb-0">
            <div class="col-md-8 offset-md-2">
                <button type="submit" class="btn btn-danger w-100" style="border-radius: 25px;">
                    {{ __('Login') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
