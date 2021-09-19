@extends('layouts.dashboard')

@section('title', auth()->user()->hospital->name)

@section('content')
    <div class="row">
        <span class="text-success h5"><strong>Welcome to GhCare</strong></span>
    </div>
    <div class="row">
        <span class="text-secondary">A Health Interoperability For National Development</span>
    </div>
    <div class="row justify-content-around my-5">
        <div class="col-md-4">
            <div onclick="window.location.href = '{{route('staff.home')}}'" class="dashboard-options cursor-pointer w-full py-4 px-4">
                <div class="row justify-content-between mx-1">
                    <div class="icon d-flex justify-content-center">
                        <i class="fa fa-user-tie"></i>
                    </div>
                    <div class="option-text h5 pt-2">
                        <strong>Staff</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div onclick="window.location.href = '{{route('home')}}'" class="dashboard-options cursor-pointer w-full py-4 px-4">
                <div class="row justify-content-between mx-1">
                    <div class="icon d-flex justify-content-center">
                        <i class="fa fa-tablets"></i>
                    </div>
                    <div class="option-text h5 pt-2">
                        <strong>Medical Inventory</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div onclick="window.location.href = '{{route('home')}}'" class="dashboard-options cursor-pointer w-full py-4 px-4">
                <div class="row justify-content-between mx-1">
                    <div class="icon d-flex justify-content-center">
                        <i class="fa fa-user-injured"></i>
                    </div>
                    <div class="option-text h5 pt-2">
                        <strong>Patients</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection