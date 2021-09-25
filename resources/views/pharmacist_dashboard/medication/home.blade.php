@extends('layouts.dashboard')

@section('title', auth()->user()->hospital->name)
@section('page-back', route('pharmacist.home'))
@section('back-check', true)

@section('content')
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

<div class="row justify-content-center my-4">
  @if ($medications->isNotEmpty())
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="bg-success text-light">
            <th scope="col">Drug Name</th>
            <th scope="col">Dosage</th>
            <th scope="col">Quantity</th>
            <th scope="col"></th>
          </thead>
          <tbody>
            @foreach ($medications as $medication)
                <tr>
                  <td>{{$medication->drug->name}}</td>
                  <td>{{$medication->dosage}}</td>
                  <td>{{$medication->quantity}}</td>
                  <td><a href="{{route('pharmacist.medication.issue', ['id' => $medication->id])}}" class="btn btn-outline-success btn-small">Issue</a></td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  @else
    <span class="text-secondary h5">No Available Medications To Be Issued to Patients</span>    
  @endif
</div>
@endsection