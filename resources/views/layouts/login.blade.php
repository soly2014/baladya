<!DOCTYPE html>
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en-US"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="ar" dir="rtl">  <!--<![endif]-->
<head>

    <title>مشروع بلدية الخرج</title>

    <!-- META DATA -->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="{{url('landing/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('landing/css/style.css')}}" >

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{url('landing/css/jquery.fullPage.css')}}">
    <link rel="stylesheet" href="{{url('landing/css/animate.min.css')}}">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

    <script src="{{url('landing/js/respond.min.js')}}"></script>
    <![endif]-->

    <!--[if lt IE 11]>
    <link rel="stylesheet" type="text/css" href="{{url('landing/css/ie.css')}}">
    <![endif]-->

    <!-- JS -->
    <script type="text/javascript" src="{{url('landing/js/modernizr.js')}}"></script>

    <!-- FAVICONS -->
    <link rel="shortcut icon" href="{{url('landing/images/favicon.ico')}}">
    <link rel="apple-touch-icon" href="{{url('landing/images/apple-touch-icon.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{url('landing/images/apple-touch-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{url('landing/images/apple-touch-icon-114x114.png')}}">

</head>
<body>


<div id="fullpage">

    <!-- HOME SECTION -->
    @yield('content')


</div>


<!-- START VIEWPORT BORDER -->
<div class="viewport-border">
    <div class="vb-l"></div>
    <div class="vb-r"></div>
    <div class="vb-t"></div>
    <div class="vb-b"></div>
</div>
<!-- END VIEWPORT BORDER -->

<!-- JS -->
<script type="text/javascript" src="{{url('landing/js/jquery-1.11.0.min.js')}}"></script>
<script type="text/javascript" src="{{url('landing/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{url('landing/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{url('landing/js/jquery.appear.js')}}"></script>
<script type="text/javascript" src="{{url('landing/js/jquery.easing.js')}}"></script>
<script type="text/javascript" src="{{url('landing/js/jquery.fullPage.min.js')}}"></script>
@yield('scripts')
<!--add animation -->
<script src="{{url('landing/js/TweenLite.min.js')}}"></script>
<script src="{{url('landing/js/EasePack.min.js')}}"></script>
<script src="{{url('landing/js/demo-1.js')}}"></script>
<script src="{{url('landing/js/demo-2.js')}}"></script>


<script type="text/javascript" src="{{url('landing/js/main.js')}}"></script>


</body>
</html>