@extends('layouts.dashboard')

@section('title', 'Patients Folders')
@section('page-back', (Auth::guard('nurse')->check()) ? route('nurse.patient.home',['national_card_id' => $patient->national_card_id]) : ((Auth::guard('doctor')->check()) ? route('doctor.patient.home')  : route('patient.home') ))
@section('back-check', true)

@section('content')
<div class="row">
  <div class="col">
    <span class="text-success h5">{{$patient->lastname.' '.$patient->firstname.'\'s'}} Folders</span>
  </div>
</div>
  @if (session()->has('success_message'))
    <br>
    <div class="row justify-content-center">
      <div class="col-6 bg-success px-4 py-2">
        <span class="text-light">{{session()->get('success_message')}}</span>
      </div>
    </div>
  @endif
  @if (session()->has('error_message'))
    <br>
    <div class="row justify-content-center">
      <div class="col-6 bg-danger px-4 py-2">
        <span class="text-light">{{session()->get('error_message')}}</span>
      </div>
    </div>
  @endif
  @if (isset($folders) && $folders->isNotEmpty())
    <div class="row p-2 my-3">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="bg-success text-light">
            <th scope="col">Hospital Name</th>
            <th scope="col"></th>
          </thead>
          <tbody class="my-2">
            @foreach ($folders as $folder)
              @if ($folder->locked)
                <tr class="cursor-pointer my-1">
                  <td>{{$folder->hospital->name}} @if($folder->locked) - <span class="text-danger">LOCKED</span> @endif</td>
                  <td class="py-0">
                    <div class="row justify-content-end mr-2 my-1">
                      <form id="form-{{$folder->id}}" action="{{(Auth::guard('nurse')->check()) ? route('nurse.patient.open-locked-folder', ['id' => $folder->id]) : ((Auth::guard('doctor')->check()) ? route('doctor.patient.open-locked-folder', ['id' => $folder->id]) :  route('patient.open-locked-folder', ['id' => $folder->id]) )}}" method="post">
                        @csrf
                        <div class="input-group">
                          <input type="text" class="form-control my-0" pattern="[0-9]{4}" placeholder="Eg. 1234" name="pin" title="Pin Must Be Numeric">
                          <button class="btn btn-outline-danger" type="submit" form="form-{{$folder->id}}"><i class="far fa-folder-open"></i></button>
                        </div>
                      </form>
                    </div>
                  </td>
                </tr> 
              @else
                <tr class="cursor-pointer my-1">
                  <td>{{$folder->hospital->name}}</td>
                  <td><a href="{{(Auth::guard('nurse')->check()) ? route('nurse.patient.folder', ['id' => $folder->id]) : ((Auth::guard('doctor')->check()) ? route('doctor.patient.folder', ['id' => $folder->id]) :  route('patient.folder', ['id' => $folder->id]) )}}" class="fa fa-folder-open"></a></td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @else
    <br><br><br>
    <div class="row justify-content-center h4 text-secondary mt-5">
      There are no Folders for This Patient.
    </div>
  @endif
@endsection