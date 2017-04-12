<!DOCTYPE html>
<html lang="en" dir="rtl">

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Neon Admin Panel" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link rel="icon" href="{{ url('/images/favicon.ico') }}">

        <title>{{!empty($title)?$title:''}}</title>

        <link rel="stylesheet" href="{{ url('/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css') }}">
        <link rel="stylesheet" href="{{ url('/css/font-icons/entypo/css/entypo.css') }}">
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
        <link rel="stylesheet" href="{{ url('/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ url('/css/neon-core.css') }}">
        <link rel="stylesheet" href="{{ url('/css/neon-theme.css') }}">

        <link rel="stylesheet" href="{{ url('/css/neon-rtl.css') }}">
        <link rel="stylesheet" href="{{ url('/css/custom.css') }}">
        <link rel="stylesheet" href="{{ url('/css/neon-forms.css') }}">
        <!-- Imported styles on this page -->
        <link rel="stylesheet" href="{{url('/js/selectboxit/jquery.selectBoxIt.css')}}">
        <link rel="stylesheet" href="{{ url('/js/jvectormap/jquery-jvectormap-1.2.2.css') }}">
        <link rel="stylesheet" href="{{ url('/js/rickshaw/rickshaw.min.css') }}">
        <link rel="stylesheet" href="{{url('/js/select2/select2.css')}}">
        <link rel="stylesheet" href="{{url('/js/datatables/datatables.css')}}">
        <link rel="stylesheet" href="{{url('/js/select2/select2-bootstrap.css')}}">
    <!-- dropzone css -->


        <script src="{{ url('/js/jquery-1.11.3.min.js') }}"></script>

        <link rel="stylesheet" href="{{url('/js/icheck/skins/minimal/_all.css')}}">
        <link rel="stylesheet" href="{{url('/js/icheck/skins/square/_all.css')}}">
        <link rel="stylesheet" href="{{url('/js/icheck/skins/flat/_all.css')}}">
        <link rel="stylesheet" href="{{url('/js/icheck/skins/futurico/futurico.css')}}">
        <link rel="stylesheet" href="{{('/js/icheck/skins/polaris/polaris.css')}}">

        <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="{{ url('/js/jquery-1.11.3.min.js') }}"></script>



        <!--[if lt IE 9]><script src="{{url('/')}}/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="{{ url('/js/jquery.sparkline.min.js') }}"></script>
        <script src="{{ url('/js/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ url('/js/jvectormap/jquery-jvectormap-europe-merc-en.js') }}"></script>
        <script src="{{ url('/js/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ url('/js/select2/select2.min.js') }}"></script>
       


        

    </head>
    <body class="page-body  page-left-in" data-url="http://neon.dev">

        <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->


            <div class="sidebar-menu">

                <div class="sidebar-menu-inner">

                    <header class="logo-env">

                        <!-- logo -->
                        <div class="logo">
                            <a href="{{ url('admin')}}">
                                <img src="{{ url('/images/logo.png')}}" width="75" alt="" />
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
                            </a>
                            <strong>{{ session('user_object')->first_name .' '.session('user_object')->last_name }}</strong>
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
                             

                        @if(session('user_role')=='moderator' || session('user_role')=='contra_moderator'||session('user_role')=='manager' )


                            @if(session('type')==0)
                             <li class="has-sub">
                                    <a href="{{url('admin')}}">
                                        <i class="entypo-eye"></i>
                                        <span class="title">{{trans('dashboard.violation_managment')}}</span>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="{{url('admin/violation')}}">
                                                <i class="entypo-eye"></i>
                                                <span class="title">{{trans('dashboard.violation')}}</span>
                                            </a>
                                        </li>
                                        @if(session('user_role')=='moderator')
                                        <li>
                                            <a href="{{url('admin/violation/create')}}">
                                                <i class="entypo-eye"></i>
                                                <span class="title">{{trans('dashboard.create')}}</span>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                            </li>
                            @else
                            <li class="has-sub">
                                    <a href="{{url('admin')}}">
                                        <i class="entypo-eye"></i>
                                        <span class="title">{{trans('dashboard.health_violation')}}</span>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="{{url('admin/health_violation')}}">
                                                <i class="entypo-eye"></i>
                                                <span class="title">{{trans('dashboard.health_violation')}}</span>
                                            </a>
                                        </li>
                                    </ul>
                            </li>
                            <li class="has-sub">
                                    <a href="{{url('admin')}}">
                                        <i class="entypo-eye"></i>
                                        <span class="title">{{trans('dashboard.user_visit')}}</span>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="{{url('admin/uservisit')}}">
                                                <i class="entypo-eye"></i>
                                                <span class="title">{{trans('dashboard.user_visit')}}</span>
                                            </a>
                                        </li>
                                        @if(session('user_role')=='manager'||session('user_role')=='admin')
                                        <li>
                                            <a href="{{url('admin/uservisit/create')}}">
                                                <i class="entypo-eye"></i>
                                                <span class="title">{{trans('dashboard.create')}}</span>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                            </li>
                            @endif
                        @else





                            @if(session('type')==0)
                                @foreach (config('nav3') as $main)
                                
                                    @if(in_array(session("user_role"), $main['role']))
                                    @if(session("user_role") =='admin')

                                    <li class="has-sub">
                                        <a href="{{url('admin').'/'.$main['route']}}">
                                            <i class="{{$main['icon']}}"></i>
                                            <span class="title">{{trans('dashboard.'.$main['name'])}}</span>
                                        </a>

                                        @if(strstr(Route::getCurrentRoute()->getPath(),'admin/'.$main['route']))
                                        <ul class="visible">
                                        @else
                                        <ul>
                                        @endif


                                                @foreach ($main['children'] as $child)
                                                @if(Route::getCurrentRoute()->getPath() == 'admin/'.$child['route'])

                                                <li class="active">
                                                    @else
                                                <li>
                                                    @endif
                                                    <a href="{{url('admin').'/'.$child['route']}}">
                                                        <i class="{{$child['icon']}}"></i>
                                                        <span class="title">{{trans('dashboard.'.$child['name'])}}</span>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                    </li>
                                    @else
                                    @if(in_array(session("user_role"),$main['role']))
                                    <!--&& in_array(Sentinel::getUser()->service_id , $main['service'])-->
                                    <li class="has-sub">
                                        <a href="{{url('admin').'/'.$main['route']}}">
                                            <i class="{{$main['icon']}}"></i>
                                            <span class="title">{{trans('dashboard.'.$main['name'])}}</span>
                                        </a>
                                        @if(strstr(Route::getCurrentRoute()->getPath(),'admin/'.$main['route']))
                                        <ul class="visible">
                                            @else
                                            <ul>
                                                @endif
                                                @foreach ($main['children'] as $child)
                                                @if(Route::getCurrentRoute()->getPath() == 'admin/'.$child['route'])

                                                <li class="active">
                                                    @else
                                                <li>
                                                    @endif
                                                    @if(session("user_role") =='contra_moderator' && $child['route'] == 'violation/create')
                                                    
                                                    @else
                                                        <a href="{{url('admin').'/'.$child['route']}}">
                                                            <i class="{{$child['icon']}}"></i>
                                                            <span class="title">{{trans('dashboard.'.$child['name'])}}</span>
                                                        </a>
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                    </li>
                                    @endif
                                    @endif
                                    @endif

                                @endforeach
                            @else

                                @foreach (config('nav') as $main)
                                
                                    @if(in_array(session("user_role"), $main['role']))
                                    @if(session("user_role") =='admin')

                                    <li class="has-sub">
                                        <a href="{{url('admin').'/'.$main['route']}}">
                                            <i class="{{$main['icon']}}"></i>
                                            <span class="title">{{trans('dashboard.'.$main['name'])}}</span>
                                        </a>
                                        @if(strstr(Route::getCurrentRoute()->getPath(),'admin/'.$main['route']))
                                        <ul class="visible">
                                            @else
                                            <ul>
                                                @endif
                                                @foreach ($main['children'] as $child)
                                                @if(Route::getCurrentRoute()->getPath() == 'admin/'.$child['route'])

                                                <li class="active">
                                                    @else
                                                <li>
                                                    @endif
                                                    <a href="{{url('admin').'/'.$child['route']}}">
                                                        <i class="{{$child['icon']}}"></i>
                                                        <span class="title">{{trans('dashboard.'.$child['name'])}}</span>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                    </li>
                                    @else

                                    @if(in_array(session("user_role"),$main['role']))
                                    <!--&& in_array(Sentinel::getUser()->service_id , $main['service'])-->
                                    
                                    <li class="has-sub">
                                        <a href="{{url('admin').'/'.$main['route']}}">
                                            <i class="{{$main['icon']}}"></i>
                                            <span class="title">{{trans('dashboard.'.$main['name'])}}</span>
                                        </a>
                                        @if(strstr(Route::getCurrentRoute()->getPath(),'admin/'.$main['route']))
                                        <ul class="visible">
                                            @else
                                            <ul>
                                                @endif
                                                @foreach ($main['children'] as $child)
                                                @if(Route::getCurrentRoute()->getPath() == 'admin/'.$child['route'])

                                                <li class="active">
                                                    @else
                                                <li>
                                                    @endif
                                                    @if(session("user_role") =='contra_moderator' && $child['route'] == 'violation/create')
                                                    
                                                    @else
                                                        <a href="{{url('admin').'/'.$child['route']}}">
                                                            <i class="{{$child['icon']}}"></i>
                                                            <span class="title">{{trans('dashboard.'.$child['name'])}}</span>
                                                        </a>
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                    </li>
                                    @endif
                                    @endif
                                    @endif

                                @endforeach
                            @endif

                                


                        @endif  
                    </ul>

                </div>

            </div>















            <div class="main-content">

                <div class="row">

                    <!-- Profile Info and Notifications -->
                    <div class="profile-div">
                        <div class="col-md-6 col-sm-8 clearfix">

                            <ul class="user-info pull-left pull-none-xsm">

                                <!-- Profile Info -->
                                <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->

                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="{{url('/')}}/images/user.png" alt="" class="img-circle" width="44" />
                                        {{trans('dashboard.welcome')}}
                                    </a>
                                    <strong>{{ session('user_object')->first_name .' '.session('user_object')->last_name }}</strong>

                                </li>

                            </ul>


                        </div>


                        <!-- Raw Links -->
                        <div class="col-md-6 col-sm-4 clearfix hidden-xs">

                            <ul class="list-inline links-list pull-right">


                                <li>
                                    <a href="{{url('auth/logout')}}">
                                        {{trans('dashboard.logout')}} <i class="entypo-logout right"></i>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>


                {{--<main class="row">--}}
                @if(session()->has('ok'))
                @include('partials/error', ['type' => 'success', 'message' => session('ok')])
                @endif
                {{--@if(isset($info))--}}
                {{--@include('partials/error', ['type' => 'info', 'message' => $info])--}}
                {{--@endif--}}
                {{--@if(isset($error))--}}
                {{--@include('partials/error', ['type' => 'danger', 'message' => $error])--}}
                {{--@endif--}}

                {{--@if (count($errors) > 0)--}}
                {{--<div class="alert alert-danger">--}}
                {{--<ul>--}}
                {{--@foreach ($errors->all() as $error)--}}
                {{--<li>{{ $error }}</li>--}}
                {{--@endforeach--}}
                {{--</ul>--}}
                {{--</div>--}}
                {{--@endif--}}
                {{--</main>--}}
                @if(session('success'))
                <script>
                // Sample Toastr Notification
                setTimeout(function ()
                {
                    var opts = {
                        "closeButton": true,
                        "debug": false,
                        "positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-top-left" : "toast-top-right",
                        "toastClass": "green",
                        "onclick": null,
                        "showDuration": "10",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.success('{{session('success')}}', opts);
                }, 3000);
                </script>
                @endif
                @yield('content')


                <footer class="main">

                    &copy;{{trans('dashboard.footer')}}

                </footer>
            </div>


            <div id="chat" class="fixed" data-current-user="Art Ramadani" data-order-by-status="1" data-max-chat-history="25">

                <div class="chat-inner">


                    <h2 class="chat-header">
                        <a href="#" class="chat-close"><i class="entypo-cancel"></i></a>

                        <i class="entypo-users"></i>
                        Chat
                        <span class="badge badge-success is-hidden">0</span>
                    </h2>


                    <div class="chat-group" id="group-1">
                        <strong>Favorites</strong>

                        <a href="#" id="sample-user-123" data-conversation-history="#sample_history"><span class="user-status is-online"></span> <em>Catherine J. Watkins</em></a>
                        <a href="#"><span class="user-status is-online"></span> <em>Nicholas R. Walker</em></a>
                        <a href="#"><span class="user-status is-busy"></span> <em>Susan J. Best</em></a>
                        <a href="#"><span class="user-status is-offline"></span> <em>Brandon S. Young</em></a>
                        <a href="#"><span class="user-status is-idle"></span> <em>Fernando G. Olson</em></a>
                    </div>


                    <div class="chat-group" id="group-2">
                        <strong>Work</strong>

                        <a href="#"><span class="user-status is-offline"></span> <em>Robert J. Garcia</em></a>
                        <a href="#" data-conversation-history="#sample_history_2"><span class="user-status is-offline"></span> <em>Daniel A. Pena</em></a>
                        <a href="#"><span class="user-status is-busy"></span> <em>Rodrigo E. Lozano</em></a>
                    </div>


                    <div class="chat-group" id="group-3">
                        <strong>Social</strong>

                        <a href="#"><span class="user-status is-busy"></span> <em>Velma G. Pearson</em></a>
                        <a href="#"><span class="user-status is-offline"></span> <em>Margaret R. Dedmon</em></a>
                        <a href="#"><span class="user-status is-online"></span> <em>Kathleen M. Canales</em></a>
                        <a href="#"><span class="user-status is-offline"></span> <em>Tracy J. Rodriguez</em></a>
                    </div>

                </div>

                <!-- conversation template -->
                <div class="chat-conversation">

                    <div class="conversation-header">
                        <a href="#" class="conversation-close"><i class="entypo-cancel"></i></a>

                        <span class="user-status"></span>
                        <span class="display-name"></span>
                        <small></small>
                    </div>

                    <ul class="conversation-body">
                    </ul>

                    <div class="chat-textarea">
                        <textarea class="form-control autogrow" placeholder="Type your message"></textarea>
                    </div>

                </div>

            </div>


            <!-- Chat Histories -->
            <ul class="chat-history" id="sample_history">
                <li>
                    <span class="user">Art Ramadani</span>
                    <p>Are you here?</p>
                    <span class="time">09:00</span>
                </li>

                <li class="opponent">
                    <span class="user">Catherine J. Watkins</span>
                    <p>This message is pre-queued.</p>
                    <span class="time">09:25</span>
                </li>

                <li class="opponent">
                    <span class="user">Catherine J. Watkins</span>
                    <p>Whohoo!</p>
                    <span class="time">09:26</span>
                </li>

                <li class="opponent unread">
                    <span class="user">Catherine J. Watkins</span>
                    <p>Do you like it?</p>
                    <span class="time">09:27</span>
                </li>
            </ul>




            <!-- Chat Histories -->
            <ul class="chat-history" id="sample_history_2">
                <li class="opponent unread">
                    <span class="user">Daniel A. Pena</span>
                    <p>I am going out.</p>
                    <span class="time">08:21</span>
                </li>

                <li class="opponent unread">
                    <span class="user">Daniel A. Pena</span>
                    <p>Call me when you see this message.</p>
                    <span class="time">08:27</span>
                </li>
            </ul>


        </div>

        <!-- Sample Modal (Default skin) -->
        <div class="modal fade" id="sample-modal-dialog-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Widget Options - Default Modal</h4>
                    </div>

                    <div class="modal-body">
                        <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sample Modal (Skin inverted) -->
        <div class="modal invert fade" id="sample-modal-dialog-2">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Widget Options - Inverted Skin Modal</h4>
                    </div>

                    <div class="modal-body">
                        <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sample Modal (Skin gray) -->
        <div class="modal gray fade" id="sample-modal-dialog-3">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Widget Options - Gray Skin Modal</h4>
                    </div>

                    <div class="modal-body">
                        <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>



        <div id = "dialog" title = "" >
            {{trans('site.delete_confirm')}}
        </div>

        <!-- Bottom scripts (common) -->
        <script src="{{ url('/js/gsap/TweenMax.min.js') }}"></script>
        <script src="{{ url('/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
        <script src="{{ url('/js/bootstrap.js') }}"></script>
        <script src="{{ url('/js/joinable.js') }}"></script>
        <script src="{{ url('/js/resizeable.js') }}"></script>
        <script src="{{ url('/js/neon-api.js') }}"></script>
        <script src="{{ url('/js/bootstrap-switch.min.js') }}"></script>

        @yield('scripts')
        @if(strpos(Route::getCurrentRoute()->getPath(), 'create') !== false || strpos(Route::getCurrentRoute()->getPath(), 'edit') !== false)
        <script src="{{ url('/js/selectboxit/jquery.selectBoxIt.min.js')}}"></script>
        @else

        <script src="{{ url('/js/datatables/datatables.js') }}"></script>
        @endif


        <!-- Imported scripts on this page -->
        <script src="{{url('/js/raphael-min.js')}}"></script>
        <script src="{{url('/js/morris.min.js')}}"></script>
        <script src="{{ url('/js/rickshaw/vendor/d3.v3.js') }}"></script>
        <script src="{{ url('/js/rickshaw/rickshaw.min.js') }}"></script>
        <script src="{{ url('/js/neon-chat.js') }}"></script>
        <script src="{{url('/js/toastr.js')}}"></script>


        <!-- JavaScripts initializations and stuff -->
        <script src="{{ url('/js/neon-custom.js')}}"></script>

        <script src="{{url('/js/bootstrap-datepicker.js')}}"></script>
        <!-- Demo Settings -->
        <script src="{{ url('/js/neon-demo.js') }}"></script>
        <script type="text/javascript" src='http://maps.google.com/maps/api/js?key=AIzaSyBHJJz2luNBtzPiJmuhW_A8nCKssvswzN8&libraries=places'></script>
        <script src="{{url('/js/locationpicker.jquery.min.js')}}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="{{url('/js/jquery.peity.min.js')}}"></script>
        <script src="{{url('/js/neon-charts.js')}}"></script>

        <script>


function initMap() {
    var uluru = {lat: 27.84006274967337, lng: 30.420970916748047};
    var map = new google.maps.Map(document.getElementById('us3'), {
        zoom: 4,
        center: uluru
    });
    var marker = new google.maps.Marker({
        position: uluru,
        map: map
    });
}


var lat = $("#us3-lat").val();
var lon = $("#us3-lon").val();
$("#us3").locationpicker({
    location: {
        latitude: lat,
        longitude: lon
    },
    radius: 300,
    inputBinding: {
        latitudeInput: $("#us3-lat"),
        longitudeInput: $("#us3-lon"),
        radiusInput: $("#us3-radius"),
        locationNameInput: $("#us3-address")
    },
    enableAutocomplete: true,
    onchanged: function (currentLocation, radius, isMarkerDropped) {
        // Uncomment line below to show alert on each Location Changed event
        //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
    }
});


            $("#find_btn").click(function (){

                if ("geolocation" in navigator){
                        navigator.geolocation.getCurrentPosition(function(position){
                                var map = new google.maps.Map(document.getElementById('us3'), {
                                    zoom: 4,
                                    center: {lat: position.coords.latitude, lng: position.coords.longitude}
                                });

                                infoWindow = new google.maps.InfoWindow({map: map});
                                var pos = {lat: position.coords.latitude, lng: position.coords.longitude};
                                $("#us3-lat").val(position.coords.latitude);
                                $("#us3-lon").val(position.coords.longitude);

                                var geocoder = new google.maps.Geocoder();
                                var latLng = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);

                             if (geocoder) {
                                geocoder.geocode({ 'latLng': latLng}, function (results, status) {
                                   if (status == google.maps.GeocoderStatus.OK) {
                                       $("#us3-address").val(results[0].formatted_address);
                                   }
                                   else {
                                       $('#us3-address').val('Geocoding failed: '+status);
                                   }
                                }); 
                            }
                                infoWindow.setPosition(pos);
                                infoWindow.setContent("<br />Your Location Found<br/> Lat : "+position.coords.latitude+" </br>Lang :"+ position.coords.longitude);
                                map.panTo(pos);
                            });
                    }else{
                        console.log("Browser doesn't support geolocation!");
                }
            });


