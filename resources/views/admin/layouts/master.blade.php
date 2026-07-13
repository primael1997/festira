
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title> Dashboard &mdash; Festira</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('admin/assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('admin/assets/modules/jqvmap/dist/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/modules/weather-icon/css/weather-icons.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/modules/weather-icon/css/weather-icons-wind.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/modules/summernote/summernote-bs4.css')}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/css/components.css')}}">
<!-- Start GA -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>

   <style>
        #toast-container > .toast-success {
            background-color: #28a745 !important;
            color: #fff !important;
        }

        #toast-container > .toast-error {
            background-color: #dc3545 !important;
            color: #fff !important;
        }

        #toast-container > .toast {
            opacity: 1 !important;
        }
    </style>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

        <!-- Navbar Content -->
            @include('admin.layouts.navbar')
        <!-- Navbar Content End-->

        <!-- sidebar Content -->
            @include('admin.layouts.sidebar')
        <!-- sidebar Content -->


        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>

    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('admin/assets/modules/jquery.min.js')}}"></script>
  <script src="{{asset('admin/assets/modules/popper.js')}}"></script>
  <script src="{{asset('admin/assets/modules/tooltip.js')}}"></script>
  <script src="{{asset('admin/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('admin/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{asset('admin/assets/modules/moment.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/stisla.js')}}"></script>

  <!-- JS Libraies -->
  <script src="{{asset('admin/assets/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
  <script src="{{asset('admin/assets/modules/chart.min.js')}}"></script>
  <script src="{{asset('admin/assets/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
  <script src="{{asset('admin/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
  <script src="{{asset('admin/assets/modules/summernote/summernote-bs4.js')}}"></script>
  <script src="{{asset('admin/assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('admin/assets/js/page/index-0.js')}}"></script>

  <!-- Template JS File -->
  <script src="{{asset('admin/assets/js/scripts.js')}}"></script>
  <script src="{{asset('admin/assets/js/custom.js')}}"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{$error}}")
        @endforeach
    @endif
  </script>

  <!-- Dynamic Delete alart -->

  <script>
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('body').on('click', '.delete-item', function(event){
            event.preventDefault();

            let deleteUrl = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'DELETE',
                        url: deleteUrl,

                        success: function(data){

                            if(data.status == 'success'){
                                Swal.fire(
                                    'Deleted!',
                                    data.message,
                                    'success'
                                )
                                window.location.reload();
                            }else if (data.status == 'error'){
                                Swal.fire(
                                    'Cant Delete',
                                    data.message,
                                    'error'
                                )
                            }
                        },
                        error: function(xhr, status, error){
                            console.log(error);
                        }
                    })
                }
            })
        })

    })
  </script>


  @stack('scripts')
</body>
</html>
