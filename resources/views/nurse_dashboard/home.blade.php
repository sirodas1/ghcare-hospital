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
            <div class="dashboard-options cursor-pointer w-full py-4 px-4" data-toggle="modal" data-target="#searchPatientCardModal">
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
        <div class="col-md-4">
            <div onclick="window.location.href = '{{route('settings.home')}}'" class="dashboard-options cursor-pointer w-full py-4 px-4">
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

{{-- New Patient Modal --}}
  <div class="modal fade" id="searchPatientCardModal" tabindex="-1" role="dialog" aria-labelledby="searchPatientCardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="row justify-content-center mt-5">
            <span class="form-header">Enter Patient's ID</span>
          </div>
          <div class="row justify-content-center">
            <div class="col-9">
              <form method="GET" action="{{ route('nurse.patient.home') }}">
                @csrf
          
                <div class="form-group my-4">
                  <div class="col">
                    <div class="row login-input" style="">
                      <div class="col-1 py-2 px-1">
                        <img src="/img/id-card@2x.png" class="img img-fluid form-icons" width="50px">
                      </div>
                      <div class="col-11 pt-1 px-0">
                        <input id="national_card_id" type="text" class="form-control input-green" name="national_card_id" required placeholder="Enter Ghana National Card ID">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group mb-5 row justify-content-center">
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-danger w-100" style="border-radius: 25px;">
                      {{ __('Check') }}
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection