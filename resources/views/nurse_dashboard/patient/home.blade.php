@extends('layouts.dashboard')

@section('title', 'Hospital Patient')
@section('page-back', route('nurse.home'))
@section('back-check', true)

@section('content')
@if (session()->has('error_message'))
    <div class="row justify-content-center">
        <div class="col-6 bg-danger px-4 py-2">
            <span class="text-light">{{session()->get('error_message')}}</span>
        </div>
    </div><br><br>
@endif
@if(isset($folder))
  <div class="row justify-content-between mx-0 my-3 mb-5">
    <div class="col-md-3">
      <a href="{{route('nurse.patient.folders', ['id' => $patient->id])}}" class="btn btn-success py-2"><i class="fa fa-folder-open"></i>&emsp; View Folders</a>
    </div>
    <div class="col-md-3">
      <a href="#" class="btn btn-danger py-2" data-toggle="modal" data-target="#folderLockModal">@if(!$folder->locked)<i class="fa fa-lock"></i>&emsp; Lock @else <i class="fa fa-unlock"></i>&emsp; Unlock @endif Folder</a>
    </div>
  </div>
@else
  <div class="row justify-content-start mx-0 my-3 mb-5">
    <div class="col-md-3">
      <a href="{{route('nurse.patient.folders', ['id' => $patient->id])}}" class="btn btn-success py-2"><i class="fa fa-folder-open"></i>&emsp; View Folders</a>
    </div>
  </div>
@endif
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
                          <div class="col-md-8">
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
      <div class="card-header bg-success text-light">
        <div class="row justify-content-between px-1">
          <span>Patient Allergies & Phobia</span>
          <button class="btn btn-light btn-sm text-success" data-toggle="modal" data-target="#allergyPhobiaModal"><i class="fa fa-plus"></i></button>
        </div>
      </div>
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
<div class="row my-4">
  <div class="col">
    <div class="card p-0">
      <div class="card-header bg-success">
        <div class="row justify-content-between px-2">
          <span class="text-light h5 mt-2"><i class="fa fa-folder-open"></i>&emsp; Patient Folder</span>
          @if ($folder)
            <a href="{{route('nurse.patient.file', ['id' => $folder->id])}}" class="btn btn-light text-success py-1 my-1"><i class="fa fa-plus"></i>&emsp; Create New File</a>
          @else
            <div></div>
          @endif
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
                    <tr class="cursor-pointer" onclick="window.location.href='{{route('nurse.patient.edit-file', ['id' => $file->id])}}'">
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
{{-- New Allergy and Phobia Modal --}}
<div class="modal fade" id="allergyPhobiaModal" tabindex="-1" role="dialog" aria-labelledby="allergyPhobiaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="row justify-content-center mt-5">
          <span class="form-header">Enter Allergy / Phobia Details</span>
        </div>
        <div class="row justify-content-center">
          <div class="col-9">
            <form method="POST" action="{{ route('nurse.patient.add-allergy') }}">
              @csrf
              <input type="hidden" name="patient_id" value="{{$patient->id}}">
              <div class="form-group row my-3">
                <div class="col">
                  <label for="type">Name: </label>
                  <input id="name" type="text" class="form-control" name="name" required placeholder="Enter Name">
                </div>
              </div>
              <div class="form-group row my-3">
                <div class="col">
                  <label for="type">Select Type: </label>
                  <select name="type" id="type" class="form-control">
                    <option>Allergy</option>
                    <option>Phobia</option>
                  </select>
                </div>
              </div>
              <div class="form-group row my-3">
                <div class="col">
                  <label for="type">Enter Description: </label>
                  <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter Description"></textarea>
                </div>
              </div>
              <div class="form-group my-4 row justify-content-center">
                <div class="col-md-8">
                  <button type="submit" class="btn btn-success w-100" style="border-radius: 25px;">
                    {{ __('Add Allergy / Phobia') }}
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

@isset($folder)
    {{-- Folder Lock Modal --}}
  <div class="modal fade" id="folderLockModal" tabindex="-1" role="dialog" aria-labelledby="folderLockModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="row justify-content-center mt-5">
            <span class="form-header">Enter PIN to @if(!$folder->locked) Lock @else Unlock @endif Folder for This Hospital</span>
          </div>
          <div class="row justify-content-center">
            <div class="col-9">
              <form method="POST" action="{{ route('nurse.patient.lock-folder') }}">
                @csrf
                <input type="hidden" name="patient_id" value="{{$patient->id}}">
                <div class="form-group row my-3">
                  <div class="col">
                    <label for="type">PIN: </label>
                    <input id="pin" type="text" class="form-control" name="pin" required placeholder="Eg. 1234" pattern="[0-9]{4}" title="Pin Must Be Numeric">
                  </div>
                </div>
                <div class="form-group my-4 row justify-content-center">
                  <div class="col-md-9">
                    <button type="submit" class="btn btn-danger w-100" style="border-radius: 25px;">
                      @if(!$folder->locked) Lock @else Unlock @endif Folder for this Hospital
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
@endisset

@endsection