@minify('html')
@if ( session()->has('info'))
	<div class="alert alert-info" role-"alert">
		{{ session()->get('info') }}
	</div>
@endif
@if ( session()->has('error'))
	<div class="alert alert-danger" role-"alert">
		{{ session()->get('error') }}
	</div>
@endif
@endminify