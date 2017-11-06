<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/lib/select2.min.css') }}" rel="stylesheet" />

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="{{ asset('js/lib/html5shiv.min.js') }}"></script>
		<script src="{{ asset('js/lib/respond.min.js') }}"></script>
	<![endif]-->
</head>
<body>
	@include('partials.nav')
<div class="container">

	@include('partials.flash')

	@yield('content')

</div>



	<!-- Scripts -->
	<script src="{{ asset('js/lib/jquery-3.1.1.min.js') }}"></script>
	<script src="{{ asset('js/lib/bootstrap.3.3.7.min.js') }}"></script>
	<script src="{{ asset('js/lib/select2.min.js') }}"></script>

	<script>
		$('div.alert').not('.alert-important').delay(3000).slideUp(300);
		var page_name = $('.page').val();
		console.log(page_name);
		$('.navbar-nav > li').not('.navbar-right > li').each(function(i){
		    console.log(i + ": " + $(this).attr('id'));
		    if($(this).attr('id') == page_name)
			{
                $(this).addClass('active');
			}
		})
//        $(document).on('click', '.nav li a', function(e) {
//            e.preventDefault();
//            var $this = $(this);
//            $this.parent().siblings().removeClass('active').end().addClass('active');
//        });
	</script>

	@yield('footer')

</body>
</html>
