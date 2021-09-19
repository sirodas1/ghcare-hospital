<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GhCare | Login</title>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-around">
            <div class="d-none d-md-block col-md-7">
                <div class="row justify-content-center my-5">
                    <img src="/img/ghcare.png" class="img img-fluid" width="90%">
                </div>
                <div class="row justify-content-start gh-service-row">
                    <img src="/img/ghana-health-service.png" class="img img-fluid" width="180px">
                </div>
            </div>
            <div class="col-md-5">
                <br>
                <div class="card w-100 py-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>