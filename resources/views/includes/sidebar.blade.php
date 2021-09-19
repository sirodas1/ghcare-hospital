<div class="sidenav">
    <div class="row justify-content-center mt-2">
        <img src="{{asset('img/ghcare.png')}}" class="img img-fluid w-50">
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-9">
            <button class="btn btn-success py-2 px-2 w-100" style="border-radius: 12px" onclick="window.location.href = '{{route('home')}}';">
                <img src="{{asset('img/menu.png')}}" class="img img-fluid" width="12%">&emsp; 
                <span style="font-size: 1.1rem; font-weight: Bold">Dashboard</span>&emsp;&emsp;&emsp;
                <i class="fa fa-arrow-right"></i>
            </button>
        </div>
    </div>
    <div class="mt-3 row justify-content-start">
        <div class="col-10">
            <a href="#" class="mt-3 w-100">
                <span class="text-success"><i class="fa fa-clinic-medical"></i></span>&emsp; 
                Hospitals 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
            <a href="#" class="mt-2">
                <span class="text-success"><i class="fa fa-user-injured"></i></span>&emsp; 
                Patients 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
            <a href="#" class="mt-2">
                <span class="text-success"><i class="fa fa-chart-line"></i></span>&emsp; 
                Statistics 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
            <a href="#" class="mt-2">
                <span class="text-success"><i class="fa fa-sliders-h"></i></span>&emsp; 
                Settings 
                <span class="float-right"><i class="fa fa-chevron-right"></i></span>
            </a>
        </div>
    </div>
    <img src="{{asset('img/sidebar_footer.png')}}" class="img img-fluid" width="60%"  style="position: absolute; bottom: 2%; left: 15%">
</div>