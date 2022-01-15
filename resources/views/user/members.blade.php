@extends('layouts.general_layout')
@section('title', 'Members')
@section('content')

<div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('home') }}" class="btn btn-default"><i class="fas fa-home"></i></a>
        <a href="{{ route('member_list') }}" class="btn btn-default">Members</a>
    </div>
</div>

<div class="all_post_items_container">
    <div class="card-header bg-white text-uppercase bold">
        Members  <span class="material-icons pull-right">people_alt</span>
    </div>
<div class="row">
    
    @if($users->count()>=1)

    @foreach($users as $user)
    <div class="col-md-4" style="margin-top: 10px;margin-bottom: 10px;">
        <div class="card m-b-30">
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
                    <a href="{{ route('user_profile',['id'=>$user->id]) }}" class="btn btn-primary tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit"><i class="far fa-user"></i> View Profile</a>
                    <a href="{{ pmlink($user->id) }}" class="btn btn-secondary tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-envelope"></i></a>
                </div>
                <ul class="social-links list-inline mb-0">
                    {!! get_user_mini_shortcuts($user->id, 3) !!}
                </ul>
            </div>
        </div>
    </div>
    @endforeach

    @else
    <div class="card-body bg-white ml-3 mr-3 mb-3">
        Users not found
    </div>
    @endif
   
</div>

@if($users->count() > $max_perpage)
    <!-- start pagination -->
    <nav class="pagination-body">
        <ul class="pagination justify-content-center">
            {!! $users->links() !!}
        </ul>
    </nav>
    <!-- end pagination -->
@endif
</div>
@endsection