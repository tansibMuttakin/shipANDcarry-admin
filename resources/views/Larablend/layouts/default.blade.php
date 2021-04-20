<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('page_title')</title>
    <meta name="description" content="@yield('page_description')">
    <meta name="keywords" content="@yield('page_keywords')">
    <meta name="author" content="Zubair Hasan">
    <meta name="copyright" content="Duoneos">
    <!-- Including Paper Dashboard CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/assets/css/paper-dashboard.css') }}">
    <!-- Including Boostrap Table CSS -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/1c781ab882.js" crossorigin="anonymous"></script>
    <style>
        .pagination{
            justify-content: end;
        }
    </style>
</head>
<body>
<div class="wrapper">
    @include('Larablend.component.sidebar')
    <div class="main-panel">
        <nav class="navbar navbar-expand-lg navbar-absolute bg-white fixed-top">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-icon btn-round">
                            <i class="nc-icon nc-minimal-right text-center visible-on-sidebar-mini"></i>
                            <i class="nc-icon nc-minimal-left text-center visible-on-sidebar-regular"></i>
                        </button>
                    </div>
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="javascript:;">Dashboard</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <ul class="navbar-nav">
                        <li class="nav-item btn-rotate dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:;" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="nc-icon nc-bell-55"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Some Actions</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="javascript:;">No Notifications</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-rotate" href="/view_setting">
                                <i class="nc-icon nc-settings-gear-65"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Account</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-uppercase mb-0">@yield('page_title')</h3>
                </div>
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </div>

        <footer class="footer footer-black  footer-white ">
            <div class="container">
                <div class="row">
                    <nav class="footer-nav">
                        <ul>
                            <li><a href="https://facebook.com/duoneos" target="_blank"><i class="fab fa-2x fa-facebook"></i></a></li>
                            <li><a href="https://instagram.com/duoneos_ig" target="_blank"><i class="fab fa-2x fa-instagram"></i></a></li>
                            <li><a href="https://www.linkedin.com/company/duoneos" target="_blank"><i class="fab fa-2x fa-linkedin"></i></a></li>
                        </ul>
                    </nav>
                    <div class="credits ml-auto">
                <span class="copyright">
                  © <script>
                    document.write(new Date().getFullYear())
                    </script>, made with <i class="fa fa-heart heart"></i> by <a href="https://duoneos.com/" target="_blank"><strong class="text-uppercase">Duoneos</strong></a>
                </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- Required JS: Starts -->

<script src="{{asset('/assets/js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/js/plugins/moment.min.js')}}"></script>

<!--  Plugin for Sweet Alert -->
<script src="{{asset('/assets/js/plugins/sweetalert2.min.js')}}"></script>

<!-- Forms Validations Plugin -->
<script src="{{asset('/assets/js/plugins/jquery.validate.min.js')}}"></script>

<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{asset('/assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>

<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{asset('/assets/js/plugins/bootstrap-selectpicker.js')}}" type="text/javascript"></script>

<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{asset('/assets/js/plugins/bootstrap-switch.js')}}"></script>

<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{asset('/assets/js/plugins/bootstrap-datetimepicker.js')}}"></script>

<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="{{asset('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>

<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{asset('/assets/js/plugins/bootstrap-tagsinput.js')}}"></script>

<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{asset('/assets/js/plugins/jasny-bootstrap.min.js')}}"></script>

<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{asset('/assets/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>

<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{asset('/assets/js/plugins/jquery-jvectormap.js')}}"></script>

<!--  Plugin for the Bootstrap Table -->
<script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{asset('/assets/js/plugins/nouislider.min.js')}}" type="text/javascript"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqYsRw3MosBLtVy-L5RE7ZfZOxeFbPaEw"></script>

<!-- Chart JS -->
<script src="{{asset('/assets/js/plugins/chartjs.min.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{asset('/assets/js/plugins/bootstrap-notify.js')}}"></script>

<!-- Control Center for Paper Dashboard -->

<script src="{{asset('/assets/js/paper-dashboard.js')}}" type="text/javascript"></script>

<!-- Required JS: Ends -->

<script>
    $(document).ready( function () {
        $('#index-table').DataTable();
    } );
    <!-- javascript for init -->
    $('.datetimepicker').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
    });


</script>
</body>
</head>
</html>
