<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel | {{ config('app.name') }} </title>
    <!-- favicon !-->
    <link rel="icon" href="{{ url('images/favicon.png') }}">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ url('adminpanel/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminpanel/css/animate.min.css') }}">
    <!-- App styles -->
    <link rel="stylesheet" href="{{ url('adminpanel/css/app.min1.css') }}">
</head>
<body data-sa-theme="7">
    <!-- Login -->
    <div class="login exchnageplt">
        <div align="center">
            <img src="{{ url('images/logo12.svg') }}" class="logo-text" />
            <div class="orderbookloginbg">
                <div class="orderboxlog">
                    <h4 class="h4">Exchange Platform</h4>
                    <img src="{{ url('/adminpanel/img/exchange.svg') }}" />
                    <div class="userbtn">
                        <a href="{{url('exchangelogin')}}" class="btn btn-primary">Login</a>
                    </div>
                </div>
                <div class="orderboxlog orderboxlog1">
                    <h4 class="h4">User to Admin</h4>
                    <img src="{{ url('/adminpanel/img/usertoadmin.svg') }}" />
                    <div class="userbtn">
                        <a href="#" class="btn btn-primary">Login</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="{{ url('adminpanel/js/jquery.min.js') }}"></script>
    <script src="{{ url('adminpanel/js/popper.min.js') }}"></script>
    <script src="{{ url('adminpanel/js/bootstrap.min.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ url('adminpanel/js/app.min.js') }}"></script>
</body>
</html>

<script>
  $(document).ready(function(){
    $('form').attr('autocomplete', 'off');
});
</script>