@extends('admin.app')

@section('content')
<style>
    .bootstrap-select
    {
        width: 100% !important;
    }
</style>
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <form id="TypeValidation" class="form-horizontal" action="{{route('subscription.store')}}" method="POST" enctype="multipart/form-data" novalidate="novalidate">
                @csrf
              <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">Add Product</h4>
                  </div>
                </div>
                <div class="card-body ">
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-9">
                        <select class="selectpicker" data-style="btn btn-rose btn-round" title="Single Select" name="name">
                            <option disabled selected>Select Category</option>
                            <option value="Month">Month</option>
                            <option value="Six Month">Six Month</option>
                            <option value="Year">Year</option>
                          </select>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-9">
                      <div class="form-group bmd-form-group is-filled has-success">
                        <input class="form-control valid" type="text" name="price" required="true" aria-required="true" aria-invalid="false">
                      <label id="required-error" class="error" for="required"></label></div>
                    </div>
                  </div>
                </div>
                <div class="card-footer ml-auto mr-auto">
                  <button type="submit" class="btn btn-rose">Submit</button>
                </div>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
@endsection
