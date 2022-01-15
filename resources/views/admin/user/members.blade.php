@extends('admin.layouts.layout')

@if (thisroute() == "admin.members.banneds")
    @section('title', 'Members - Banned')    
@elseif (thisroute() == "admin.members.disabled")
    @section('title', 'Members - Disabled')
@elseif (thisroute() == "admin.members.admins")
    @section('title', 'Members - Administrators')
@elseif (thisroute() == "admin.members.globalmoders")
    @section('title', 'Members - Global Moderators')
@elseif (thisroute() == "admin.members.moders")
    @section('title', 'Members - Moderators')
@else
    @section('title', 'All Members')
@endif


@section('content')

<div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('dashboard') }}" class="btn btn-default"><i class="las la-home"></i></a>
        <a href="{{ route('admin.members.all') }}" class="btn btn-default">Members</a>

        @if (thisroute() == "admin.members.banneds")
        <a href="{{ route('admin.members.banneds') }}" class="btn btn-default">Banned</a>
        
        @elseif (thisroute() == "admin.members.disabled")
        <a href="{{ route('admin.members.disabled') }}" class="btn btn-default">Disabled</a>

        @elseif (thisroute() == "admin.members.admins")
        <a href="{{ route('admin.members.admins') }}" class="btn btn-default">Administrators</a>

        @elseif (thisroute() == "admin.members.globalmoders")
        <a href="{{ route('admin.members.globalmoders') }}" class="btn btn-default">Global Moderators</a>

        @elseif (thisroute() == "admin.members.moders")
        <a href="{{ route('admin.members.moders') }}" class="btn btn-default">Moderators</a>

        @endif
    </div>
</div>

<section class="row">
    @if($users->count()>=1)

    @foreach($users as $user)
    <div class="col-md-3">
        <div class="card m-b-30 mb-2">
            <div class="card-body row">
                <div class="col-5">
                    <a href="{{ route('user_profile',['id'=>$user->id]) }}"><img src="{{ user_info($user->id, 'avatar') }}" alt="" class="img-fluid rounded-circle w-60"></a>
                </div>
                <div class="col-7 card-title align-self-center mb-0">
                    <h5>{{ user_info($user->id, 'name') }}</h5>
                    <p class="m-0">{{ level($user->id) }}</p>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><i class="fa fa-envelope float-right"></i>Email : <a href="mailto:{{ user_info($user->id, 'email') }}">{{ user_info($user->id, 'email') }}</a></li>
                <li class="list-group-item"><i class="far fa-calendar-check float-right"></i>Joined : {{ humman_date(user_info($user->id, 'created_at')) }}</li>
            </ul>
            <div class="card-body">
                <div class="float-right btn-group btn-group-sm">
                    <a href="{{ route('user_profile',['id'=>$user->id]) }}" title="Visit profile" class="btn btn-primary tooltips"><i class="far fa-user"></i></a>
                    
                    <a href="{{ pmlink($user->id) }}" title="Private message" class="btn btn-secondary tooltips"><i class="fa fa-envelope"></i></a>

                    @if(user_info($user->id, 'owner') == 0)
                    <a href="{{ route('UserModSettings',[$user->id]) }}" title="Settings" class="btn btn-info tooltips"><i class="las la-cog"></i></a>

                    <a href="{{ route('admin.member.delete',[$user->id]) }}" title="Delete" class="btn btn-danger tooltips"><i class="las la-times"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @else
    <div class="card-body bg-white ml-3 mr-3 mb-3">
        Users not found
    </div>
    @endif
   
</section>

@if($count > $max_perpage)
    <!-- start pagination -->
    <nav class="pagination-body">
        <ul class="pagination justify-content-center">
            {!! $users->links() !!}
        </ul>
    </nav>
    <!-- end pagination -->
@endif

@endsection