@extends('user.dashboard.app')

@section('content')
    @php
        use App\Models\Category;
$user = \Illuminate\Support\Facades\Auth::user()

    @endphp

    <!-- content @s -->

    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Products List</h3>
                            </div><!-- .nk-block-head-content -->
                           
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-xxl-12">
                                <div class="col-12 div_alert">
                                  </div>
                                
                                <table class="datatable-init nowrap nk-tb-list is-separate dataTable no-footer" data-auto-responsive="false" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head" role="row">
                                            <th class="nk-tb-col sorting" ><span>ID</span></th>
                                            <th class="nk-tb-col  sorting" ><span>Name</span></th>
                                            <th class="nk-tb-col  sorting" ><span>Category</span></th>
                                            <th class="nk-tb-col  sorting" ><span>Photo</span></th>
                                            <th class="nk-tb-col  sorting" ><span>Action</span></th>
    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr class="nk-tb-item odd">
                                            <td class="nk-tb-col"><span class="tb-sub">{{$loop->index + 1}}</span></td>
                                            <td class="nk-tb-col"><span class="tb-sub"><span class="title"><a href="/product/{{$product->id}}" target="_blank">
                                                {{$product->name}}
                                                </a></span></span></td>
                                            <td class="nk-tb-col">
                                                <span class="tb-sub"><span class="title"> {{$product->p_category->category}}</span></span>
                                            </td>
                                            <td class="nk-tb-col">
                                                <span class="tb-sub"><span class="title"><img src="{{url('/').'/'.$product->image}}" alt="{{$product->image}}" width="60"></span></span></span>
                                            </td>
                                            <td class="nk-tb-col">
                                                <a href="/product/{{$product->id}}"  class="btn btn-primary btn-sm edit-shop-btn">View</a>

                                                @if(empty($user->subscription))
                                                    <a href="/user/subscription" class="btn btn-danger btn-sm delete-shop-btn" style="color: white">Purchase</a>
                                                @else
                                                    <a href="{{url('/') . '/' .$product->file}}" target="_blank" class="btn btn-danger btn-sm">Download</a>
                                                @endif
                                                {{-- <a class="btn btn-danger btn-sm delete-shop-btn" style="color: white">Purchase</a> --}}
                                            </td>
                                         </tr> 

                                         @endforeach
                                        
                                    </tbody>
                                </table>
                                
                          
                            </div><!-- .col -->
                        </div><!-- .row -->
    
    
    
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>


    
@endsection
