@if ( session()->has('info'))
	<div class="alert alert-info" role-"alert"><b>
		{{ session()->get('info') }}
	</b></div>
@endif
@if ( session()->has('error'))
	<div class="alert alert-danger" role-"alert"><b>
		{{ session()->get('error') }}
	</b></div>
@endif