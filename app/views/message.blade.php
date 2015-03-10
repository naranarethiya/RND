@if(Session::has('error'))
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<ul>{{ Session::get('error') }}</ul>
	</div>
@endif

@if(Session::has('success'))
	<div class="alert alert-success alert-dismissable"> 
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<ul>{{ Session::get('success') }}</ul>
	</div>
@endif

<?php
	$errorsAll=$errors->all();
 	if(count($errors) > 0) { 
?>
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<ul>
			@foreach($errorsAll as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
<?php } ?>