<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | E-Shopper</title>
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{url('frontend')}}/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{url('public')}}/frontend/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{url('public')}}/frontend/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed"
        href="{{url('public')}}/frontend/images/ico/apple-touch-icon-57-precomposed.png">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/rate/css/rate.css')}}">
    <script src="{{asset('frontend/rate/js/jquery-1.9.1.min.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    {{-- <script>
        $(document).ready(function(){
			//vote
			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	                $(this).prevAll().andSelf().addClass('ratings_hover');
	                // $(this).nextAll().removeClass('ratings_vote');
	            },
	            function() {
	                $(this).prevAll().andSelf().removeClass('ratings_hover');
	                // set_votes($(this).parent());
	            }
	        );

			$('.ratings_stars').click(function(){
				var Values =  $(this).find("input").val();
		        alert(Values);
		    	if ($(this).hasClass('ratings_over')) {
		            $('.ratings_stars').removeClass('ratings_over');
		            $(this).prevAll().andSelf().addClass('ratings_over');
		        } else {
		        	$(this).prevAll().andSelf().addClass('ratings_over');
		        }
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('[name="_token"]').val()
                        }
                    });
                 $.ajax({
                        type: "POST",
                        url: 'http://localhost/laravel-train/public/blog-single/vote',
                        dataType: 'JSON',
                        data: Values
                    });
		    });

		});
    </script> --}}

</head>
<!--/head-->

<body>
    @include('frontend.layouts.header')
    {{-- @include('frontend.layouts.slide') --}}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('frontend.layouts.menu-left2')
                </div>

                <div class="col-sm-9 padding-left">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>


    <script src="{{asset('frontend/js/jquery.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('frontend/js/price-range.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
</body>

</html>