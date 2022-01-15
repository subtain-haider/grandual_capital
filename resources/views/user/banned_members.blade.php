@extends('layouts.general_layout')
@section('title', 'Banned Members')
@section('content')

<div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('home') }}" class="btn btn-default"><i class="fas fa-home"></i></a>
        <a href="{{ route('member_list') }}" class="btn btn-default">Banned Members</a>
    </div>
</div>

<div class="all_post_items_container">
    <div class="card-header bg-white text-uppercase bold">
        Banned Members  <span class="material-icons pull-right">person_off</span>
    </div>
<div class="row">
    
    @if($users->count()>=1)

    @foreach($users as $user)
    <div class="col-md-4" style="margin-top: 10px;margin-bottom: 10px;">
        <div class="card m-b-30">
            <div class="card-body row">
                <div class="col-6">
                    <a href="{{ route('user_profile',['id'=>$user->user_id]) }}"><img src="{{ user_info($user->user_id, 'avatar') }}" alt="" class="img-fluid rounded-circle w-60"></a>
                </div>
                <div class="col-6 card-title align-self-center mb-0">
                    <h5>{{ user_info($user->user_id, 'name') }}</h5>
                    <p class="m-0">{{ level($user->user_id) }}</p>
                </div>
            </div>
            <div class="p-2 alert-danger" style="font-size: 14px;">
                Banned for Violation of the rules. Till {{ $user->banned_till }}
            </div>
            <div class="card-body">
                <div class="float-right btn-group btn-group-sm">
                    <a href="{{ route('user_profile',['id'=>$user->user_id]) }}" class="btn btn-primary tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit"><i class="far fa-user"></i> View Profile</a>
                    <a href="#" class="btn btn-secondary tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-envelope"></i></a>
                </div>
                <ul class="social-links list-inline mb-0">
                    {!! get_user_mini_shortcuts($user->user_id, 3) !!}
                </ul>
            </div>
        </div>
    </div>
    @endforeach

    @else
        <div class="container">
        <div class="card-body bg-white  mb-3">
            Not found
        </div>
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