$(document).ready(function () {
    $("#dialog").dialog({
        autoOpen: false,
        modal: true
    });
});

//$(".FormDelete").submit(function (e) {
//    e.preventDefault();
//    var targetUrl = $(this).attr("href");
//
//    $("#dialog").dialog({
//        buttons: {
//            "Confirm": function () {
//                return true;
//            },
//            "Cancel": function () {
//                $(this).dialog("close");
//            }
//        }
//    });
//
//    $("#dialog").dialog("open");
//});


        </script>


        <script type="text/javascript">
            $(".FormDelete").submit(function (event) {
                var x = confirm('هل أنت متأكد؟');
                if (x) {
                    return true;
                } else {

                    event.preventDefault();
                    return false;
                }

            });






            $(document).ready(function(){





    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current){
        $('#show-previous-image, #show-next-image').show();
        if(counter_max == counter_current){
            $('#show-next-image').hide();
        } else if (counter_current == 1){
            $('#show-previous-image').hide();
        }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr){
        var current_image,
            selector,
            counter = 0;

        $('#show-next-image, #show-previous-image').click(function(){
            if($(this).attr('id') == 'show-previous-image'){
                current_image--;
            } else {
                current_image++;
            }

            selector = $('[data-image-id="' + current_image + '"]');
            updateGallery(selector);
        });

        function updateGallery(selector) {
            var $sel = selector;
            current_image = $sel.data('image-id');
            $('#image-gallery-caption').text($sel.data('caption'));
            $('#image-gallery-title').text($sel.data('title'));
            $('#image-gallery-image').attr('src', $sel.data('image'));
            disableButtons(counter, $sel.data('image-id'));
        }

        if(setIDs == true){
            $('[data-image-id]').each(function(){
                counter++;
                $(this).attr('data-image-id',counter);
            });
        }
        $(setClickAttr).on('click',function(){
            updateGallery($(this));
        });
    }


        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var id = '';
        // var captionText = document.getElementById("caption");
        var model = '';
        var modalImg = '';

        $('.oneimage').on('click', function(event) {
            /* Act on the event */
            id = $(this).attr('data-id');
            modal = $('#myModal'+ $(this).attr('data-id'));
            modalImg = $('#img0'+ $(this).attr('data-id'));
            modal.css('display','block');
            modalImg.attr('src', $(this).attr('src'));
            // captionText.innerHTML = this.alt;
        });

        $('.modal').on('click', function(event) {
            /* Act on the event */
            modal.css('display','none');
        });

        
});

 
        
        </script>

       
    </body>

</html>