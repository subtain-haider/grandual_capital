@extends('user.dashboard.app')

@section('content')

<!-- content @s -->

<div class="nk-content">
  <div class="container-fluid">
      <div class="nk-content-inner">
          <div class="nk-content-body">
            @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                Account number updated successfully.
            </div>
        @endif
        @if(empty($user->p_subscription))
              <h2>Please Purchase any Subscription</h2>
          @else
              <div class="nk-block-head nk-block-head-sm">
                  <div class="nk-block-between">
                   
                      <div class="nk-block-head-content">
                          <h3 class="nk-block-title page-title">Account Numbers</h3>
                          <div class="mt-4">
                              <h5>Current Package: {{$user->p_subscription->name}} Month</h5>
                          <h5>Allowed Accounts: {{$user->p_subscription->account}}</h5>
                          </div>
                      </div><!-- .nk-block-head-content -->
                      <div class="nk-block-head-content">
                          
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
                                  <div class="card-inner ml-1 mr-1 my-1 " style="padding: 20px;">
                                    @foreach($user->accounts as $account)
                                    <form id="TypeValidation" class="form-horizontal" action="/user/accounts" method="POST" enctype="multipart/form-data" novalidate="novalidate">
                                        @csrf
                                              <div class="form-group col-md-12">
                                                  <label class="form-label" for="product-name-en">Account Number </label>
                                                  <div class="form-control-wrap">
                                                      <input  class="form-control" type="number" name="account" value="{{$account->account}}" required="true" aria-required="true" aria-invalid="false" required>
                                                      <input type="hidden" name="account_id" value="{{$account->id}}" required="true">
                                                  </div>
                                              </div>
                                              <div class="form-group col-md-12 text-right ">
                                                  <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                              </div>
                                      </form>
                                      @endforeach
                                  </div><!-- .card-inner -->
                                  
                                  </div><!-- .card-inner -->
                              </div>
                          </div><!-- .card -->                      
                      </div><!-- .col -->
                  </div><!-- .row -->
                  @endif
              </div><!-- .nk-block -->
          </div>
      </div>
  </div>
</div>


<!-- content @e -->


@endsection
