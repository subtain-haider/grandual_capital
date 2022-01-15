@extends('admin.layouts.layout')
@section('title', 'Categories')
@section('content')

<div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('dashboard') }}" class="btn btn-default"><i class="las la-home"></i></a>
        <a href="{{ route('admin.categories') }}" class="btn btn-default">Categories</a>
    </div>
</div>


@if($data->count() >= 1)
<section class="cpcategories-list">
	@foreach ($data as $row)
		@php
    		$rowArr = ($row->ad_show == "on") ? ['status' => 'Enabled', 'class' => 'enabledtext']  : ['status' => 'Disabled', 'class' => 'text-secondary'];
		@endphp
        <div class="cpcatitem">
        	<div class="minimalflex fxcenter">
        		<div class="cpcaticon minimalflex">
            		{!! $row->icon !!}
            	</div>
            	<div class="cpcattitle">
            		{{ $row->title }}
           	 	</div>
           	 	<div class="cp_catedit">
            		<a href="{{ route('admin.categories.edit',[$row->id]) }}" class="btn btn-outline-primary btn-sm">
            			<i class="las la-edit"></i>
					</a>
            		<a href="{{ route('admin.categories.delete',[$row->id]) }}" class="btn btn-outline-danger btn-sm">
            			<i class="las la-times"></i>
					</a>
            	</div>
            </div>
            <div class="cpcats-bottom minimalflex">
            	<div>
                	<i class="{{ $rowArr['class'] }} las la-ad"></i> {{ $rowArr['status'] }}
                </div>
                <div>
                	<i class="text-primary las la-comment-alt"></i> {{ count_mtc($row->id) }}
                </div>
                <div>
                	<i class="text-danger las la-comments"></i> {{ posts_incategory($row->id) }}
                </div>
            </div>
        </div>
    
	@endforeach


</section>
@endif

<!-- start pagination -->
<nav class="pagination-body mt-1 ml-0 mr-0">
    <ul class="pagination justify-content-center">
        {!! $data->links() !!}
    </ul>
</nav>
<!-- end pagination -->

@endsection