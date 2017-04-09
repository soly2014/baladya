<!DOCTYPE html>
<html lang="en" dir="rtl">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Neon Admin Panel" />
        <meta name="author" content="" />

        <link rel="icon" href="{{ url('/images/favicon.ico') }}">

        <title>Baladya | Dashboard 2</title>

        <link rel="stylesheet" href="{{ url('/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css') }}">
        <link rel="stylesheet" href="{{ url('/css/font-icons/entypo/css/entypo.css') }}">
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
        <link rel="stylesheet" href="{{ url('/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ url('/css/neon-core.css') }}">
        <link rel="stylesheet" href="{{ url('/css/neon-theme.css') }}">
        <link rel="stylesheet" href="{{ url('/css/neon-forms.css') }}">
        <link rel="stylesheet" href="{{ url('/css/neon-rtl.css') }}">
        <link rel="stylesheet" href="{{ url('/css/custom.css') }}">
        <link rel="stylesheet" href="{{ url('/js/jvectormap/jquery-jvectormap-1.2.2.css') }}">
        <link rel="stylesheet" href="{{ url('/js/rickshaw/rickshaw.min.css') }}">

        <link rel="stylesheet" href="{{url('/js/select2/select2.css')}}">
        <link rel="stylesheet" href="{{url('/js/datatables/datatables.css')}}">
        <link rel="stylesheet" href="{{url('/js/select2/select2-bootstrap.css')}}">

        <script src="{{ url('/js/jquery-1.11.3.min.js') }}"></script>

        <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


    </head>
    <body class="page-body  page-left-in" data-url="http://neon.dev">

        <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->



            <div class="sidebar-menu">

                <div class="sidebar-menu-inner">

                    <header class="logo-env">

                        <!-- logo -->
                        <div class="logo">
                            <a href="index.html">
                                <img src="{{ url('/images/logo1.png')}}" width="80" alt="" />
                            </a>
                        </div>

                        <!-- logo collapse icon -->
                        <div class="sidebar-collapse">
                            <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                                <i class="entypo-menu"></i>
                            </a>
                        </div>


                        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                        <div class="sidebar-mobile-menu visible-xs">
                            <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                                <i class="entypo-menu"></i>
                            </a>
                        </div>

                    </header>

                    <div class="sidebar-user-info">

                        <div class="sui-normal">
                            <a href="#" class="user-link">

                                <span>{{trans('auth.welcome')}},</span>
                                <strong>{{ session('user_object')->first_name .' '.session('user_object')->last_name }}</strong>
                            </a>
                        </div>

                        <div class="sui-hover inline-links animate-in"><!-- You can remove "inline-links" class to make links appear vertically, class "animate-in" will make A elements animateable when click on user profile -->
                            <a href="#">
                                <i class="entypo-pencil"></i>
                                {{trans('dashboard.profile')}}
                            </a>
                            <a href="extra-lockscreen.html">
                                <i class="entypo-lock"></i>
                                {{trans('dashboard.logout')}}

                            </a>

                            <span class="close-sui-popup">&times;</span><!-- this is mandatory -->				</div>
                    </div>


                    <ul id="main-menu" class="main-menu">
                        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                        @foreach (config('nav') as $main)

                        <li>
                            <a href="{{$main['route']}}">
                                <i class="{{$main['icon']}}"></i>
                                <span class="title">{{trans('dashboard.'.$main['name'])}}</span>
                            </a>
                        </li>

                        @endforeach
                    </ul>

                </div>

            </div>


            @yield('content')
        </div>

        <!-- Imported styles on this page -->
        <link rel="stylesheet" href="{{ url('/js/jvectormap/jquery-jvectormap-1.2.2.css') }}">
        <link rel="stylesheet" href="{{ url('/js/rickshaw/rickshaw.min.css') }}">

        <!-- Bottom scripts (common) -->
        <script src="{{ url('/js/gsap/TweenMax.min.js') }}"></script>
        <script src="{{ url('/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
        <script src="{{ url('/js/bootstrap.js') }}"></script>
        <script src="{{ url('/js/joinable.js') }}"></script>
        <script src="{{ url('/js/resizeable.js') }}"></script>
        <script src="{{ url('/js/neon-api.js') }}"></script>
        <script src="{{ url('/js/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>

        <script src="{{ url('/js/select2/select2.min.js') }}"></script>
        <script src="{{ url('/js/datatables/datatables.js') }}"></script>


        <!-- Imported scripts on this page -->
        <script src="{{ url('/js/jvectormap/jquery-jvectormap-europe-merc-en.js') }}"></script>
        <script src="{{ url('/js/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ url('/js/jquery.sparkline.min.js') }}"></script>
        <script src="{{ url('/js/rickshaw/vendor/d3.v3.js') }}"></script>
        <script src="{{ url('/js/rickshaw/rickshaw.min.js') }}"></script>
        <script src="{{ url('/js/neon-chat.js') }}"></script>


        <!-- JavaScripts initializations and stuff -->
        <script src="{{ url('/js/neon-custom.js') }}"></script>


        <!-- Demo Settings -->
        <script src="{{ url('/js/neon-demo.js') }}"></script>





    </body>
</html>