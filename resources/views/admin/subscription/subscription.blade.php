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
                            <h3 class="nk-block-title page-title">Subscription  List</h3>
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
                                        <th class="nk-tb-col  sorting" ><span>Duration</span></th>
                                        <th class="nk-tb-col  sorting" ><span>Price</span></th>
                                        <th class="nk-tb-col  sorting" ><span>Recurring Fee</span></th>
                                        <th class="nk-tb-col  sorting" ><span>Discription</span></th>
                                        <th class="nk-tb-col  sorting" ><span>Number of keys</span></th>
                                        <th class="nk-tb-col  sorting" ><span>Status</span></th>
                                        <th class="nk-tb-col  sorting" ><span>Become Affilate</span></th>
                                        <th class="nk-tb-col  sorting" ><span>Actions</span></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscriptions as $subscription)
                                    <tr class="nk-tb-item odd">
                                        <td class="nk-tb-col"><span class="tb-sub">{{ $loop->index + 1 }}</span></td>
                                        <td class="nk-tb-col"><span class="tb-lead"><span class="title">{{ $subscription->name }} Month</span></span></td>
                                        <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{ $subscription->price }}</span></span></td>
                                        <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{ $subscription->r_fee }}</span></span></td>
                                        <td class="nk-tb-col"><span class="tb-sub"><span class="title">	{{ $subscription->desc }}</span></span></td> 
                                        <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{ $subscription->account }}</span></span></td>
                                        <td class="nk-tb-col"> <span class="tb-sub"> 
                                            @if($subscription->status == 1)
                                            <span class="tb-status text-success">Active</span>
                                            @else
                                            <span class="tb-status text-daner">Inactive</span>
                                            @endif
                                            {{-- <form action="#" method="post" id="statusForm">
                                                <input name="id" type="hidden" >
                                                <div class="custom-control custom-switch">
                                                   <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                   <label class="custom-control-label" for="customSwitch1"> <span class="tb-status text-success">Active</span></label>
                                               </div>
                                            </form> --}}
                                        </span></td>
                                        <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{ $subscription->affiliate }}</span></span></td>
                                        <td class="nk-tb-col d-flex">
                                            <a href="{{ route('subscription.edit', $subscription->id) }}"  class="btn btn-success btn-sm edit-shop-btn">Edit</a>
                                            <a onclick="event.preventDefault(); document.getElementById('delete-form-{{ $subscription->id }}').submit();" class="btn btn-danger btn-sm delete-shop-btn" style="color: white">Delete</a>

                                        </form>
                                        </td>
                                        <form id="delete-form-{{$subscription->id}}" action="{{ route('subscription.destroy', $subscription->id) }}" method="post"
                                              style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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


<!-- content e -->
@endsection
