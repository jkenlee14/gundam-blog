@if(count($errors)>0)
	@foreach($errors->all() as $error)
	<div class="container-fluid errorcontainer">
		<div class="alert alert-danger col-md-10 col-md-offset-1 erroralert">
			{{$error}}
		</div>
	</div>
	@endforeach
@endif

@if(session('success'))
	<div class="container-fluid errorcontainer">
		<div class="alert alert-success col-md-10 col-md-offset-1 erroralert">
			{{session('success')}}
		</div>
	</div>
@endif

@if(session('error'))
	<div class="container-fluid errorcontainer">
		<div class="alert alert-danger col-md-10 col-md-offset-1 erroralert">
			{{session('error')}}
		</div>
	</div>
@endif