@extends('admin.layouts.layout')
@section('title', 'Add category')
@section('content')

<div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('dashboard') }}" class="btn btn-default"><i class="las la-home"></i></a>
        <a href="{{ route('admin.categories') }}" class="btn btn-default">Categories</a>
		<a href="{{ route('admin.categories.add') }}" class="btn btn-default">Add new</a>
    </div>
</div>

@php
	$description['checked'] = (old('description_show') == "on") ? 'checked' : '';
	$ad['checked'] = (old('ad_show') == "on") ? 'checked' : '';
	$icon = old('icon') ?: '<span class="material-icons">apps</span>';
	$rowArr = (old('ad_show') == 1) ? ['status' => 'Enabled', 'class' => 'enabledtext']  : ['status' => 'Disabled', 'class' => 'text-secondary'];
@endphp

<form action="{{ route('admin.categories.add') }}" method="POST">
	@if($err_msg != null)
    <div class="alert alert-danger" role="alert">
        {{ $err_msg }}
    </div>
    @endif
    {{ csrf_field() }}
	<div class="form-group bg-white p-3 mb-2">
		<label for="category-name">Category title:</label>
		<input type="text" name="title" class="form-control input-style {{ $errors->has('title') ? 'error' : '' }}" id="category-name" value="{{ old('title') }}" placeholder="Enter category title..." required="">
	</div>
	@error('title')
		<span class="invalid-feedback" style="display:block !important;" role="alert">
			<strong>{{ $message }}</strong>
		</span>
	@enderror



	<div class="form-group bg-white p-3 mb-2">
		<label for="description">Description (Not required):</label>
		<textarea name="description" class="form-control" rows="4" id="description" placeholder="Put description here...">{{ old('description') }}</textarea>
	</div> 

	<div class="form-group bg-white p-3 mb-2">
		<label for="cp_caticon_input">Category icon:</label>
		<textarea name="icon" class="form-control" rows="1" style="height:40px !important" id="cp_caticon_input" placeholder="Enter category icon here..." required="">{{ $icon }}</textarea>
	</div>

	<div class="form-group bg-white p-3 mb-2">
		<label for="reklam_code_textarea">Advert code:</label>
		<textarea name="ad_code" class="form-control" rows="4" id="reklam_code_textarea" placeholder="Put ad code here, HTML codes are allowed...">{{ old('ad_code') }}</textarea>
	</div> 

	<div class="form-group pl-3 pr-3 mb-2">
		<div class="row">
			<div class="col bg-white p-3 mr-1">
				<label class="adsswitch">Show ads</label><br>
				<label class="switch">
					<input type="checkbox" id="adsswitch" name="ad_show" {{ $ad['checked'] }}>
					<span class="switch-slider round"></span>
				</label>
			</div>
			<div class="col bg-white p-3 ml-1">
				<label class="adsswitch">Show description</label><br>
				<label class="switch">
					<input type="checkbox" name="description_show" id="adsswitch" {{ $description['checked'] }}>
					<span class="switch-slider round"></span>
				</label>
			</div>
		</div>
	</div>
	<div class="form-group bg-white p-3 mb-5">
		<button type="submit" class="btn acidbutton text-poppins btn-block">Add</button>
	</div>
</form>

@endsection