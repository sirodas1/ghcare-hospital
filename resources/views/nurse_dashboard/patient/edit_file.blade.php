@extends('layouts.dashboard')

@section('title', auth()->user()->hospital->name)
@section('page-back', route('nurse.patient.home',['national_card_id' => $file->folder->patient->national_card_id]))
@section('back-check', true)

@section('content')
<div class="row justify-content-center my-5">
    <span class="h4 text-success">Edit File</span>
</div>
@if (session()->has('error_message'))
    <div class="row justify-content-center">
        <div class="col-6 bg-danger px-4 py-2">
            <span class="text-light">{{session()->get('error_message')}}</span>
        </div>
    </div><br><br>
@endif
<div class="row justify-content-center mb-5">
    <div class="col-md-10 px-2">
        <div class="card border-success py-5">
            <div class="body">
                <form action="{{route('nurse.patient.update-file',['id' => $file->id])}}" method="POST">
                    @csrf
                    @method('PUT')  
                    <input type="hidden" name="folder_id" value="{{$file->folder->id}}">
                    <input type="hidden" name="nurse_id" value="{{auth()->user()->id}}">
                    
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
                          <label for="prognosis" class="col col-form-label">Nurse's Prognosis :</label>

                          <div class="col">
                              <input id="prognosis" type="text" class="form-control @error('prognosis') is-invalid @enderror" name="prognosis" value="{{ $file->prognosis }}" required>

                              @error('prognosis')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
                      <div class="col-md-6">
                        <label for="othernames" class="col col-form-label">{{ __('Available Doctors :') }}</label>

                        <div class="col">
                          <select name="doctor_id" id="doctor_id" class="form-control">
                            <option selected value="{{$file->doctor_id}}">{{$file->doctor->lastname.' '.$file->doctor->firstname}}</option>
                            @foreach ($doctors as $doctor)
                              @if ($file->doctor_id != $doctor->id)
                              <option value="{{$doctor->id}}">{{$doctor->lastname.' '.$doctor->firstname}}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    
                    <div class="form-row justify-content-center mt-5">
                      <div class="col-3">
                        <button type="reset" class="btn btn-outline-secondary w-100">Reset</button>
                      </div>
                      <div class="col-6">
                        <button type="submit" class="btn btn-success w-100 ">Update File</button>
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection