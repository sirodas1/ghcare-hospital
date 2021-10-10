<div class="sidenav">
    <div class="row justify-content-center mt-2">
        <img src="{{asset('img/ghcare.png')}}" class="img img-fluid w-50">
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-9">
            @auth('web')
                <button class="btn btn-success py-2 px-2 w-100" style="border-radius: 12px" onclick="window.location.href = '{{route('home')}}';">
                    <img src="{{asset('img/menu.png')}}" class="img img-fluid" width="12%">&emsp; 
                    <span style="font-size: 1.1rem; font-weight: Bold">Dashboard</span>&emsp;&emsp;&emsp;
                    <i class="fa fa-arrow-right"></i>
                </button>
            @endauth
            @auth('nurse')
                <button class="btn btn-success py-2 px-2 w-100" style="border-radius: 12px" onclick="window.location.href = '{{route('nurse.home')}}';">
                    <img src="{{asset('img/menu.png')}}" class="img img-fluid" width="12%">&emsp; 
                    <span style="font-size: 1.1rem; font-weight: Bold">Dashboard</span>&emsp;&emsp;&emsp;
                    <i class="fa fa-arrow-right"></i>
                </button>
            @endauth
            @auth('doctor')
                <button class="btn btn-success py-2 px-2 w-100" style="border-radius: 12px" onclick="window.location.href = '{{route('doctor.home')}}';">
                    <img src="{{asset('img/menu.png')}}" class="img img-fluid" width="12%">&emsp; 
                    <span style="font-size: 1.1rem; font-weight: Bold">Dashboard</span>&emsp;&emsp;&emsp;
                    <i class="fa fa-arrow-right"></i>
                </button>
            @endauth
            @auth('pharmacist')
                <button class="btn btn-success py-2 px-2 w-100" style="border-radius: 12px" onclick="window.location.href = '{{route('pharmacist.home')}}';">
                    <img src="{{asset('img/menu.png')}}" class="img img-fluid" width="12%">&emsp; 
                    <span style="font-size: 1.1rem; font-weight: Bold">Dashboard</span>&emsp;&emsp;&emsp;
                    <i class="fa fa-arrow-right"></i>
                </button>
            @endauth
        </div>
    </div>
    <div class="mt-3 row justify-content-start">
        <div class="col-10">
        @auth('web')
            <a href="{{route('staff.home')}}" class="mt-3 w-100">
                <span class="text-success"><i class="fa fa-user-tie"></i></span>&emsp; 
                Staff 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
            <a href="{{route('inventory.home')}}" class="mt-2">
                <span class="text-success"><i class="fa fa-archive"></i></span>&emsp; 
                Medical Inventory 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
            <a href="{{route('patient.home')}}" class="mt-2">
                <span class="text-success"><i class="fa fa-user-injured"></i></span>&emsp; 
                Patients 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
            <a href="{{route('settings.home')}}" class="mt-2">
                <span class="text-success"><i class="fa fa-sliders-h"></i></span>&emsp; 
                Settings 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
        @endauth
        @auth('nurse')
            <a href="{{route('nurse.patient.home')}}" class="mt-2">
                <span class="text-success"><i class="fa fa-user-injured"></i></span>&emsp; 
                Patients 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
            <a href="{{route('nurse.settings.home')}}" class="mt-2">
                <span class="text-success"><i class="fa fa-sliders-h"></i></span>&emsp; 
                Settings 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
        @endauth
        @auth('doctor')
            <a href="{{route('doctor.patient.home')}}" class="mt-2">
                <span class="text-success"><i class="fa fa-user-injured"></i></span>&emsp; 
                Patients 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
            <a href="{{route('doctor.settings.home')}}" class="mt-2">
                <span class="text-success"><i class="fa fa-sliders-h"></i></span>&emsp; 
                Settings 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
        @endauth
        @auth('pharmacist')
            <a href="{{route('pharmacist.medication.home')}}" class="mt-2">
                <span class="text-success"><i class="fa fa-tablets"></i></span>&emsp; 
                Medication 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
            <a href="{{route('pharmacist.inventory.home')}}" class="mt-2">
                <span class="text-success"><i class="fa fa-archive"></i></span>&emsp; 
                Inventory 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
            <a href="{{route('pharmacist.settings.home')}}" class="mt-2">
                <span class="text-success"><i class="fa fa-sliders-h"></i></span>&emsp; 
                Settings 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
        @endauth
        </div>
    </div>
    @if(!(Auth::guard('pharmacist')->check() || Auth::guard('doctor')->check()))
        <img src="{{asset('img/sidebar_footer.png')}}" class="img img-fluid cursor-pointer" width="60%"  style="position: absolute; bottom: 2%; left: 15%" data-toggle="modal" data-target="#patientModal">
    @endif
</div>

<div class="modal fade" id="patientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <form method="GET" action="{{ Auth::guard('nurse')->check() ? route('nurse.patient.home') : route('patient.access')}}">
                        @csrf
                
                        <div class="form-group my-4">
                            <div class="col">
                                <div class="row login-input" style="">
                                    <div class="col-1 py-2 px-1">
                                        <img src="/img/id-card@2x.png" class="img img-fluid form-icons" width="50px">
                                    </div>
                                    <div class="col-11 pt-1 px-0">
                                        <input id="national_card_id" type="text" class="form-control input-green" name="national_card_id" value="{{ old('national_card_id') }}" required autocomplete="national_card_id" autofocus placeholder="Enter Ghana National Card ID" onclick="addHash(this)" pattern="GHA-[0-9]{9}-[0-9]" title="must be in this format GHA-XXXXXXXXX-X" >
                                    </div>
                                </div>
                                @error('national_card_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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