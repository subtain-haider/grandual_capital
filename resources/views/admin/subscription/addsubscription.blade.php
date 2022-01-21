@extends('admin.app')

@section('content')

<!-- content s -->

<div class="nk-content">
  <div class="container-fluid">
      <div class="nk-content-inner">
          <div class="nk-content-body">
              <div class="nk-block-head nk-block-head-sm">
                  <div class="nk-block-between">
                      <div class="nk-block-head-content">
                          <h3 class="nk-block-title page-title">Add Subscription </h3>
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
                                        <form id="TypeValidation" class="form-horizontal" action="{{route('subscription.store')}}" method="POST" enctype="multipart/form-data" >
                                          @csrf
                                              <div class="row">
                                                  <div class="form-group col-md-6">
                                                      <label class="form-label" >Subscription Name</label>
                                                      <div class="form-control-wrap">
                                                          <input type="text" name="text" required="true" aria-required="true" aria-invalid="false" class="form-control"  placeholder="Enter Subscription Name" required> 
                                                      </div>
                                                  </div>
          
                                                  <div class="form-group col-md-6">
                                                      <label class="form-label " >Duration in Months </label>
                                                      <div class="form-control-wrap">
                                                          <input type="number" name="name" required="true" aria-required="true" aria-invalid="false" class="form-control"  placeholder=" Duration in Months "  required> 
                                                      </div>
                                                  </div>
          
                                                  <div class="form-group col-md-6">
                                                      <label class="form-label">First month price</label>
                                                      <div class="form-control-wrap">
                                                          <input type="number" name="price" required="true" aria-required="true" aria-invalid="false" class="form-control"  placeholder=" First month price "  required> 
                                                      </div>
                                                  </div>
          
                                                  <div class="form-group col-md-6">
                                                      <label class="form-label " >Recurring fee</label>
                                                      <div class="form-control-wrap">
                                                          <input type="number" name="r_fee" step="0.01" required="true" aria-required="true" aria-invalid="false" class="form-control"  placeholder=" First month price "  required> 
                                                      </div>
                                                  </div>
          
                                                  <div class="form-group col-md-6">
                                                      <label class="form-label" >Number of keys</label>
                                                      <div class="form-control-wrap">
                                                          <input type="number" name="account" required="true" aria-required="true" aria-invalid="false" class="form-control"  placeholder=" Number of keys "  required> 
                                                      </div>
                                                  </div>
          
                                                  <div class="form-group col-md-6">
                                                      <label class="form-label" >Paypal Subscription ID  </label>
                                                      <div class="form-control-wrap">
                                                          <input type="text" name="p_subscription" required="true" aria-required="true" aria-invalid="false" class="form-control"  placeholder=" Number of keys "  required>
                                                      </div>
                                                  </div>

                                                      <div class="form-group col-md-6">
                                                          <label class="form-label" for="default-06">Status</label>
                                                          <div class="form-control-wrap ">
                                                              <div class="form-control-select">
                                                                  <select class="form-control" required data-style="btn btn-rose btn-round" title="Single Select" name="status" id="default-06">
                                                                      
                                                                          <option value="" disabled >Select Status</option>
                                                                          <option value="1" selected>Active</option>
                                                                          <option value="0">Inactive</option>
                                                                  </select>
                                                              </div>
                                                          </div>
                                                      </div>
              
                                                      <div class="form-group col-md-6">
                                                          <label class="form-label" for="default-06">Become affiliate</label>
                                                          <div class="form-control-wrap ">
                                                              <div class="form-control-select">
                                                                  <select class="form-control" data-style="btn btn-rose btn-round" title="Single Select" name="affiliate" id="default-06">
                                                                    
                                                                          <option value="default_option" disabled selected>Select</option>
                                                                          <option value="Yes">Yes</option>
                                                                          <option value="No" selected>No</option>
                                                                  </select>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="form-group col-md-6">
                                                        <label class="form-label" >Subscription Image </label>
                                                        <div class="form-control-wrap">
                                                            <input type="file" name="image"  class="custom-file-input"   required>
                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"></div>
                                                      <div class="form-group col-md-6">
                                                          <label class="form-label" for="product-desc">Description</label>
                                                          <div class="form-control-wrap">
                                                              <textarea type="text" name="desc" required="true" aria-required="true" aria-invalid="false" class="form-control" cols="35" rows="6" style="resize: none"></textarea>
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


<!-- content e -->
@endsection
