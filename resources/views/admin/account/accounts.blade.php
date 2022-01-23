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
                                          <h3 class="nk-block-title page-title">PayPal </h3>
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
                                                        <form id="TypeValidation" class="form-horizontal" action="/setting_update" method="POST" enctype="multipart/form-data" novalidate="novalidate">
                                                          @csrf
                                                              <div class="row">
                                                                  <div class="form-group col-md-12">
                                                                      <label class="form-label" >Client Key</label>
                                                                      <div class="form-control-wrap">
                                                                          <input  class="form-control"  type="text" name="p_client" value="{{$setting->p_client}}" required="true" aria-required="true" aria-invalid="false"> 
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group col-md-12">
                                                                      <label class="form-label" >Secret Key</label>
                                                                      <div class="form-control-wrap">
                                                                          <input  class="form-control" type="text" name="p_secret" value="{{$setting->p_secret}}" required="true" aria-required="true" aria-invalid="false"> 
                                                                      </div>
                                                                  </div>
{{--                                                                  <div class="form-group col-md-12">--}}
{{--                                                                      <label class="form-label" >App ID</label>--}}
{{--                                                                      <div class="form-control-wrap">--}}
{{--                                                                          <input  class="form-control" type="text" name="app_id" value="{{$setting->app_id}}" required="true" aria-required="true" aria-invalid="false">--}}
{{--                                                                      </div>--}}
{{--                                                                  </div>--}}
                                                                  <div class="form-group col-md-12">
                                                                      <label class="form-label" for="default-06">Payment Mode</label>
                                                                      <div class="form-control-wrap ">
                                                                          <div class="form-control-select">
                                                                              <select class="form-control" data-style="btn btn-rose btn-round" title="Single Select" name="p_mode" required>
                                                                                  <option disabled selected>Select Status</option>
                                                                                  <option value="sandbox" @if($setting->p_mode == 'sandbox') selected @endif >Sandbox</option>
                                                                                  <option value="live" @if($setting->p_mode == 'live') selected @endif>Live</option>
                                                                              </select>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                      <div class="form-group col-md-12">
                                                                          <label class="form-label" for="default-06">Status</label>
                                                                          <div class="form-control-wrap ">
                                                                              <div class="form-control-select">
                                                                                  <select class="form-control"data-style="btn btn-rose btn-round" title="Single Select" name="p_status">
                                                                                      <option disabled selected>Select Status</option>
                                                                                      <option value="1" @if($setting->p_status == '1') selected @endif >Enable</option>
                                                                                      <option value="0" @if($setting->p_status == '0') selected @endif>Disable</option>
                                                                                  </select>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                          
                                                                  <div class="form-group col-md-12 ">
                                                                      <button type="submit" class="btn btn-lg btn-primary">UPDATE</button>
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

               <!-- content @s -->

               <div class="nk-content">
                  <div class="container-fluid">
                      <div class="nk-content-inner">
                          <div class="nk-content-body">
                              <div class="nk-block-head nk-block-head-sm">
                                  <div class="nk-block-between">
                                      <div class="nk-block-head-content">
                                          <h3 class="nk-block-title page-title">Bitcoin </h3>
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
                                                        <form id="TypeValidation" class="form-horizontal" action="/setting_update" method="POST" enctype="multipart/form-data" novalidate="novalidate">
                                                          @csrf
                                                           <div class="row">
                                                                  <div class="form-group col-md-12">
                                                                      <label class="form-label" >Account ID</label>
                                                                      <div class="form-control-wrap">
                                                                          <input  class="form-control"   type="text" name="b_client" value="{{$setting->b_client}}" required="true" aria-required="true" aria-invalid="false"> 
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group col-md-12">
                                                                      <label class="form-label" >Profile ID</label>
                                                                      <div class="form-control-wrap">
                                                                          <input  class="form-control" type="text" name="b_secret" value="{{$setting->b_secret}}" required="true" aria-required="true" aria-invalid="false"> 
                                                                      </div>
                                                                  </div>
                                                                      <div class="form-group col-md-12">
                                                                          <label class="form-label" for="default-06">Status</label>
                                                                          <div class="form-control-wrap ">
                                                                              <div class="form-control-select">
                                                                                  <select class="form-control" data-style="btn btn-rose btn-round" title="Single Select" name="b_status">
                                                                                    <option disabled selected>Select Status</option>
                                                                                    <option value="1" @if($setting->b_status == '1') selected @endif>Enable</option>
                                                                                    <option value="0" @if($setting->b_status == '0') selected @endif>Disable</option>
                                                                                  </select>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                          
                                                                  <div class="form-group col-md-12 ">
                                                                      <button type="submit" class="btn btn-lg btn-primary">UPDATE</button>
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

              <!-- content @s -->

              <div class="nk-content">
                  <div class="container-fluid">
                      <div class="nk-content-inner">
                          <div class="nk-content-body">
                              <div class="nk-block-head nk-block-head-sm">
                                  <div class="nk-block-between">
                                      <div class="nk-block-head-content">
                                          <h3 class="nk-block-title page-title">Stripe</h3>
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
                                                        <form id="TypeValidation" class="form-horizontal" action="/setting_update" method="POST" enctype="multipart/form-data" novalidate="novalidate">
                                                          @csrf
                                                              <div class="row">
                                                                  <div class="form-group col-md-12">
                                                                      <label class="form-label" >Client Key</label>
                                                                      <div class="form-control-wrap">
                                                                          <input class="form-control"  type="text" name="s_client" required="true" value="{{$setting->s_client}}" aria-required="true" aria-invalid="false"> 
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group col-md-12">
                                                                      <label class="form-label" >Secret Key</label>
                                                                      <div class="form-control-wrap">
                                                                          <input  class="form-control"  type="text" name="s_secret" required="true" value="{{$setting->s_secret}}" aria-required="true" aria-invalid="false"> 
                                                                      </div>
                                                                  </div>
                                                                      <div class="form-group col-md-12">
                                                                          <label class="form-label" for="default-06">Status</label>
                                                                          <div class="form-control-wrap ">
                                                                              <div class="form-control-select">
                                                                                  <select class="form-control" data-style="btn btn-rose btn-round" title="Single Select" name="s_status">
                                                                                    <option disabled selected>Select Status</option>
                                                                                    <option value="1" @if($setting->s_status == '1') selected @endif>Enable</option>
                                                                                    <option value="0" @if($setting->s_status == '0') selected @endif>Disable</option>
                                                                                  </select>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                          
                                                                  <div class="form-group col-md-12 ">
                                                                      <button type="submit" class="btn btn-lg btn-primary">UPDATE</button>
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
