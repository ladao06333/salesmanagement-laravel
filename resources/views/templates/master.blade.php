<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title')</title>
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" type="text/css" rel="stylesheet" />
    <link href="{{asset('frontend/css/dataTables.bootstrap4.min.css')}}" type="text/css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        @section('content')
        @show
    </div>
    <script type="text/javascript" src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/dataTables.bootstrap4.min.js')}}"></script>
</body>

</html>