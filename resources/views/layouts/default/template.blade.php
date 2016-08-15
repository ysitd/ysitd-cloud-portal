@section('title', isset($title) ? $title : 'Dashboard')
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title') | YSITD Cloud Portal</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,400italic" rel="stylesheet" type="text/css">
    <link href="{{ url("/css/app.css") }}" rel="stylesheet" type="text/css">
    <!--[if lte IE 8]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body>
<header>
@include('layouts/default/header')
@include('layouts/default/nav')
</header>
<main>
    <div class="container">
    @yield('content')
    </div>
</main>
@include('layouts/default/footer')
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/react/15.3.0/react.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/react/15.3.0/react-dom.min.js"></script>
<script defer type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/classnames/2.2.5/dedupe.min.js"></script>
<script defer src="{{ url('/js/app.min.js') }}"></script>
</body>
</html>
