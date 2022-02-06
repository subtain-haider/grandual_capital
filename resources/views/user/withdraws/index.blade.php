@extends('user.dashboard.app')

@section('content')



                <!-- content @s -->

                <div class="nk-content">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">All Withdraw Requests</h3>
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
                                                        <th class="nk-tb-col  sorting" ><span>Amount</span></th>
                                                        <th class="nk-tb-col  sorting" ><span>Account</span></th>
                                                        <th class="nk-tb-col  sorting" ><span>Type</span></th>
                                                        <th class="nk-tb-col  sorting" ><span>Note</span></th>
                                                        <th class="nk-tb-col  sorting" ><span>Status</span></th>
                
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($withdraws as $withdraw)
                                                    <tr class="nk-tb-item odd">
                                                        <td class="nk-tb-col"><span class="tb-sub">{{$withdraw->id}}</span></td>
                                                        <td class="nk-tb-col"><span class="tb-lead"><span class="title">${{$withdraw->amount}}</span></span></td>
                                                        <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{$withdraw->account}}</span></span></td>
                                                        <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{$withdraw->type}}</span></span></td>
                                                        <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{$withdraw->note}}</span></span></td>
                                                        <td class="nk-tb-col">
                                                            @if($withdraw->status == '1')
                                                                <span class="tb-sub"> <span class="tb-status text-success">Approved</span></span>
                                                            @else
                                                                <span class="tb-sub"><span class="tb-status text-warning">Pending</span></span>
                                                            @endif
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
