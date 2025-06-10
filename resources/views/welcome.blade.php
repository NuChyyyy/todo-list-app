<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
</head>

<body>
    @if (Route::has('login'))
        <div class="container-fluid position-absolute top-50 start-50 translate-middle m-auto">
            <div class="row justify-content-center">
                @auth
                    <div class="fs-1 fw-bold text-body-emphasis text-center m-2">
                        Welcome Back!
                        <p class="fs-5 fw-light mt-1">Let's make another to-do list together</p>
                    </div>
                    <a href="{{ url('/') }}" class="col-2 btn btn-primary m-1">
                        Start<i class="bi bi-arrow-right p-2"></i>
                    </a>
                @else
                    <div class="fs-1 fw-bold text-body-emphasis text-center m-2">
                        Let's make your plan
                        <p class="fs-5 fw-light mt-1">A helper for organizing your to-do list</p>
                    </div>
                    <a href="{{ route('login') }}" class="col-6 col-sm-3 col-md-2 col-xl-1 btn btn-primary m-1">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="col-6 col-sm-3 col-md-2 col-xl-1 btn btn-outline-primary m-1">Register
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    @endif
</body>

</html>