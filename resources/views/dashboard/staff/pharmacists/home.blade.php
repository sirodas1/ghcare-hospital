@extends('layouts.dashboard')

@section('title', auth()->user()->hospital->name)
@section('page-back', route('staff.home'))
@section('back-check', true)

@section('content')
    <div class="row justify-content-between">
        <span class="text-success h5"><strong>Manage Hospital Pharmacists</strong></span>
        <div class="col-5 col-md-3"><a href="{{route('staff.pharmacists.add')}}" class="btn btn-success w-100"><i class="fa fa-plus"></i>&emsp;Add Pharmacist</a></div>
    </div>
    @if ($pharmacists->isNotEmpty())
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
                            @foreach ($pharmacists as $pharmacist)
                            <tr onclick="window.location.href= '{{route('staff.pharmacists.show',['id' => $pharmacist->id])}}'">
                                <td><span class="{{'text-'. ($pharmacist->on_duty ? 'success' : 'danger')}}" style="font-size: 16px;"><i class="fa fa-globe-africa"></i></span></td>
                                <td>{{$pharmacist->lastname.' '.$pharmacist->firstname.' '.($pharmacist->othernames ?? '')}}</td>
                                <td>{{$pharmacist->pharmacist_card_number}}</td>
                                <td>{{$pharmacist->age}}</td>
                                <td>{{$pharmacist->email}}</td>
                                <td>{{$pharmacist->phone_number}}</td>
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
                <span class="h5 text-secondary">No Pharmacists Registered for the Hospital.</span>
            </div>
        </div>
    @endif
@endsection