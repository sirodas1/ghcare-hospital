@extends('layouts.dashboard')

@section('title', 'Patients Folders')
@section('page-back', route('patient.home'))
@section('back-check', true)

@section('content')
<div class="row">
  <div class="col">
    <span class="text-success">{{$patient->lastname.' '.$patient->firstname.'\'s'}} Folders</span>
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
              <tr class="cursor-pointer my-1">
                <td>{{$folder->hospital->name}}</td>
                <td><a href="#" class="fa fa-folder-open"></a></td>
              </tr>
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