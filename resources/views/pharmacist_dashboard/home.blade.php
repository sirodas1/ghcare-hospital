@extends('layouts.dashboard')

@section('title', auth()->user()->hospital->name)

@section('content')
  <div class="row">
    <span class="text-success h5"><strong>Welcome to GhCare</strong></span>
  </div>
  <div class="row">
    <span class="text-secondary">A Health Interoperability For National Development</span>
  </div>
  <div class="row justify-content-start my-5">
    <div class="col-md-4">
      <div onclick="window.location.href = '{{route('pharmacist.medication.home')}}'" class="dashboard-options cursor-pointer w-full py-4 px-4">
        <div class="row justify-content-between mx-1">
          <div class="icon d-flex justify-content-center">
            <i class="fa fa-tablets"></i>
          </div>
          <div class="option-text h5 pt-2">
            <strong>Medication</strong>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div onclick="window.location.href = '{{route('pharmacist.inventory.home')}}'" class="dashboard-options cursor-pointer w-full py-4 px-4">
        <div class="row justify-content-between mx-1">
          <div class="icon d-flex justify-content-center">
            <i class="fa fa-archive"></i>
          </div>
          <div class="option-text h5 pt-2">
            <strong>Inventory</strong>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div onclick="window.location.href = '{{route('pharmacist.settings.home')}}'" class="dashboard-options cursor-pointer w-full py-4 px-4">
        <div class="row justify-content-between mx-1">
          <div class="icon d-flex justify-content-center">
            <i class="fa fa-sliders-h"></i>
          </div>
          <div class="option-text h5 pt-2">
            <strong>Settings</strong>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection