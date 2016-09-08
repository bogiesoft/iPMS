@extends('layouts.master')

@section('content')
	@include('layouts.menubar')

	<h1 class="page-header">New Project</h1>
	<div class="col-lg-7">
		<form class="form-horizontal" role="form" method="post" action="{{ route('projects.store') }}">
			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				<label for="title" class="control-label col-sm-3">Title</label>
				<div class="col-sm-9">
					<input type="text" name="title" class="form-control" id="title" value="{{ old('title') ?: '' }}">
				@if ($errors->has('title'))
					<span class="help-block">This field is required.</span>
				@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
				<label for="product" class="control-label col-sm-3">Product</label>
				<div class="col-sm-9">
					<input type="text" name="product" class="form-control" id="product" value="{{ old('product') ?: '' }}">
				@if ($errors->has('product'))
					<span class="help-block">This field is required.</span>
				@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('plan_start') ? ' has-error' : '' }}">
				<label for="plan_start" class="control-label col-sm-3">Plan Start Date</label>
				<div class="col-sm-9">
					<input type="date" name="plan_start" class="form-control" id="plan_start"  value="{{ old('plan_start') ?: '' }}">
				@if ($errors->has('plan_start'))
					<span class="help-block">This field is required.</span>
				@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('plan_end') ? ' has-error' : '' }}">
				<label for="plan_end" class="control-label col-sm-3">Plan End Date</label>
				<div class="col-sm-9">
					<input type="date" name="plan_end" class="form-control" id="plan_end" value="{{ old('plan_end') ?: '' }}">
				@if ($errors->has('plan_end'))
					<span class="help-block">This field is required.</span>
				@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('prj_group') ? ' has-error' : '' }}">
				<label for="prj_group" class="control-label col-sm-3">Project Group</label>
				<div class="col-sm-9">
					{{ iPMS\iPMS::selectProjectGroup(old('prj_group')) }}
				@if ($errors->has('prj_group'))
					<span class="help-block">This field is required.</span>
				@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('version') ? ' has-error' : '' }}">
				<label for="version" class="control-label col-sm-3">Version</label>
				<div class="col-sm-9">
					<input type="number" name="version" class="form-control" id="version" value="0" readonly>
				</div>
			</div>

			<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
				<label for="status" class="control-label col-sm-3">Status</label>
				<div class="col-sm-9">
					<select class="form-control" name="status" onFocus="this.initialSelect = this.selectedIndex;" onChange="this.selectedIndex = this.initialSelect;" readonly>
						<option value=1>신규검토</option>
					</select>
				</div>
				@if ($errors->has('status'))
					<span class="help-block">This field is required.</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
				<label for="notes" class="control-label col-sm-3">Notes</label>
				<div class="col-sm-9">
					<textarea name="notes" class="form-control" id="notes" rows="8">{{ old('notes') ?: '' }}</textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button type="submit" class="btn btn-info">등 록</button>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>
	</div>
@endsection