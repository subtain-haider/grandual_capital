@extends('admin.layouts.layout')
@section('title', 'Delete '.$users[0]['name'])
@section('content')

<div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('dashboard') }}" class="btn btn-default"><i class="las la-home"></i></a>
        <a href="{{ route('admin.members.all') }}" class="btn btn-default">Members</a>
        <a href="{{ route('admin.member.delete',[$id]) }}" class="btn btn-default">Delete - <b>{{ $users[0]['name'] }}</b></a>
    </div>
</div>

<style>
    @media(min-width: 950px){
        .userdelete-container{
            display: flex; 
            flex-wrap: wrap;
        }
        .userdelete-container .card{
            max-width: 300px;
        }
        .deleteuser-right{
            width: calc(100% - 320px);
            overflow-x: hidden;
        }
    }
</style>
<form action="{{ route('admin.member.delete',[$id]) }}" method="POST">
    @csrf
    <section class="userdelete-container">
        <div class="card m-b-30 mb-2 bg-white mr-3">
            <div class="card-body row">
                <div class="col-5">
                    <a href="{{ route('user_profile',['id'=>$id]) }}"><img src="{{ user_info($id, 'avatar') }}" alt="{{ user_info($id,'name') }}" class="img-fluid rounded-circle w-60"></a>
                </div>
                <div class="col-7 card-title align-self-center mb-0">
                    <h5>{{ user_info($id,'name') }}</h5>
                    <p class="m-0">{{ level($id) }}</p>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><i class="fa fa-envelope float-right"></i>Email : <a href="mailto:{{ user_info($id, 'email') }}">{{ user_info($id, 'email') }}</a></li>
                <li class="list-group-item"><i class="far fa-calendar-check float-right"></i>Joined : {{ humman_date(user_info($id, 'created_at')) }}</li>
            </ul>
            <div class="card-body">
                <div class="float-right btn-group btn-group-sm">
                    <a href="{{ route('user_profile',['id'=>$id]) }}" title="Visit profile" class="btn btn-primary tooltips"><i class="far fa-user"></i></a>
                    
                    <a href="{{ pmlink($id) }}" title="Private message" class="btn btn-secondary tooltips"><i class="fa fa-envelope"></i></a>

                    @if(user_info($id, 'owner') == 0)
                    <a href="{{ route('UserModSettings',[$id]) }}" title="Settings" class="btn btn-info tooltips"><i class="las la-cog"></i></a>

                    <a href="{{ route('admin.member.delete',[$id]) }}" title="Delete" class="btn btn-danger tooltips"><i class="las la-times"></i></a>
                    @endif
                </div>
            </div>
        </div>

        <div class="deleteuser-right bg-white">
            <div class="p-3">
                <div class="alert alert-warning">
                    <strong>Warning!</strong><br> 
                    If you want to delete user <a href="{{ route('user_profile',['id'=>$id]) }}" class="alert-link"> {{ user_info($id,'name') }} </a> you should take into account that deleted user will not longer be restored.
                </div>
            </div>
            <div class="custom-control custom-checkbox mb-3 ml-4">
                <input type="checkbox" class="custom-control-input" id="customCheck" name="agreeDeleteUser" required="">
                <label class="custom-control-label" for="customCheck">I read this and wanna complete my action </label>
            </div>
            @error('agreeDeleteUser')
			    <span class="invalid-feedback ml-4 mr-4 mb-4" style="display:block !important;" role="alert">
			        <strong>{{ $message }}</strong>
		  	    </span>
	  	    @enderror
            <div class="custom-control custom-checkbox mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </section>
    
    
  </form>

@endsection