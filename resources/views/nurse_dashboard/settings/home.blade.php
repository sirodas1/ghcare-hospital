@extends('layouts.dashboard')

@section('title', auth()->user()->hospital->name)
@section('page-back', route('nurse.home'))
@section('back-check', true)

@section('content')
    @if (session()->has('success_message'))
    <br>
        <div class="row justify-content-center">
            <div class="col-6 bg-success px-4 py-2">
                <span class="text-light">{{session()->get('success_message')}}</span>
            </div>
        </div><br><br>
    @endif
    @if (session()->has('error_message'))
    <br>
        <div class="row justify-content-center">
            <div class="col-6 bg-danger px-4 py-2">
                <span class="text-light">{{session()->get('error_message')}}</span>
            </div>
        </div><br><br>
    @endif
    <div class="row justify-content-around my-3">
        <div class="col">
            <div class="card p-0">
                <div class="card-header bg-success">
                    <span class="text-light h5"><strong>My Account</strong></span>
                </div>
                <div class="card-body">
                    <form action="{{route('nurse.settings.update-nurse')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row justify-content-center mb-3">
                            <span class="text-secondary">Upload Profile Image</span>
                        </div>
                        <div class="row justify-content-center mb-5">
                            <div class="col-6 col-md-3">
                                @if (!isset($nurse->profile_pic))
                                    <div id="uploadImageBlock" class="border border-success w-100 p-5 d-flex align-center justify-content-center rounded cursor-pointer" onclick="document.getElementById('profile_pic').click()">
                                        <span class="text-success"><i class="fa fa-camera fa-2x"></i></span>
                                    </div>
                                    <img id="imagePreview" src="#" class="img img-fluid rounded" onclick="document.getElementById('profile_pic').click()" hidden>
                                @else
                                    <img id="imagePreview" src="{{$nurse->profile_pic}}" class="img img-fluid rounded" onclick="document.getElementById('profile_pic').click()">
                                @endif
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
                                    <input id="nursing_card_number" type="text" class="form-control @error('nursing_card_number') is-invalid @enderror" name="nursing_card_number" value="{{ $nurse->nursing_card_number }}" required autocomplete="nursing_card_number" autofocus>
    
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
                                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $nurse->firstname }}" required autocomplete="firstname" autofocus>

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
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $nurse->lastname }}" required autocomplete="lastname" autofocus>

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
                                    <input id="othernames" type="text" class="form-control @error('othernames') is-invalid @enderror" name="othernames" value="{{ $nurse->othernames }}" autocomplete="othernames" autofocus>

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
                                    <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ $nurse->age }}" required autocomplete="age" autofocus>
    
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
                                        <option @if($nurse->gender == 'Male') selected @endif>Male</option>
                                        <option @if($nurse->gender == 'Female') selected @endif>Female</option>
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
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $nurse->email }}" required autocomplete="email" autofocus>
    
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
                                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{$nurse->phone_number}}" required>
                                    @error('phone_number')
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
                                        <option @if($nurse->region == 'AHAfo') selected @endif>AHAFO</option>
                                        <option @if($nurse->region == 'ASHANTI') selected @endif>ASHANTI</option>
                                        <option @if($nurse->region == 'BONO EAST') selected @endif>BONO EAST</option>
                                        <option @if($nurse->region == 'BRONG AHAFO') selected @endif>BRONG AHAFO</option>
                                        <option @if($nurse->region == 'CENTRAL') selected @endif>CENTRAL</option>
                                        <option @if($nurse->region == 'EASTERN') selected @endif>EASTERN</option>
                                        <option @if($nurse->region == 'GREATER ACCRA') selected @endif>GREATER ACCRA</option>
                                        <option @if($nurse->region == 'NORTH EAST') selected @endif>NORTH EAST</option>
                                        <option @if($nurse->region == 'NORTHERN') selected @endif>NORTHERN</option>
                                        <option @if($nurse->region == 'OTI') selected @endif>OTI</option>
                                        <option @if($nurse->region == 'SAVANNAH') selected @endif>SAVANNAH</option>
                                        <option @if($nurse->region == 'UPPER EAST') selected @endif>UPPER EAST</option>
                                        <option @if($nurse->region == 'UPPER WEST') selected @endif>UPPER WEST</option>
                                        <option @if($nurse->region == 'WESTERN') selected @endif>WESTERN</option>
                                        <option @if($nurse->region == 'WESTERN NORTH') selected @endif>WESTERN NORTH</option>
                                        <option @if($nurse->region == 'VOLTA') selected @endif>VOLTA</option>
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
                                    <input id="district" type="text" class="form-control @error('district') is-invalid @enderror" name="district" value="{{$nurse->district}}" required>
                                    
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
                                    <input id="town" type="text" class="form-control @error('town') is-invalid @enderror" name="town" value="{{$nurse->town}}" required>
                                    
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
                                    <input id="landmark" type="text" class="form-control @error('landmark') is-invalid @enderror" name="landmark" value="{{$nurse->landmark}}" required>
                                    
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
                                    <input id="residential_address" type="text" class="form-control @error('residential_address') is-invalid @enderror" name="residential_address" value="{{$nurse->residential_address}}" required>
                                    
                                    @error('residential_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center my-5">
                            <button type="reset" class="btn btn-outline-secondary py-2 w-25 mx-2">Reset</button>
                            <button type="submit" class="btn btn-success py-2 w-50 mx-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection