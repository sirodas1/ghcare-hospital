@extends('layouts.dashboard')

@section('title', 'Hospital Patient')
@section('page-back', route('doctor.patient.home'))
@section('back-check', true)

@section('content')

<div class="row justify-content-start mx-0 my-3 mb-5">
  <div class="col-md-3 3y-2">
    <a href="{{route('doctor.patient.folders', ['id' => $patient->id])}}" class="btn btn-success py-2"><i class="fa fa-folder-open"></i>&emsp; View Folders</a>
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
        <div class="row justify-content-start px-2">
          <span class="text-light h5 mt-2"><i class="fa fa-folder-open"></i>&emsp; Patient File</span>
        </div>
      </div>
      <div class="card-body">
        <form id="updateFileForm" action="{{route('doctor.patient.update-file',['id' => $file->id])}}" method="POST">
          @csrf
          @method('PUT')  
          
          <div class="form-row justify-content-center my-3">
              <span class="h5 text-secondary">Please Update File Details.</span>
          </div>
        
          <div class="form-group row">
            <div class="col-md-6">
              <label for="temperature" class="col col-form-label">{{ __('Body Temperature (°C) :') }}</label>
              <div class="col">
                <input id="temperature" type="number" step="0.01" class="form-control @error('temperature') is-invalid @enderror" name="temperature" value="{{ $file->temperature }}" required>

                @error('temperature')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <label for="bpm" class="col col-form-label">{{ __('Heart Rate (BPM) :') }}</label>
              <div class="col">
                <input id="bpm" type="number" step="0.01" class="form-control @error('bpm') is-invalid @enderror" name="bpm" value="{{ $file->bpm }}" required>

                @error('bpm')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <label for="weight" class="col col-form-label">{{ __('Patient Weight (Kg) :') }}</label>
              <div class="col">
                <input id="weight" type="number" step="0.1" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ $file->weight }}" required>

                @error('weight')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <label for="height" class="col col-form-label">{{ __('Patient height (Feet) :') }}</label>
              <div class="col">
                <input id="height" type="number" step="0.01" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ $file->height }}" required>

                @error('height')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-10">
              <label for="symptoms" class="col col-form-label">{{ __('Patient Symptoms :') }}</label>
              <div class="col">
                <textarea id="symptoms" class="form-control" name="symptoms" cols="30" rows="5" required>{{ $file->symptoms }}</textarea>
              </div>
            </div>
          </div>
          <div class="form-group row mt-3">
            <div class="col-md-6">
              <label class="col col-form-label">Nurse's Prognosis : <span class="text-success h5">{{ $file->prognosis }}</span></label>
            </div>
            <div class="col-md-6">
              <label for="diagnosis" class="col col-form-label">Doctor's Diagnosis :</label>

              <div class="col">
                <input id="diagnosis" type="text" class="form-control @error('diagnosis') is-invalid @enderror" name="diagnosis" value="{{ $file->diagnosis ?? '' }}" required>

                @error('diagnosis')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group row mt-3">
            <div class="col-md-6">
              <label for="health_status" class="col col-form-label">Health Status :</label>

              <div class="col">
                <select name="health_status" id="health_status" class="form-control" required>
                  <option @if($file->health_status == 'UnIdentified') selected @endif>UnIdentified</option>
                  <option @if($file->health_status == 'Diagnosed') selected @endif>Diagnosed</option>
                  <option @if($file->health_status == 'Under-Treatment') selected @endif>Under-Treatment</option>
                  <option @if($file->health_status == 'Cured') selected @endif>Cured</option>
                </select>

                @error('health_status')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <label for="contagious" class="col col-form-label">Is Disease Contagious? :</label>

              <div class="col">
                <select name="contagious" id="contagious" class="form-control" required>
                  <option @if($file->contagious) selected @endif value="1">Yes</option>
                  <option @if(!$file->contagious) selected @endif  value="0">No</option>
                </select>

                @error('contagious')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group row mb-3">
            <div class="col-md-4">
              <label for="time_of_cured" class="col col-form-label">Date & Time of Completed Treatment :</label>
              <div class="col">
                <input id="time_of_cured" type="date"  class="form-control @error('time_of_cured') is-invalid @enderror" name="time_of_cured">

                @error('time_of_cured')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>
          
          <div class="form-row justify-content-center mt-5">
            <div class="col-3">
              <button type="reset" class="btn btn-outline-secondary w-100">Reset</button>
            </div>
            <div class="col-6">
              <button form="updateFileForm" type="submit" class="btn btn-success w-100 ">Update File</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row my-4">
  <div class="col">
    <div class="card p-0">
      <div class="card-header bg-success text-light">
        <div class="row justify-content-between px-2">
          <span>Patient Medication</span>
          <button class="btn btn-light text-success btn-sm" data-toggle="modal" data-target="#medicationModal"><i class="fa fa-plus"></i></button>
        </div>
      </div>
      <div class="card-body">
        @if ($file->medications->isNotEmpty())
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="bg-success text-light">
                  <th></th>
                  <th scope="col">Drug Name</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Dosage</th>
                  <th scope="col">Issued</th>
                  <th scope="col">Time to Start Consumption</th>
                </thead>
                <tbody>
                  @foreach ($file->medications as $medication)
                      <tr>
                        <td class="col-1"><img src="{{$medication->drug->image}}" alt="No Image Available" class="img img-fluid"></td>
                        <td>{{$medication->drug->name}}</td>
                        <td>{{$medication->quantity}}</td>
                        <td>{{$medication->dosage}}</td>
                        <td>{{$medication->completed ? 'Yes' : 'No'}}</td>
                        <td>{{$medication->start_date}}</td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        @else
          <div class="row justify-content-center">
            <span class="h5 text-secondary">No Medication has been Prescribed.</span>
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
            <form id="allergyForm" method="POST" action="{{ route('doctor.patient.add-allergy') }}">
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
                  <button form="allergyForm" type="submit" class="btn btn-success w-100" style="border-radius: 25px;">
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

{{-- New Medication Modal --}}
<div class="modal fade" id="medicationModal" tabindex="-1" role="dialog" aria-labelledby="medicationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="row justify-content-center mt-5">
          <span class="form-header">Enter Prescription Details</span>
        </div>
        <div class="row justify-content-center">
          <div class="col-9">
            <form id="medication" method="POST" action="{{ route('doctor.patient.prescribe') }}">
              @csrf
              <input type="hidden" name="file_id" value="{{$file->id}}">
              <input type="hidden" name="doctor_id" value="{{auth()->id()}}">

              <div class="form-group row my-3">
                <div class="col">
                  <label for="drug_id">Select Drug: </label>
                  <select name="drug_id" id="drug_id" class="form-control">
                    <option selected disabled></option>
                    @foreach ($drugs as $drug)
                        <option value="{{$drug->id}}">{{$drug->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row my-3">
                <div class="col">
                  <label for="dosage">Select Dosage: </label>
                  <select name="dosage" id="dosage" class="form-control">
                    <option>Once a Day</option>
                    <option>2 Times Daily</option>
                    <option>3 Times Daily</option>
                  </select>
                </div>
              </div>
              <div class="form-group row my-3">
                <div class="col">
                  <label for="quantity">Enter Quantity: </label>
                  <input type="number" step="1" min="1" name="quantity" id="quantity" class="form-control" />
                </div>
              </div>
              <div class="form-group my-4 row justify-content-center">
                <div class="col-md-8">
                  <button form="medication" type="submit" class="btn btn-success w-100" style="border-radius: 25px;">
                    {{ __('Prescribe') }}
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