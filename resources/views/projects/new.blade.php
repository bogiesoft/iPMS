@extends('layouts.master')

@section('content')
@include('layouts.menubar')
<div class="main">
	<h1 class="page-header">New Project</h1>

	<div class="col-lg-6">
		<form class="form-horizontal" role="form" method="post" action="{{ route('projects.store') }}">
			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				<label for="title" class="control-label col-sm-2">Title</label>
				<div class="col-sm-10">
					<input type="text" name="title" class="form-control" id="title" value="{{ old('title') ?: '' }}">
				</div>
				@if ($errors->has('title'))
					<span class="help-block">This field is required.</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
				<label for="product" class="control-label col-sm-2">Product</label>
				<div class="col-sm-10">
					<input type="text" name="product" class="form-control" id="product" value="{{ old('product') ?: '' }}">
				</div>
				@if ($errors->has('product'))
					<span class="help-block">This field is required.</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
				<label for="start_date" class="control-label col-sm-2">Start Date</label>
				<div class="col-sm-10">
					<input type="date" name="start_date" class="form-control" id="start_date">
				</div>
				@if ($errors->has('start_date'))
					<span class="help-block">This field is required.</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
				<label for="end_date" class="control-label col-sm-2">End Date</label>
				<div class="col-sm-10">
					<input type="date" name="end_date" class="form-control" id="end_date">
				</div>
				@if ($errors->has('end_date'))
					<span class="help-block">This field is required.</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('version') ? ' has-error' : '' }}">
				<label for="version" class="control-label col-sm-2">Version</label>
				<div class="col-sm-10">
					<input type="number" name="version" class="form-control" id="version" min="0" value="{{ old('version') ?: '' }}">
				</div>
			</div>

			<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
				<label for="status" class="control-label col-sm-2">Status</label>
				<div class="col-sm-10">
					<select class="form-control" name="status" id="status">
						<option value="Upcoming">계 획</option>
						<option value="Planning">기획중</option>
						<option value="Active">진행중</option>
						<option value="Completed">완 료</option>
						<option value="Canceled">취 소</option>
						<option value="Deleted">삭 제</option>
					</select>
				</div>
				@if ($errors->has('status'))
					<span class="help-block">This field is required.</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('pm_id') ? ' has-error' : '' }}">
				<label for="pm_id" class="control-label col-sm-2">Projet Manager</label>
				<div class="col-sm-10">
					<select class="form-control" name="pm_id" id="pm_id">
					</select>
				</div>
				@if ($errors->has('pm_id'))
					<span class="help-block">This field is required.</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('master_id') ? ' has-error' : '' }}">
				<label for="master_id" class="control-label col-sm-2">Master Projet</label>
				<div class="col-sm-10">
					<select class="form-control" name="master_id" id="master_id">
					</select>
				</div>
				@if ($errors->has('master_id'))
					<span class="help-block">This field is required.</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
				<label for="notes" class="control-label col-sm-2">Notes</label>
				<div class="col-sm-10">
					<textarea name="notes" class="form-control" id="notes" rows="8" cols="10">
					{{ old('notes') ?: '' }}
					</textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-info">Create</button>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>
	</div>
</div>
@stop
