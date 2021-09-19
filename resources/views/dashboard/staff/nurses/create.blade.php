@extends('layouts.dashboard')

@section('title', auth()->user()->hospital->name)
@section('page-back', route('staff.nurses.home'))
@section('back-check', true)

@section('content')
<div class="row justify-content-center my-5">
    <span class="h4 text-success">Add New Nurse To Hospital</span>
</div>
@if (session()->has('error_message'))
    <div class="row justify-content-center">
        <div class="col-6 bg-danger px-4 py-2">
            <span class="text-light">{{session()->get('error_message')}}</span>
        </div>
    </div><br><br>
@endif
<div class="row justify-content-center mb-5">
    <div class="col-md-10 px-2">
        <div class="card border-success py-5">
            <div class="body">
                <form action="{{route('staff.nurses.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row justify-content-center my-3">
                        <span class="h5 text-secondary">Please Enter Nurse's Details.</span>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <span class="text-secondary">Upload Profile Image</span>
                    </div>
                    <div class="row justify-content-center mb-5">
                        <div class="col-6 col-md-3">
                            <div id="uploadImageBlock" class="border border-success w-100 p-5 d-flex align-center justify-content-center rounded cursor-pointer" onclick="document.getElementById('profile_pic').click()">
                                <span class="text-success"><i class="fa fa-camera fa-2x"></i></span>
                            </div>
                            <img id="imagePreview" src="#" class="img img-fluid rounded" onclick="document.getElementById('profile_pic').click()" hidden>
                        </div>
                        <input type="file" name="profile_pic" id="profile_pic" onchange="loadImagePreview('imagePreview', this);" hidden>
                        @error('profile_pic')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="nursing_card_number" class="col col-form-label">{{ __('Nurse Card No. :') }}</label>

                            <div class="col">
                                <input id="nursing_card_number" type="text" class="form-control @error('nursing_card_number') is-invalid @enderror" name="nursing_card_number" value="{{ old('nursing_card_number') }}" required autocomplete="nursing_card_number" autofocus>

                                @error('nursing_card_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="firstname" class="col col-form-label">{{ __('Firstname :') }}</label>

                            <div class="col">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="lastname" class="col col-form-label">{{ __('Lastname :') }}</label>

                            <div class="col">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="othernames" class="col col-form-label">{{ __('Othernames :') }}</label>

                            <div class="col">
                                <input id="othernames" type="text" class="form-control @error('othernames') is-invalid @enderror" name="othernames" value="{{ old('othernames') }}" autocomplete="othernames" autofocus>

                                @error('othernames')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="age" class="col col-form-label">{{ __('Age :') }}</label>

                            <div class="col">
                                <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="col col-form-label">{{ __('Gender :') }}</label>

                            <div class="col">
                                <select name="gender" id="gender" class="form-control @error('institution_id') is-invalid @enderror" required>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="email" class="col col-form-label">{{ __('Email Address :') }}</label>

                            <div class="col">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number" class="col col-form-label">{{ __('Phone Number :') }}</label>

                            <div class="col">
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{old('phone_number')}}" required>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="region" class="col col-form-label">{{ __('Region :') }}</label>

                            <div class="col">
                                <select id="region" class="form-control @error('region') is-invalid @enderror" name="region" required>
                                    <option>AHAFO</option>
                                    <option>ASHANTI</option>
                                    <option>BONO EAST</option>
                                    <option>BRONG AHAFO</option>
                                    <option>CENTRAL</option>
                                    <option>EASTERN</option>
                                    <option>GREATER ACCRA</option>
                                    <option>NORTH EAST</option>
                                    <option>NORTHERN</option>
                                    <option>OTI</option>
                                    <option>SAVANNAH</option>
                                    <option>UPPER EAST</option>
                                    <option>UPPER WEST</option>
                                    <option>WESTERN</option>
                                    <option>WESTERN NORTH</option>
                                    <option>VOLTA</option>
                                </select>
                                
                                @error('region')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="district" class="col col-form-label">{{ __('District :') }}</label>

                            <div class="col">
                                <input id="district" type="text" class="form-control @error('district') is-invalid @enderror" name="district" value="{{old('district')}}" required>
                                
                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="town" class="col col-form-label">{{ __('City / Town :') }}</label>

                            <div class="col">
                                <input id="town" type="text" class="form-control @error('town') is-invalid @enderror" name="town" value="{{old('town')}}" required>
                                
                                @error('town')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="landmark" class="col col-form-label">{{ __('Nearest Landmark :') }}</label>

                            <div class="col">
                                <input id="landmark" type="text" class="form-control @error('landmark') is-invalid @enderror" name="landmark" value="{{old('landmark')}}" required>
                                
                                @error('landmark')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="residential_address" class="col col-form-label">{{ __('Residential Address :') }}</label>

                            <div class="col">
                                <input id="residential_address" type="text" class="form-control @error('residential_address') is-invalid @enderror" name="residential_address" value="{{old('residential_address')}}" required>
                                
                                @error('residential_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="password" class="col col-form-label">{{ __('OTP Password :') }}</label>

                            <div class="col">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="confirm_password" class="col col-form-label">{{ __('Confirm OTP Password :') }}</label>

                            <div class="col">
                                <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" onchange="checkPassword()" required>

                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row justify-content-center mt-5">
                        <div class="col-6">
                            <button id="submit" type="submit" class="btn btn-success w-100 disabled">Add Nurse</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection