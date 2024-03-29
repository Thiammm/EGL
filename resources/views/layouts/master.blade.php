
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Starter</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
        <div class="wrapper">
            
            <x-header />


            <x-main_side_bar />

            <div class="content-wrapper">

                <div class="content">
                    <div class="container-fluid">

                        @yield('content')

                    </div>
                </div>

            </div>


            <x-profile />


            <footer class="main-footer">

                {{-- <div class="float-right d-none d-sm-inline">
                    Anything you want
                </div> --}}

                <strong>&copy; b_project </strong> All rights reserved.
            </footer>

        </div>

        @livewireScripts
        
        {{-- <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script> --}}
    </body>
</html>
