@extends('layouts.dashboard')

@section('title', 'Hospital Patient')
@section('page-back', route('patient.home'))
@section('back-check', true)

@section('content')

<div class="row justify-content-start mx-0 my-3 mb-5">
  <div class="col-md-3 3y-2">
    <a href="{{route('patient.folders', ['id' => $patient->id])}}" class="btn btn-success py-2"><i class="fa fa-archive"></i>&emsp; View Folders</a>
  </div>
</div>
<div class="row">
    <div class="col-md-8 my-2">
        <div class="card p-0 w-100">
            <div class="card-header bg-success text-light">Patient Profile</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <img src="{{$patient->profile_pic ?? asset('img/placeholders/profile.png')}}" class="img img-fluid rounded">
                    </div>
                    <div class="col-9">
                        <div class="row mb-4">
                            <div class="col">
                                <span class="h5 text-secondary">National Card ID:</span>&emsp;
                                <span class="h5 text-success">{{$patient->national_card_id}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="text-secondary">Name:</span>&emsp;
                                <span class="text-success">{{$patient->lastname.' '.$patient->firstname. ' ' . ($patient->othernames ?? '')}}</span>
                            </div>
                            <div class="col-md-6">
                                <span class="text-secondary">Age:</span>&emsp;
                                <span class="text-success">{{$patient->age}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="text-secondary">Phone No.:</span>&emsp;
                                <span class="text-success">{{$patient->phone_number}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="text-secondary">Next of Kin:</span>&emsp;
                                <span class="text-success">{{$patient->next_of_kin}}</span>
                            </div>
                            <div class="col-md-6">
                                <span class="text-secondary">Phone No.:</span>&emsp;
                                <span class="text-success">{{$patient->nok_phone_number}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <div class="col-md-4 my-2">
      <div class="card p-0 w-100">
        <div class="card-header bg-success text-light">Patient Allergies & Phobia</div>
        <div class="card-body">
          <ul class="list-group text-success">
            @if ($patient->allergies->isNotEmpty())
                @foreach ($patient->allergies as $allergy)
                <li class="list-group-item py-1">{{$allergy->name}} <span class="text-secondary"> - {{$allergy->type}}</span></li>
                @endforeach
            @else
              <li class="list-group-item py-1 border-outline-secondary text-secondary">No Existing Allergies or Phobia.</li>
            @endif
          </ul>
        </div>  
      </div>
    </div>
  </div>
</div>
<div class="row my-4">
    <div class="col">
      <div class="card p-0">
        <div class="card-header bg-success">
          <div class="row justify-content-between px-2">
            <span class="text-light h5 mt-2"><i class="fa fa-folder-open"></i>&emsp; Patient Folder</span>
          </div>
        </div>
        <div class="card-body">
          @if ($folder)
            @if ($folder->files->isNotEmpty())
              <div class="col table-responsive">
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
                  <tbody>
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
            @else
                <div class="row justify-content-center">
                  <span class="text-secondary h5">No File In Folder. Please Create A New File.</span>
                </div>
            @endif
          @else
              <div class="row justify-content-center mt-4">
                <span class="text-secondary h5">Patient Has No Folder In Hospital.</span>
              </div>
              <div class="row justify-content-center mb-4">
                <a href="{{route('nurse.patient.new-folder', ['id' => $patient->id])}}" class="text-success">Please click to create new folder</a>
              </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection