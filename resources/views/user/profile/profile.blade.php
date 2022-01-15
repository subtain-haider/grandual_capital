@extends('user.dashboard.app')
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
                                            <p>Complete your profile</p>
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
                                                            <form action="{{url('user/profile')}}" method="POST" enctype="multipart/form-data">
                                                                @csrf  
                                                                <div class="row">
                                                                    {{-- <div class="form-group col-md-12 mt-5 mb-5 d-flex align-items-center flex-column">
                                                                            <img src="./images/product/lg-a.jpg" style="width: 150px; height: 150px; border-radius: 50%;" >
                                                                            <div class="custom-file mt-3" style="width: auto; ">
                                                                                <input type="file" class="custom-file-input" multiple="" accept="image/*" id="customFile" hidden >
                                                                                <label class="btn btn-success" for="customFile">Change Profile</label>
                                                                            </div>
                                                                    </div> --}}
                            
                                                                    <div class="form-group col-md-6">
                                                                        <label class="form-label " >Full Name </label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="text" name="full_name" class="form-control"  value="{{$profile->full_name}}"   required> 
                                                                        </div>
                                                                    </div>
                            
                                                                    <div class="form-group col-md-6">
                                                                        <label class="form-label">Username</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="text" name="name" class="form-control" required value="{{$profile->name}}"> 
                                                                        </div>
                                                                    </div>
                            
                                                                    {{-- <div class="form-group col-md-6">
                                                                        <label class="form-label " >Old Password</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="number" class="form-control"  placeholder=" Enter old password"  required> 
                                                                        </div>
                                                                    </div>
                            
                                                                    <div class="form-group col-md-6">
                                                                        <label class="form-label" >New Password</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="number" class="form-control"  placeholder=" Enter new password "  required> 
                                                                        </div>
                                                                    </div> --}}
                            
                                                                    <div class="form-group col-md-12">
                                                                        <label class="form-label" >Email </label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="email" class="form-control" required readonly value="{{$profile->email}}"> 
                                                                        </div>
                                                                    </div>

                            
                                                                    <div class="form-group col-md-12 ">
                                                                        <button type="submit" class="btn btn-lg btn-primary">Update Profile</button>
                                                                    </div>

                                                                    <div class="form-group col-md-12 mt-5">
                                                                        <label class="form-label" >Refrence link</label>
                                                                        <div class="form-control-wrap">
                                                                            <input class="form-control" value="{{url('/register?ref_by=').$profile->ref_id}}" disabled> 
                                                                        </div>
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
