<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="format-detection" content="telephone=no">
        <meta charset="UTF-8">

        <meta name="description" content="Siyaleader Ports Case Console Management">
        <meta name="keywords" content="Siyaleader, Ports, Trasnet,">
        <link rel="icon" type="image/x-icon" sizes="16x16" href="/img/favicon.ico?v1">

        <title>Siyaleader Ports</title>

        <!-- CSS -->
        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/calendar.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/icons.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/generics.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/token-input.css') }}" rel="stylesheet">

        <link href="{{ asset('/incl/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('/incl/siyaleader_ports.css') }}" rel="stylesheet">


        <!-- DataTables CSS -->
        <link href="{{ asset('/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="{{ asset('/bower_components/datatables-responsive/css/responsive.dataTables.scss') }}" rel="stylesheet">


         <!-- Map -->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwXS96_uM6y-6ZJZhSJGE87pO-qxpDp-Q&libraries=geometry"></script>
        <script src="{{ asset('/js/jquery.min.js') }}"></script> <!-- jQuery Library -->
        <script type="text/javascript" src="{{ asset('/incl/oms.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('incl/infobox_packed.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/incl/markerclusterer.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/incl/siyaleader_ports_vars.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/incl/siyaleader_ports_functions.js') }}"></script>

    </head>
    <body id="skin-blur-sunset">

        <header id="header" class="media">
            <a href="" id="menu-toggle"></a>
            <a class="logo pull-left" href="index.html">
                <img scr="{{ asset('/images/transnet_1.png') }}"/>
            </a>

            <div class="media-body">
                <div class="media" id="top-menu">

                    <div class="pull-left tm-icon">

                        <a data-drawer="notifications" class="drawer-toggle" href="" data-toggle="modal" onClick="launchAddress();" data-target=".modalAddress">
                            <i class="fa fa-book fa-3x"></i>
                            <i class="n-count animated">9</i>

                        </a>
                    </div>


                    <div id="time" class="pull-right">
                        <span id="hours"></span>
                        :
                        <span id="min"></span>
                        :
                        <span id="sec"></span>
                    </div>

                    <div class="media-body">
                        <input type="text" class="main-search">
                    </div>
                </div>
            </div>
        </header>

        <div class="clearfix"></div>

        <section id="main" class="p-relative" role="main">

            <!-- Sidebar -->
            <aside id="sidebar">

                <!-- Sidbar Widgets -->
                <div class="side-widgets overflow">
                    <!-- Profile Menu -->
                    <div class="text-center s-widget m-b-25 dropdown" id="profile-menu">
                        <a href="" data-toggle="dropdown">
                            <img class="profile-pic animated" src="{{ asset('/img/dark.png') }}" alt="">
                        </a>
                        <ul class="dropdown-menu profile-menu">
                            <li><a href="{{ url('/auth/logout') }}">Sign Out</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                        </ul>
                        @if (Auth::user())
                            <h4 class="m-0">
                                {{ Auth::user()->name }}  {{ Auth::user()->surname }}
                            </h4>
                            {{ Auth::user()->username }}
                        @endif


                    </div>

                    <!-- Calendar -->
                    <div class="s-widget m-b-25">
                        <div id="sidebar-calendar"></div>
                    </div>
                </div>

                <!-- Side Menu -->
                <ul class="list-unstyled side-menu">

                    <li {{ (Request::is('map') ? "class=active" : '') }}>
                        <a class="sa-side-home" href="{{ url('map') }}">
                            <span class="menu-item">Map</span>
                        </a>
                    </li>

                    <li {{ (Request::is('home') ? "class=active" : '') }}>
                        <a class="sa-side-folder" href="{{ url('home') }}">
                            <span class="menu-item">My Cases</span>
                        </a>
                    </li>

                    <li {{ (Request::is('list-users') ? "class=active dropdown" : 'dropdown') }}>

                        <a class="sa-side-ui" href="">
                            <span class="menu-item">Administration</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                         @if ( Auth::user()->role == 1)
                            <li><a href="{{ url('list-users') }}">Users</a></li>
                            <li><a href="{{ url('list-departments') }}">Departments</a></li>
                            <li><a href="{{ url('list-positions') }}">Positions</a></li>
                            <li><a href="{{ url('list-relationships') }}">Relationships</a></li>
                         @endif
                        </ul>
                    </li>

                </ul>

            </aside>

            <!-- Content -->
            <section id="content" class="container">
                @include('addressbook.list')
                @yield('content')


            </section>

        </section>

        <!-- Javascript Libraries -->
        <!-- jQuery -->


        <script src="{{ asset('/js/jquery-ui.min.js') }}"></script> <!-- jQuery UI -->
        <script src="{{ asset('/js/jquery.easing.1.3.js') }}"></script> <!-- jQuery Easing - Requirred for Lightbox + Pie Charts-->

        <!-- Bootstrap -->
        <script src="{{ asset('/js/bootstrap.min.js') }}"></script>

        <!-- Charts -->
        <script src="{{ asset('/js/charts/jquery.flot.js') }}"></script> <!-- Flot Main -->
        <script src="{{ asset('/js/charts/jquery.flot.time.js') }}"></script> <!-- Flot sub -->
        <script src="{{ asset('/js/charts/jquery.flot.animator.min.js') }}"></script> <!-- Flot sub -->
        <script src="{{ asset('/js/charts/jquery.flot.resize.min.js') }}"></script> <!-- Flot sub - for repaint when resizing the screen -->

        <script src="{{ asset('/js/sparkline.min.js') }}"></script> <!-- Sparkline - Tiny charts -->
        <script src="{{ asset('/js/easypiechart.js') }}"></script> <!-- EasyPieChart - Animated Pie Charts -->
        <script src="{{ asset('/js/charts.js') }}"></script> <!-- All the above chart related functions -->

        <!-- Map -->
        <script src="{{ asset('/js/maps/jvectormap.min.js') }}"></script> <!-- jVectorMap main library -->
        <script src="{{ asset('/js/maps/usa.js') }}"></script> <!-- USA Map for jVectorMap -->

        <!--  Form Related -->
        <script src="{{ asset('/js/icheck.js') }}"></script> <!-- Custom Checkbox + Radio -->

        <!-- UX -->
        <script src="{{ asset('/js/scroll.min.js') }}"></script> <!-- Custom Scrollbar -->

        <!-- Other -->
        <script src="{{ asset('/js/calendar.min.js') }}"></script> <!-- Calendar -->
        <script src="{{ asset('/js/feeds.min.js') }}"></script> <!-- News Feeds -->


        <!-- All JS functions -->
        <script src="{{ asset('/js/functions.js') }}"></script>

         <!-- Media -->
        <script src="{{ asset('/js/superbox.min.js') }}"></script> <!-- Photo Gallery -->


         <!-- Token Input -->
        <script src="{{ asset('/js/jquery.tokeninput.js') }}"></script> <!-- Token Input -->




         <!-- DataTables JavaScript -->
        <script src="{{ asset('/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>



        <!-- Jquery Bootstrap Maxlength -->
        <script src="{{ asset('/bower_components/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>



        @yield('footer')
    </body>
</html>
