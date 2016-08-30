@extends('layouts.master')

@section('content')
@include('layouts.menubar')
<div class="main">
	<h1 class="page-header">New Project</h1>

	<div class="col-lg-6">
		<form class="form-horizontal" role="form" method="post" action="{{ route('projects.store') }}">
			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				<label for="title" class="control-label col-sm-3">Title</label>
				<div class="col-sm-9">
					<input type="text" name="title" class="form-control" id="title" value="{{ old('title') ?: '' }}">
				</div>
				@if ($errors->has('title'))
					<span class="help-block">This field is required.</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
				<label for="product" class="control-label col-sm-3">Product</label>
				<div class="col-sm-9">
					<input type="text" name="product" class="form-control" id="product" value="{{ old('product') ?: '' }}">
				</div>
				@if ($errors->has('product'))
					<span class="help-block">This field is required.</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('plan_start') ? ' has-error' : '' }}">
				<label for="plan_start" class="control-label col-sm-3">Plan Start Date</label>
				<div class="col-sm-9">
					<input type="date" name="plan_start" class="form-control" id="plan_start">
				</div>
				@if ($errors->has('plan_start'))
					<span class="help-block">This field is required.</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('plan_end') ? ' has-error' : '' }}">
				<label for="plan_end" class="control-label col-sm-3">Plan End Date</label>
				<div class="col-sm-9">
					<input type="date" name="plan_end" class="form-control" id="plan_end">
				</div>
				@if ($errors->has('plan_end'))
					<span class="help-block">This field is required.</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
				<label for="level" class="control-label col-sm-3">Project Level</label>
				<div class="col-sm-9">
					<select class="form-control" name="level" id="level">
						<option value=1 <?php if(old('level')==1) echo 'selected'; ?>>PM1</option>
						<option value=2 <?php if(old('level')==2) echo 'selected'; ?>>PM2</option>
						<option value=3 <?php if(old('level')==3) echo 'selected'; ?>>PM3</option>
						<option value=4 <?php if(old('level')==4) echo 'selected'; ?>>설계변경</option>
						<option value=10 <?php if(old('level')==10) echo 'selected'; ?>>상품도입</option>
						<option value=99 <?php if(old('level')==99) echo 'selected'; ?>>기 타</option>
					</select>
				</div>
			</div>

			<div class="form-group{{ $errors->has('version') ? ' has-error' : '' }}">
				<label for="version" class="control-label col-sm-3">Version</label>
				<div class="col-sm-9">
					<input type="number" name="version" class="form-control" id="version" min="0" value="{{ old('version') ?: 0 }}" readonly>
				</div>
			</div>

			<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
				<label for="status" class="control-label col-sm-3">Status</label>
				<div class="col-sm-9">
					<select class="form-control" name="status" id="status" onFocus="this.initialSelect = this.selectedIndex;" onChange="this.selectedIndex = this.initialSelect;" readonly>
						<option value=0>계획/검토</option>
					</select>
				</div>
				@if ($errors->has('status'))
					<span class="help-block">This field is required.</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('pm_id') ? ' has-error' : '' }}">
				<label for="pm_id" class="control-label col-sm-3">Projet Manager</label>
				<div class="col-sm-9">
					<select class="form-control" name="pm_id" id="pm_id">
					</select>
				</div>
				@if ($errors->has('pm_id'))
					<span class="help-block">This field is required.</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('master_id') ? ' has-error' : '' }}">
				<label for="master_id" class="control-label col-sm-3">Master Projet</label>
				<div class="col-sm-9">
					<select class="form-control" name="master_id" id="master_id">
					</select>
				</div>
				@if ($errors->has('master_id'))
					<span class="help-block">This field is required.</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
				<label for="group" class="control-label col-sm-3">Group Tag</label>
				<div class="col-sm-9">
					<input name="group" class="form-control" id="group" min="0" value="{{ old('group') ?: '' }}">
				</div>
			</div>

			<div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
				<label for="notes" class="control-label col-sm-3">Notes</label>
				<div class="col-sm-9">
					<textarea name="notes" class="form-control" id="notes" rows="8" cols="10">
					{{ old('notes') ?: '' }}
					</textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button type="submit" class="btn btn-info">Create</button>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>
	</div>
</div>
@stop
