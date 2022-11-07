<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('style/style.css')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">

<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css?v=3.2.0')}}">
</head>
<body>
    <body class="sidebar-mini" data-new-gr-c-s-check-loaded="14.1085.0" data-gr-ext-installed="" style="height: auto;">
        <div class="wrapper">
        
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        
        <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('admindashboard')}}" class="nav-link">Dashboard</a>
        </li>
        </ul>
        <ul class="navbar-nav ml-auto">    
        <li class="nav-item dropdown">
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button class="btn btn-transparent">
                <i class="fa-solid fa-cloud-arrow-up"></i>
            </button>
        </form>
        <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
        </a>
        </li>
        </ul>
        </nav>   
        <aside class="main-sidebar sidebar-secondary elevation-4">
        <a href="{{route('admindashboard')}}" class="brand-link">
        <span class="brand-text font-weight-bold">Dashboard</span>
        </a>
        
        <div class="sidebar">
        
        <div class="user-panel mb-3 pb-3 mb-3 d-inline">
        <div class="info">
        <a href="{{route('adminprofile')}}" class="d-block">{{Auth::user()->name}}</a>
        </div>
        </div>
        <nav class="mb-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{route('travel.index')}}" class="nav-link">
                <i class="ticket"></i>
                <p>
                Tickets
                </p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('travelname.index')}}" class="nav-link">
                    <i class="travel name"></i>
                    <p>
                    Travel Name
                    </p>
                    </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('traveltype.index')}}" class="nav-link">
                        <i class="flighttype"></i>
                        <p>
                        Flight Type
                        </p>
                        </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('adminUser')}}" class="nav-link">
                            <i class="user"></i>
                            <p>
                            User
                            </p>
                            </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('booked.index')}}" class="nav-link">
                                <i class="booking"></i>
                                <p>
                                  Booking
                                </p>
                                </a>
                                </li>
        </ul>
        </nav>   
        </div>
        </aside>
        
        <div class="content-wrapper" style="min-height: 334px;">    
        <div class="content">
        <div class="container-fluid">
        <div class="row">
       
        @yield('admin-content')
        </div>
        
        </div>
        </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('dist/js/adminlte.min.js?v=3.2.0')}}"></script>



<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );                
    </script>
</body>
</html>
