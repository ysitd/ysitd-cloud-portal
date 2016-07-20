<!doctype html>
<html>
@section('title', $title)
<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" name="viewport">
    <title> @yield('title') | YSITD Cloud Portal</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,400italic" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/css/portal.min.css" type="text/css">
    <!--[if lte IE 8]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
</head>

<body class="page-brand">
@include('layouts/nav')
@include('layouts/header')
<main class="content">
    <div class="content-header ui-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1">
                    <h1 class="content-heading">{{$title}}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @section('content')@endsection
    </div>
</main>
@include('layouts/footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.2.1/react.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.2.1/react-dom.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/classnames/2.2.5/dedupe.min.js"></script>
<script src="/js/vendor.min.js"></script>
<script src="/js/app.min.js"></script>
@section('scripts')@endsection
</body>

</html>