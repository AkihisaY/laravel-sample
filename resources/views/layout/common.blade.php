<DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>@yield('title')</title>
<meta name="description" itemprop="description" content="@yield('description')">
<meta name="keywords" itemprop="keywords" content="@yield('keywords')">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- <link href="/css/star/layout.css" rel="stylesheet"> -->
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- <script src="{{asset('js/jquery-3.5.0.min.js')}}"></script> -->
<!-- Bootstrap -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<!-- Fontaweome -->
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
<!-- MyCss -->
<link href="{{asset('css/mystyle.css')}}" rel="stylesheet">
<!-- Code Pre -->
<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js?skin=sunburst"></script>
@yield('pageCss')
</head>
<body>

@yield('header')

<div class="contents">
    <!-- コンテンツ -->
    <div class="main">
        @yield('content')
    </div>

    <!-- 共通メニュー -->
    <div class="sub">
        @yield('submenu')
    </div>
</div>

@yield('footer')
</body>
</html>
