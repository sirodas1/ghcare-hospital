@extends('layouts.dashboard')

@section('title', auth()->user()->hospital->name)
@section('page-back', route('doctor.home'))
@section('back-check', true)

@section('content')
<div class="row justify-content-end mt-5">
  <div class="col-md-3">
    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#checkPatientModal"><i class="fa fa-plus"></i>&emsp;New Patient</a>
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
<div class="row my-4">
  <div class="col">
    @if ($files && $files->isNotEmpty())
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="bg-success text-light">
            <th scope="col" nowrap="nowrap">Patient Name</th>
            <th scope="col" nowrap="nowrap">Symptoms</th>
            <th scope="col" nowrap="nowrap">Body Temperature (°C)</th>
            <th scope="col" nowrap="nowrap">Heart Rate (BPM)</th>
            <th scope="col" nowrap="nowrap">Nurse's Prognosis</th>
            <th scope="col" nowrap="nowrap">Doctor's Diagnosis</th>
            <th scope="col" nowrap="nowrap">Health Status</th>
            <th scope="col" nowrap="nowrap">Contagious</th>
          </thead>
          <tbody>
            @foreach ($files as $file)
              <tr class="cursor-pointer" onclick="window.location.href='{{route('doctor.patient.get-file',['id' => $file->id])}}'">
                <td>{{$file->folder->patient->lastname.' '.$file->folder->patient->firstname}}</td>
                <td>{{$file->symptoms}}</td>
                <td>{{$file->temperature}}</td>
                <td>{{$file->bpm}}</td>
                <td>{{$file->prognosis}}</td>
                <td>{{$file->diagnosis}}</td>
                <td>{{$file->health_status}}</td>
                <td>{{$file->contagious ? 'Yes' : 'No'}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="row justify-content-center">
        <span class="text-secondary h5">No Patient Has Been Assigned To Doctor</span>
      </div>
    @endif
  </div>
</div>

{{-- New Patient Modal --}}
<div class="modal fade" id="checkPatientModal" tabindex="-1" role="dialog" aria-labelledby="checkPatientModalLabel" aria-hidden="true">
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
            <form method="GET" action="{{ route('patient.access') }}">
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