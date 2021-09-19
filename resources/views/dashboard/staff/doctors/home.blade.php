@extends('layouts.dashboard')

@section('title', auth()->user()->hospital->name)
@section('page-back', route('staff.home'))
@section('back-check', true)

@section('content')
    <div class="row justify-content-between">
        <span class="text-success h5"><strong>Manage Hospital Doctors</strong></span>
        <div class="col-4 col-md-2"><a href="{{route('staff.doctors.add')}}" class="btn btn-success w-100"><i class="fa fa-plus"></i>&emsp;Add Doctor</a></div>
    </div>
    @if ($doctors->isNotEmpty())
        <div class="row justify-content-around my-5">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover table-sm table-stripe">
                        <thead class="bg-success text-light">
                            <th></th>
                            <th>Name</th>
                            <th>Card ID</th>
                            <th>Age</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                        </thead>
                        <tbody>
                            @foreach ($doctors as $doctor)
                            <tr onclick="window.location.href= '{{route('staff.doctors.show',['id' => $doctor->id])}}'">
                                <td><span class="{{'text-'. ($doctor->on_duty ? 'success' : 'danger')}}" style="font-size: 16px;"><i class="fa fa-globe-africa"></i></span></td>
                                <td>{{$doctor->lastname.' '.$doctor->firstname.' '.($doctor->othernames ?? '')}}</td>
                                <td>{{$doctor->doctor_card_number}}</td>
                                <td>{{$doctor->age}}</td>
                                <td>{{$doctor->email}}</td>
                                <td>{{$doctor->phone_number}}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-around my-5">
            <div class="col-10 col-md-6">
                <span class="h5 text-secondary">No Doctors Registered for the Hospital.</span>
            </div>
        </div>
    @endif
@endsection