<!DOCTYPE html>
<html lang="en">
<head>
	@include('head.php')
</head>

<body class="skin-blue fixed">
	@include('header.php');
	<div class="wrapper row-offcanvas row-offcanvas-left">
		@include('sidebar.php')
		<aside class="right-side">
			<section class="content-header">
				<h1>
					Blank page
					<small>it all starts here</small>
				</h1>
			</section>
			<section class="content">


			</section>
		</aside>
	</div>
	<script type="text/javascript">
		var base_url = "{{ URL::to('/') }}/";
	</script>
	<script src="{{URl::to('js/jquery.min.js')}}"></script>
	<!-- Bootstrap -->
	<script src="{{URl::to('js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{URl::to('js/app.js')}}" type="text/javascript"></script>
	
	{{-- to load javascript file pass url of css in $loadJs variable as array --}}
	@if(isset($loadJs))
		@if(is_array($loadJs))
			@foreach($loadJs as $js)
				<script type="text/javascript" src="{{$js}}"></script>
			@endforeach
		@endif
	@endif
</body>
</html>