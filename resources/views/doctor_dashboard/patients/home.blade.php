@extends('layouts.dashboard')

@section('title', auth()->user()->hospital->name)
@section('page-back', route('doctor.home'))
@section('back-check', true)

@section('content')
<br>
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
@endsection