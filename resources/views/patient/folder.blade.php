@extends('layouts.dashboard')

@section('title', 'Patients Folders')
@section('page-back', (Auth::guard('nurse')->check()) ? route('nurse.patient.folders',['id' => $folder->patient->id]) : ((Auth::guard('doctor')->check()) ? route('doctor.patient.folders',['id' => $folder->patient->id]) : route('patient.folders',['id' => $folder->patient->id]) ))
@section('back-check', true)

@section('content')
<div class="row">
  <div class="col">
    <span class="text-success h5">{{$folder->hospital->name}} Folder</span>
  </div>
</div>
  @if (session()->has('search_message'))
    <br>
    <div class="row justify-content-center">
      <div class="col-6 bg-danger px-4 py-2">
        <span class="text-light">{{session()->get('success_message')}}</span>
      </div>
    </div><br><br>
  @endif
  @if (session()->has('success_message'))
    <br>
    <div class="row justify-content-center">
      <div class="col-6 bg-success px-4 py-2">
        <span class="text-light">{{session()->get('success_message')}}</span>
      </div>
    </div><br><br>
  @endif
  @if (isset($folder) && $folder->files->isNotEmpty())
    <div class="row p-2 my-3">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="bg-success text-light">
            <th scope="col" nowrap="nowrap">Assigned Doctor</th>
            <th scope="col" nowrap="nowrap">Symptoms</th>
            <th scope="col" nowrap="nowrap">Body Temperature (°C)</th>
            <th scope="col" nowrap="nowrap">Heart Rate (BPM)</th>
            <th scope="col" nowrap="nowrap">Nurse's Prognosis</th>
            <th scope="col" nowrap="nowrap">Doctor's Diagnosis</th>
            <th scope="col" nowrap="nowrap">Health Status</th>
            <th scope="col" nowrap="nowrap">Contagious</th>
          </thead>
          <tbody class="my-2">
            @foreach ($folder->files as $file)
              <tr class="cursor-pointer">
                <td>{{$file->doctor->lastname.' '.$file->doctor->firstname}}</td>
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
    </div>
  @else
    <br><br><br>
    <div class="row justify-content-center h4 text-secondary mt-5">
      There are no Files in This Folder.
    </div>
  @endif
@endsection