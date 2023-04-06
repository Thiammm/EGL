<!DOCTYPE html>

<html lang="en" style="height:100%">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Starter</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="hold-transition login-page bg-dark" >
        <div class="container " style="height:100vh">
            <div class="d-flex justify-content-center align-items-center" style="height:100%">
                <div class="card card-outline card-primary bg-dark" style="width:80%">
                    <div class="card-header text-center">
                        <a href="../../index2.html" class="h1"><b>EGL </b>CORPORATE v1</a>
                    </div>

                    @yield('form')

                </div>
            </div>
            
        </div>
    </body>
</html>