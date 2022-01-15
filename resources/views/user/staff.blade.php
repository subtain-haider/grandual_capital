@extends('layouts.general_layout')
@section('title', 'Staff Members')
@section('content')

<div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('home') }}" class="btn btn-default"><i class="fas fa-home"></i></a>
        <a href="{{ route('show_staffs') }}" class="btn btn-default">Staff Members</a>
    </div>
</div>

<div class="all_post_items_container">
    <div class="card-header bg-white text-uppercase bold">
        Administrators <span class="material-icons pull-right">admin_panel_settings</span>
    </div>

    @if($data['admins']->count() == 0)
        <div class="card-body bg-white  mb-3">
            Not found
        </div>
    @else   
    <div class="row">
		
		@foreach($data['admins'] as $user)
        <div class="col-md-4" style="margin-top: 10px;margin-bottom: 10px;">
            <div class="card m-b-30">
                <div class="card-body row">
                    <div class="col-6">
                        <a href="{{ route('user_profile',['id'=>$user->id]) }}"><img src="{{ user_info($user->id, 'avatar') }}" alt="" class="img-fluid rounded-circle w-60"></a>
                    </div>
                    <div class="col-6 card-title align-self-center mb-0">
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
                        <a href="#" class="btn btn-secondary tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-envelope"></i></a>
                    </div>
                    <ul class="social-links list-inline mb-0">
                        {!! get_user_mini_shortcuts($user->id, 3) !!}
                    </ul>
                </div>
            </div>
        </div>
        @endforeach

	</div>
    @endif


    <div class="card-header bg-white text-uppercase bold">
        Global Moderators <span class="material-icons pull-right">supervised_user_circle</span>
    </div>
    
    @if($data['global_moders']->count() == 0)
        <div class="card-body bg-white mb-3">
            Not found
        </div>
    @else   
    <div class="row">
		
		@foreach($data['global_moders'] as $user)
        <div class="col-md-4" style="margin-top: 10px;margin-bottom: 10px;">
            <div class="card m-b-30">
                <div class="card-body row">
                    <div class="col-6">
                        <a href="{{ route('user_profile',['id'=>$user->id]) }}"><img src="{{ user_info($user->id, 'avatar') }}" alt="" class="img-fluid rounded-circle w-60"></a>
                    </div>
                    <div class="col-6 card-title align-self-center mb-0">
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
                        <a href="#" class="btn btn-secondary tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-envelope"></i></a>
                    </div>
                    <ul class="social-links list-inline mb-0">
                        {!! get_user_mini_shortcuts($user->id, 3) !!}
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
        
	</div>
    @endif

    <div class="card-header bg-white text-uppercase bold">
        Moderators <span class="material-icons pull-right">face</span>
    </div>

    @if($data['moders']->count() == 0)
        <div class="card-body bg-white  mb-3">
            Not found
        </div>
    @else    
    <div class="row">
		
		@foreach($data['moders'] as $user)
        <div class="col-md-4" style="margin-top: 10px;margin-bottom: 10px;">
            <div class="card m-b-30">
                <div class="card-body row">
                    <div class="col-6">
                        <a href="{{ route('user_profile',['id'=>$user->id]) }}"><img src="{{ user_info($user->id, 'avatar') }}" alt="" class="img-fluid rounded-circle w-60"></a>
                    </div>
                    <div class="col-6 card-title align-self-center mb-0">
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
                        <a href="#" class="btn btn-secondary tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-envelope"></i></a>
                    </div>
                    <ul class="social-links list-inline mb-0">
                        {!! get_user_mini_shortcuts($user->id, 3) !!}
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
        
	</div>
    @endif

    
</div>


@endsection