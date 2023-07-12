
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
        
        
        {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script> --}}
        {{-- <script>
            window.addEventListener("showSuccessMessage", function(e){
                Swal.fire(e.detail)
            });
    
            window.addEventListener("showConfirmMessage", function(e){
                Swal.fire(e.detail).then((result)=>{
                    if(result.isConfirmed){
                    }
                })
            });
            
        </script> --}}
    </body>
</html>
