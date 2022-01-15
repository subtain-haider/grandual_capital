@extends('admin.layouts.layout')
@section('title', 'Delete - '.cat_info($id, 'title'))
@section('content')

<div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('dashboard') }}" class="btn btn-default"><i class="las la-home"></i></a>
        <a href="{{ route('admin.categories') }}" class="btn btn-default">Categories</a>
		<a href="{{ route('admin.categories.delete',[$id]) }}" class="btn btn-default">Delete - {{ cat_info($id, 'title') }}</a>
    </div>
</div>

@php
	$checked['save'] = (old('action-mode') == 'save') ? 'checked' : '';
	$checked['save_show'] = (old('action-mode') == 'save') ? 'block' : 'none';
	$checked['delete'] = (old('action-mode') == 'delete') ? 'checked' : '';
	
	
    $therms_text = (sys_info('ad_show') == 1) ? ['status' => 'Enabled', 'class=""']  : sys_info('rules');
@endphp

<form action="{{ route('admin.categories.delete',[$id]) }}" method="POST">
	@csrf
	<div class="alert alert-warning">
    	<strong>Warning!</strong><br> 
		If you want to delete the <a href="{{ route('admin.categories.delete',[$id]) }}" class="alert-link"> {{ cat_info($id, 'title') }} </a> category you should take into account that deleted category will not longer be restored. Also, to save the topics and posts from if after deleting the category you should checkmark radio button bellow this message "Move topics from this category to another category" and select category where to move the topics. And if you don't carry about the topics just select "Delete topics and posts from the category "</a>.
  	</div>

	<div class="custom-control custom-radio bg-white p-2 mb-2">
		<label for="category-name" class="ml-2 p-1 bold">Choose action:</label><br>
		<label class="form-check-label ml-4 mt-0 p-2">
			<input type="radio" class="form-check-input" name="action-mode" value="save" id="shouldmova" {{ $checked['save'] }}>
			Move topics from this category to another category
	  	</label>
	  	<label class="form-check-label ml-4 mt-0 p-2">
			<input type="radio" class="form-check-input" name="action-mode" value="delete" id="del_all" {{ $checked['delete'] }}>
	  		Delete topics and posts from the category
  		</label>
		@error('action-mode')
			<span class="invalid-feedback" style="display:block !important;" role="alert">
			  <strong>{{ $message }}</strong>
		  	</span>
	  	@enderror

		<br>
		<div class="ml-2 mr-2 mt-3 mb-3" id="sel_cat" style="display:{{ $checked['save_show'] }};">
		<label for="category">Choose a categori to move topics to:</label>
		<select name="categories" class="custom-select" id="category">
			@foreach ($qcats as $row)
				@php
					$checked['categories'] = (old('categories') == $row->id) ? 'selected' : '';
				@endphp
				<option value="{{ $row->id }}" {{ $checked['categories'] }}>{{ $row->title }}</option>
			@endforeach
		</select>
		@error('categories')
			<span class="invalid-feedback" style="display:block !important;" role="alert">
			  <strong>{{ $message }}</strong>
		  	</span>
	  	@enderror
	</div>
	</div>

	<div class="form-group bg-white pl-3 pr-3 mb-5">
		<div class="custom-control custom-checkbox bg-white ml-3 p-2 mb-2">
			<input type="checkbox" class="custom-control-input" id="customCheck" name="agree">
			<label class="custom-control-label" for="customCheck">I read, understand and wanna complete my action</label>
		</div>
		@error('agree')
			<span class="invalid-feedback mb-5" style="display:block !important;" role="alert">
			  <strong>{{ $message }}</strong>
		  	</span>
	  	@enderror

		<button type="submit" class="btn btn-primary txt14 pl-4 pr-4 mb-4">Submit</button>
	</div>
</form>


<script>
	$(document).ready(function(){
	  
	  $("#shouldmova").change(function(){
		//$('#shouldmova').is(':checked')
		$('#sel_cat').show();
	  });

	  $("#del_all").change(function(){
		$('#sel_cat').hide();
	  });

	});
	</script>

@endsection