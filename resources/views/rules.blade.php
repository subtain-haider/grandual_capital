@extends('layouts.general_layout')
@section('title', 'Therms of use')
@section('content')

<div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('home') }}" class="btn btn-default"><i class="fas fa-home"></i></a>
        <a href="{{ route('show_rules') }}" class="btn btn-default">Therms of use</a>
    </div>
</div>

<div class="all_post_items_container">
    <div class="card-header bg-white text-uppercase bold">
        Therms of use  <span class="material-icons pull-right">settings_accessibility</span>
    </div>

    <div class="card-body bg-white">
        {!! nl2br(sys_info('rules')) !!}
    </div>
</div>

@endsection