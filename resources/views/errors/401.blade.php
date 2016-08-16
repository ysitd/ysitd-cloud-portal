<!DOCTYPE html>
<html>
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
    <style>
        footer,main{padding: 0;}
        main{margin: 0;}
        body{background-color: #44A148;}
        footer{position: relative;border-top:1px white solid;}
        img {width: auto;height: 300px; margin: 10px auto}
    </style>
</head>
<body>
<main>
    <div class="container">
        <div class="row">
            <div class="col l6 m12 s24">
                <h1 class="white-text">Signin Required</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col m12 s24">
                <div class="card medium z-depth-5">
                    <div class="card-content text-strong">
                        <p>
                            You have to sign in to continue using.
                        </p>
                        <div class="card-image">
                            <img src="{{ url('images/sitcon-lady.png') }}" style="width: auto;height: 300px;">
                        </div>
                    </div>
                    <div class="card-action">
                        <a href="{{ route('auth.signin') }}" class="waves-effect waves-light btn">Sign in</a>
                        <a href="{{ url('auth/register') }}" class="waves-effect waves-light btn">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6 s18">
                <h4 class="text-white white-text left">YSITD Cloud Portal</h4>
            </div>
            <div class="col l6 s18">
                <a href="https://github.com/ysitd/ysitd-cloud-portal" class="right">
                    <span class="fa fa-github fa-3x"></span>
                </a>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            &copy; 2016 YSITD
        </div>
    </div>
</footer>
</body>
</html>
