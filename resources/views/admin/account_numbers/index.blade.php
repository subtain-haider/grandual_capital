@extends('admin.app')

@section('content')
    @php
        use App\Models\Category;

    @endphp
     <!-- content @s -->

     <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Account Number</h3>
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
                                            <th class="nk-tb-col  sorting" ><span>Account</span></th>
                                            <th class="nk-tb-col  sorting" ><span>User</span></th>
                                            <th class="nk-tb-col  sorting" ><span>Subscription</span></th>
                                            <th class="nk-tb-col  sorting" ><span>Expire At</span></th>
                                            <th class="nk-tb-col  sorting" ><span>Complete code</span></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($accounts as $account)
                                        <tr class="nk-tb-item odd">
                                            <td class="nk-tb-col"><span class="tb-sub">{{$loop->index + 1}}</span></td>
                                            <td class="nk-tb-col"><span class="tb-lead"><span class="title">{{$account->account}}</span></span></td>
                                            <td class="nk-tb-col"><span class="tb-sub"><span class="title"></span>{{$account->user->username}}</span></td>
                                            <td class="nk-tb-col"><span class="tb-sub"><span class="title"> {{$account->subscription->name}} Month</span></span></td>
                                            <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{$account->user->expires_at}}</span></span></td> 
                                            <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{$account->account}}:GrandeurCapital{{'@'.$account->user->expires_at}}.{{$account->user->email}}</span></span></td>
                                            
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
