@php
    $back_check = View::hasSection('back-check');

    if(Auth::guard('doctor')->check()){
        $guard = "Doctor Portal";
    }else if(Auth::guard('pharmacist')->check()){
        $guard = "Pharmacist Portal";
    }else if(Auth::guard('nurse')->check()){
        $guard = "Nurse Portal";
    }else{
        $guard = "Root User Portal";
    }
@endphp

<nav id="topbar" class="my-4">
    <div class="row justify-content-between px-2">
        <div class="px-0">
            @if ($back_check)
                <a href="@yield('page-back')"><span class="h5 text-success"><i class="fa fa-chevron-left"></i></span></a>&emsp;
            @endif
            <span class="h5 text-success"><strong>@yield('title') - </strong></span>
            <span class="text-secondary">{{$guard}}</span>
        </div>
        <div class="col-md-5">
            <div class="row justify-content-end">
                <div class="mr-3">
                    <a href="#" class="btn btn-light bg-white btn-lg py-1 px-2" style="border-radius: 40%"><span class="text-success"><i class="fa fa-comments"></i></span></a>
                </div>
                <div class="mr-4">
                    <a href="#" class="btn btn-light bg-white btn-lg py-1 px-2" style="border-radius: 40%"><span class="text-success"><i class="fa fa-bell"></i></span></a>
                </div>
                <div class="mr-4">
                    <img src="{{auth()->user()->profile_pic ?? asset('img/placeholders/profile.png')}}" class="img img-fluid border border-success" style="border-radius: 50%; width: 45px; height: 45px;"/>
                </div>
                <div class="mr-4 dropdown">
                    <a id="navbarDropdown" href="#" class="btn btn-light bg-white btn-lg py-1 px-2 dropdown-toggle text-success" style="border-radius: 40%" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars"></i></a>

                    <div class="dropdown-menu dropdown-menu-right mt-3" aria-labelledby="navbarDropdown">
                        <span class="dropdown-item">{{auth()->user()->fullname ?? (auth()->user()->lastname.' '.auth()->user()->firstname)}}</span>
                        <hr>
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#changepassword">Change Password</a>
                        <a class="dropdown-item" href="#"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ ($guard == "Doctor Portal") ? route('doctor.logout') : (($guard == "Nurse Portal") ? route('nurse.logout') : (($guard == "Pharmacist Portal") ? route('pharmacist.logout') : route('logout'))) }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
@if (session()->has('success_password'))
<br>
    <div class="row justify-content-center">
        <div class="col-6 bg-success px-4 py-2">
            <span class="text-light">{{session()->get('success_password')}}</span>
        </div>
    </div><br><br>
@endif
@if (session()->has('error_password'))
<br>
    <div class="row justify-content-center">
        <div class="col-6 bg-danger px-4 py-2">
            <span class="text-light">{{session()->get('error_password')}}</span>
        </div>
    </div><br><br>
@endif

<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="changepassword" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="row justify-content-center mt-5">
                <span class="form-header">Change Password</span>
            </div>
            <div class="row justify-content-center">
                <div class="col-9">
                    <form method="post" action="{{ route('change-password') }}">
                        @csrf
                
                        <div class="form-group my-4">
                            <div class="col">
                                <div class="row my-2">
                                    <div class="col-11 pt-1 px-0">
                                        <input id="old_password" type="password" class="form-control input-green" name="old_password" required placeholder="Enter Old Password">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-11 pt-1 px-0">
                                        <input id="password" type="password" class="form-control input-green" name="password" required placeholder="Enter New Password">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-11 pt-1 px-0">
                                        <input id="confirm_password" type="password" class="form-control input-green" name="confirm_password" required placeholder="Confirm New Password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-5 row justify-content-center">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-danger w-100" style="border-radius: 25px;">
                                    {{ __('Update Password') }}
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