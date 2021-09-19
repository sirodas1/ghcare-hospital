@php
    $back_check = View::hasSection('back-check');
@endphp
<nav id="topbar" class="my-4">
    <div class="row justify-content-between px-2">
        <div class="px-0">
            @if ($back_check)
                <a href="@yield('page-back')"><span class="h5 text-success"><i class="fa fa-chevron-left"></i></span></a>&emsp;
            @endif
            <span class="h4 text-dark"><strong>@yield('title')</strong></span>
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
                    <img src="{{asset('img/profile.jpg')}}" class="img img-fluid border border-success" style="border-radius: 50%; width: 45px; height: 45px;"/>
                </div>
                <div class="mr-4 dropdown">
                    <a id="navbarDropdown" href="#" class="btn btn-light bg-white btn-lg py-1 px-2 dropdown-toggle text-success" style="border-radius: 40%" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars"></i></a>

                    <div class="dropdown-menu dropdown-menu-right mt-3" aria-labelledby="navbarDropdown">
                        <span class="dropdown-item">{{auth()->user()->fullname}}</span>
                        <hr>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>