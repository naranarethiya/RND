<meta charset="UTF-8">
<title>
	@if(isset($pageTitle))
		{{$pageTitle}}
	@else
		Salon management
	@endif
</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />

{{-- to load css in header pass url of css in $loadCss variable as array --}}
@if(isset($loadCss))
	@if(is_array($loadCss))
		@foreach($$loadCss as $css)
			<link href="{{$css}}" rel="stylesheet" type="text/css" />
		@endforeach
	@endif
@endif

<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
