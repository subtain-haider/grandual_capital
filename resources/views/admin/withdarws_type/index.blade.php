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
                                <h3 class="nk-block-title page-title">Withdraw Type List</h3>
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
                                            <th class="nk-tb-col  sorting" ><span>Withdraw Payment Type</span></th>
                                            <th class="nk-tb-col  sorting" ><span>Status</span></th>
                                            <th class="nk-tb-col  sorting" ><span>Actions</span></th>
    
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($type as $cat)
                                        <tr class="nk-tb-item odd">
                                            <td class="nk-tb-col"><span class="tb-sub"> {{ $loop->index + 1 }}</span></td>
                                            <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{ $cat->name }}</span></span></td>
                                            <td class="nk-tb-col">
                                                <span class="tb-sub">
                                                    <span class="title"> 
                                                        <form action="{{route('withdraws.types.status')}}" method="post" id="statusForm{{$cat->id}}">
                                                            @csrf
                                                            <input name="id" type="hidden" value="{{$cat->id}}">
                                                             <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input " id="customSwitch{{$cat->id}}" value="{{$cat->status == '1' ? '0' : '1'}}" {{isset($cat['status']) && $cat['status'] == '1' ? 'checked' : ''}} name="status" onchange="document.getElementById('statusForm{{$cat->id}}').submit()">
                                                                @if($cat->status == '1')
                                                                <label class="custom-control-label" for="customSwitch{{$cat->id}}"><span class="tb-status text-success">Active</span></label>
                                                                @else
                                                                <label class="custom-control-label" for="customSwitch{{$cat->id}}"><span class="tb-status text-danger">Inctive</span></label>
                                                                @endif
                                                            </div>
                                                         </form>
                                                    </span>
                                                </span>
                                             </td>
                                            <td class="nk-tb-col">
                                                <a class="btn btn-danger btn-sm delete-shop-btn" style="color: white" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $cat->id }}').submit();">Delete</a>
                                                <form id="delete-form-{{ $cat->id }}"
                                                    action="{{ route('withdraws.types.delete', $cat->id) }}" method="post"
                                                    style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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


    <!-- content @e -->
@endsection
