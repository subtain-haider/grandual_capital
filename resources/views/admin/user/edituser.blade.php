@extends('admin.app')

@section('content')



<!-- content @s -->

<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Profile </h3>
{{--                            <p>Complete your profile</p>--}}
                        </div><!-- .nk-block-head-content -->
                       
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-xxl-12">
                                <div class="col-12 div_alert">
                                </div>
                                <div class="card card-full">
                                    <div class="nk-ecwg nk-ecwg8 h-100">
                                        <div class="card-inner ml-1 mr-1 my-1">
                                            <form id="TypeValidation" class="form-horizontal" action="{{ url('admin/users/update',$user->id) }}" method="POST"
                                                enctype="multipart/form-data" novalidate="novalidate">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-12 mt-5 mb-5 d-flex align-items-center flex-column">
                                                            <img src="{{$user->image != null?url('/').'/users/'.$user->image:asset('assets/admin/img/default-avatar.png')}}" alt="{{$user->image}}" style="width: 150px; height: 150px; border-radius: 50%;" >
                                                            <div class="custom-file mt-3" style="width: auto; ">
                                                                <input class="mt-" type="file" name="image"  hidden>
                                                                <label class="btn btn-success" style="margin-bottom: 0px !important" for="customFile" >Change Profile</label>

                                              <a href="#pablo" class="btn btn-danger " data-dismiss="fileinput" >Remove</a>
                                                            </div>
                                                    </div>
            
{{--                                                    <div class="form-group col-md-6">--}}
{{--                                                        <label class="form-label " >Full Name </label>--}}
{{--                                                        <div class="form-control-wrap">--}}
{{--                                                            <input  class="form-control" type="text" name="full_name" class="form-control" required value="{{$user->full_name}}""> --}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" >Email </label>
                                                        <div class="form-control-wrap">
                                                            <input type="email" class="form-control" required name="email" value="{{$user->email}}">
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label">Name</label>
                                                        <div class="form-control-wrap">
                                                            <input  class="form-control" type="text" name="name" class="form-control" required value="{{$user->name}}"> 
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label " >Old Password</label>
                                                        <div class="form-control-wrap">
                                                            <input  type="text" class="form-control" placeholder="Please enter old password" name="old_password"> 
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" >New Password</label>
                                                        <div class="form-control-wrap">
                                                            <input  type="text" class="form-control" name="new_password"  placeholder=" Enter new password "  > 
                                                        </div>
                                                    </div>
            


            
                                                    <div class="form-group col-md-12 ">
                                                        <button type="submit" class="btn btn-lg btn-primary">Update Profile</button>
                                                    </div>
                                                </div>
                                            </form>
                                    </div><!-- .card-inner -->
                                </div>
                            </div><!-- .card -->                      
                        </div><!-- .col -->
                    </div><!-- .row -->


                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
    
    
@endsection
