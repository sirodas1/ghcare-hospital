@extends('layouts.dashboard')

@section('title', 'Hospital Details ')
@section('page-back', route('home'))
@section('back-check', true)

@section('content')
    <div class="row justify-content-start mt-5">
        <div class="col-md-3">
            <span class="h4 text-success"><strong>{{$hospital->name}}</strong></span>
        </div>
    </div>
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
        <div class="col-md-8">
            <div class="card p-0">
                <div class="card-header bg-success">
                    <span class="text-light">Hospital</span>
                </div>
                <div class="card-body">
                    <form id="updateHospital" action="{{route('settings.update-hospital')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="hospital_id" value="{{$hospital->id}}">
                        <div class="row justify-content-center">
                            <div class="col-6 col-md-3">
                                <span class="text-center text-secondary mb-2">Hospital Logo Image:</span>
                                <img id="imagePreview" src="{{$hospital->logo}}" class="img img-fluid rounded" onclick="document.getElementById('logo').click()">
                            </div>
                            <input type="file" name="logo" id="logo" onchange="loadImagePreview('imagePreview', this);" hidden>
                        </div>
                        <div class="row justify-content-between my-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Hospital Name:</label>
                                    <div class="col p-0 pr-2">
                                        <input type="text" name="name" id="name" class="form-control" value="{{$hospital->name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-Mail Address:</label>
                                    <div class="col p-0 pr-2">
                                        <input type="email" name="email" id="email" class="form-control" value="{{$hospital->email}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="region">Region:</label>
                                    <div class="col p-0 pr-2">
                                        <select id="region" class="form-control @error('region') is-invalid @enderror" name="region" required>
                                            <option @if($hospital->region == 'AHAfo') selected @endif>AHAFO</option>
                                            <option @if($hospital->region == 'ASHANTI') selected @endif>ASHANTI</option>
                                            <option @if($hospital->region == 'BONO EAST') selected @endif>BONO EAST</option>
                                            <option @if($hospital->region == 'BRONG AHAFO') selected @endif>BRONG AHAFO</option>
                                            <option @if($hospital->region == 'CENTRAL') selected @endif>CENTRAL</option>
                                            <option @if($hospital->region == 'EASTERN') selected @endif>EASTERN</option>
                                            <option @if($hospital->region == 'GREATER ACCRA') selected @endif>GREATER ACCRA</option>
                                            <option @if($hospital->region == 'NORTH EAST') selected @endif>NORTH EAST</option>
                                            <option @if($hospital->region == 'NORTHERN') selected @endif>NORTHERN</option>
                                            <option @if($hospital->region == 'OTI') selected @endif>OTI</option>
                                            <option @if($hospital->region == 'SAVANNAH') selected @endif>SAVANNAH</option>
                                            <option @if($hospital->region == 'UPPER EAST') selected @endif>UPPER EAST</option>
                                            <option @if($hospital->region == 'UPPER WEST') selected @endif>UPPER WEST</option>
                                            <option @if($hospital->region == 'WESTERN') selected @endif>WESTERN</option>
                                            <option @if($hospital->region == 'WESTERN NORTH') selected @endif>WESTERN NORTH</option>
                                            <option @if($hospital->region == 'VOLTA') selected @endif>VOLTA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="town">City / Town:</label>
                                    <div class="col p-0 pr-2">
                                        <input type="text" name="town" id="town" class="form-control" value="{{$hospital->town}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type_of_institution">Type of Institution:</label>
                                    <div class="col p-0 pr-2">
                                        <select id="type_of_institution" class="form-control @error('type_of_institution') is-invalid @enderror" name="type_of_institution" required>
                                            <option @if($hospital->type_of_institution == 'Hospital') selected @endif>Hospital</option>
                                            <option @if($hospital->type_of_institution == 'Clinic') selected @endif>Clinic</option>
                                            <option @if($hospital->type_of_institution == 'Heath Center') selected @endif>Heath Center</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="institution_id">Institution ID:</label>
                                    <div class="col p-0 pr-2">
                                        <input type="text" name="institution_id" id="institution_id" class="form-control" value="{{$hospital->institution_id}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone Number:</label>
                                    <div class="col p-0 pr-2">
                                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{$hospital->phone_number}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="district">District:</label>
                                    <div class="col p-0 pr-2">
                                        <input type="text" name="district" id="district" class="form-control" value="{{$hospital->district}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ghana_post_gps">GhanaPost-GPS A ddress:</label>
                                    <div class="col p-0 pr-2">
                                        <input type="text" name="ghana_post_gps" id="ghana_post_gps" class="form-control" value="{{$hospital->ghana_post_gps}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center my-3">
                            <button form="updateHospital" type="reset" class="btn btn-outline-secondary py-2 w-25 mx-2">Reset</button>
                            <button form="updateHospital" type="submit" class="btn btn-success py-2 w-50 mx-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-0">
                <div class="card-header bg-success">
                    <span class="text-light">My Account</span>
                </div>
                <div class="card-body">
                    <form id="updateRootUser" action="{{route('settings.update-root-user')}}" method="post">
                        @csrf
                        @method('PUT')
                        
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <span class="text-center text-secondary mb-2">Profile Image:</span>
                                <img id="imagePreview" src="{{$hospital->root_user->profile_pic}}" class="img img-fluid rounded" onclick="document.getElementById('profile_pic').click()">
                            </div>
                            <input type="file" name="profile_pic" id="profile_pic" onchange="loadImagePreview('imagePreview', this);" hidden>
                        </div>
                        <div class="row justify-content-between my-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Fullname:</label>
                                    <div class="col p-0 pr-2">
                                        <input type="text" name="fullname" id="fullname" class="form-control" value="{{$hospital->root_user->fullname}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-Mail Address:</label>
                                    <div class="col p-0 pr-2">
                                        <input type="email" name="email" id="email" class="form-control" value="{{$hospital->root_user->email}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="region">Phone Number:</label>
                                    <div class="col p-0 pr-2">
                                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{$hospital->root_user->phone_number}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center my-3">
                            <button form="updateRootUser" type="reset" class="btn btn-outline-secondary py-2 w-25 mx-2">Reset</button>
                            <button form="updateRootUser" type="submit" class="btn btn-success py-2 w-50 mx-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-5">
        <div class="col">
            <div class="card p-0">
                <div class="card-header bg-success">
                    <span class="text-light">Hospital Staff Count</span>
                </div>
                <div class="card-body">
                    <div class="row justify-content-around">
                        <div class="col-md-3 rounded border border-success px-2 py-4 align-center">
                            <div class="row justify-content-center mb-2"><span>Number of Doctors:</span></div>
                            <div class="row justify-content-center">
                                <div id="stats_count" class="rounded-circle d-flex align-items-center justify-content-center" style="border: 6px solid #0aca3a; height: 80px; width: 80px;">
                                    {{$hospital->doctors->count()}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 rounded border border-success px-2 py-4 align-center">
                            <div class="row justify-content-center mb-2"><span>Number of Pharmacists:</span></div>
                            <div class="row justify-content-center">
                                <div id="stats_count" class="rounded-circle d-flex align-items-center justify-content-center" style="border: 6px solid #0aca3a; height: 80px; width: 80px;">
                                    {{$hospital->pharmacists->count()}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 rounded border border-success px-2 py-4 align-center">
                            <div class="row justify-content-center mb-2"><span>Number of Nurses:</span></div>
                            <div class="row justify-content-center">
                                <div id="stats_count" class="rounded-circle d-flex align-items-center justify-content-center" style="border: 6px solid #0aca3a; height: 80px; width: 80px;">
                                    {{$hospital->nurses->count()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection