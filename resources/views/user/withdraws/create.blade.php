@extends('user.dashboard.app')
@section('content')
    
    @php
        $user = \Illuminate\Support\Facades\Auth::user();
    @endphp

 <!-- content @s -->

 <div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">New Request </h3>
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
                                            <form id="TypeValidation" class="form-horizontal" action="{{route('post_new_withdraws')}}" method="POST" enctype="multipart/form-data" >
                                                @csrf
                                                <h6>Available Amount: <b>(${{$user->a_cash}})</b></h6>
                                                <div class="row">
                                                    
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" >Amount</label>
                                                        
                                                        <div class="form-control-wrap">
                                                            <input  class="form-control" type="number" name="amount"  max="{{$user->a_cash}}" placeholder="Enter Withdraw Amount" required> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="default-06">Type</label>
                                                        <div class="form-control-wrap ">
                                                            <div class="form-control-select">
                                                                <select class="form-control trigger" title="Single Select" name="type" required>
                                                                    <option value="" disabled selected>Select Type</option>
                                                                    @foreach ($type as $pay)
                                                                    <option value="{{$pay->name}}">{{$pay->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="product-desc">Any Notes</label>
                                                        <div class="form-control-wrap">
                                                            <textarea  class="form-control" type="text"  name="note" placeholder="Enter Note"  required="true" ></textarea>
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label target_text" >Bitcoin Wallet or Paypal Email or Stripe Email</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" name="account"   required>
                                                        </div>
                                                    </div>
                                                        
                                                        
            
                                                    <div class="form-group col-md-12 ">
                                                        <button type="submit" class="btn btn-lg btn-primary">Save</button>
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


<!-- content @e -->


@endsection
