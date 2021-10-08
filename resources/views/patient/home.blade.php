@extends('layouts.dashboard')

@section('title', 'Hospitals Patients')
@section('page-back', route('home'))
@section('back-check', true)

@section('content')
  
  <div class="row justify-content-end mt-5">
    <div class="col-md-3">
      <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addDrugModal"><i class="fa fa-search"></i>&emsp;Search Patient</a>
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
  @if (isset($folders) && $folders->isNotEmpty())
    <div class="row p-2 my-3">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="bg-success text-light">
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Email</th>
            <th scope="col">Phone Number</th>
            <th scope="col">City</th>
            <th scope="col"></th>
          </thead>
          <tbody class="my-2">
            @foreach ($folders as $folder)
              <tr class="cursor-pointer my-1">
                <td>{{$folder->patient->lastname.' '.$folder->patient->firstname}}</td>
                <td>{{$folder->patient->age}}</td>
                <td>{{$folder->patient->email}}</td>
                <td>{{$folder->patient->phone_number}}</td>
                <td>{{$folder->patient->town}}</td>
                <td><a href="{{route('patient.access', ['national_card_id' => $folder->patient->national_card_id])}}" class="btn btn-success btn-sm"><i class="fa fa-folder-open"></i>&emsp; Open Folder</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @else
    <br><br><br>
    <div class="row justify-content-center h4 text-secondary mt-5">
      The Hospital is Currently without any Patient Folders.
    </div>
  @endif

  {{-- New Patient Modal --}}
  <div class="modal fade" id="addDrugModal" tabindex="-1" role="dialog" aria-labelledby="addDrugModalLabel" aria-hidden="true">
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