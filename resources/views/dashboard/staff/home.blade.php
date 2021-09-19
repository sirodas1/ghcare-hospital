@extends('layouts.dashboard')

@section('title', auth()->user()->hospital->name)
@section('page-back', route('home'))
@section('back-check', true)

@section('content')
    <div class="row">
        <span class="text-success h5"><strong>Manage Hospital Staff</strong></span>
    </div>
    <div class="row justify-content-around my-5">
        <div class="col-md-4">
            <div onclick="window.location.href = '{{route('staff.doctors.home')}}'" class="dashboard-options cursor-pointer w-full py-4 px-4">
                <div class="row justify-content-between mx-1">
                    <div class="icon d-flex justify-content-center">
                        <i class="fa fa-user-md"></i>
                    </div>
                    <div class="option-text h5 pt-2">
                        <strong>Doctors</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div onclick="window.location.href = '{{route('staff.pharmacists.home')}}'" class="dashboard-options cursor-pointer w-full py-4 px-4">
                <div class="row justify-content-between mx-1">
                    <div class="icon d-flex justify-content-center">
                        <i class="fa fa-tablets"></i>
                    </div>
                    <div class="option-text h5 pt-2">
                        <strong>Pharmacists</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div onclick="window.location.href = '{{route('staff.nurses.home')}}'" class="dashboard-options cursor-pointer w-full py-4 px-4">
                <div class="row justify-content-between mx-1">
                    <div class="icon d-flex justify-content-center">
                        <i class="fa fa-user-nurse"></i>
                    </div>
                    <div class="option-text h5 pt-2">
                        <strong>Nurses</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection