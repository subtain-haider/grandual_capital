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
                          <h3 class="nk-block-title page-title">Affiliation Setting </h3>
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
                                        <form id="TypeValidation" class="form-horizontal" action="{{url('admin/affiliation')}}" method="POST" enctype="multipart/form-data" >
                                          @csrf
                                              <div class="row">
                                                  <div class="form-group col-md-12">
                                                      <label class="form-label" >Percentage</label>
                                                      <div class="form-control-wrap">
                                                          <input  class="form-control"   type="number" value="{{$affiliation->percentage}}" name="percentage" required="true"> 
                                                      </div>
                                                  </div>
                                                      <div class="form-group col-md-12">
                                                          <label class="form-label" for="default-06">Recurring</label>
                                                          <div class="form-control-wrap ">
                                                              <div class="form-control-select">
                                                                  <select class="form-control" data-style="btn btn-rose btn-round" title="Single Select" name="recurring">
                                                                      <option value="Enable" @if($affiliation->recurring == 'Enable') selected @endif>Enable</option>
                                                                      <option value="Disable" @if($affiliation->recurring == 'Disable') selected @endif>Disable</option>
                                                                    
                                                                  </select>
                                                              </div>
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
