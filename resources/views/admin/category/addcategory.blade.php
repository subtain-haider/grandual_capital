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
                            <h3 class="nk-block-title page-title">Add Category </h3>
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
                                    <div class="card-inner ml-1 mr-1 my-1">
                                      <form id="TypeValidation" class="form-horizontal" action="{{route('category.store')}}" method="POST" enctype="multipart/form-data" novalidate="novalidate">
                                        @csrf
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" for="product-name-en">Category Name</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" name="category" required="true" aria-required="true" aria-invalid="false" class="form-control"  placeholder="Enter " required> 
                                                    </div>
                                                </div>
        
        
        
                                                <div class="form-group col-md-12 text-right">
                                                    <button type="submit" class="btn btn-lg btn-primary">Add</button>
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
