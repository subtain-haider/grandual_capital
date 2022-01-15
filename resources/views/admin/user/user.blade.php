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
                          <h3 class="nk-block-title page-title">Users List</h3>
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
                                      <th class="nk-tb-col  sorting" ><span>Full Name</span></th>
                                      <th class="nk-tb-col  sorting" ><span>User Name</span></th>
                                      <th class="nk-tb-col  sorting" ><span>Email</span></th>
                                       <th class="nk-tb-col  sorting" ><span>Referance link</span></th> 
                                      <th class="nk-tb-col  sorting" ><span>Referance by</span></th>
                                      <th class="nk-tb-col  sorting" ><span>Actions</span></th>

                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($users as $user)
                                  <tr class="nk-tb-item odd">
                                      <td class="nk-tb-col"><span class="tb-sub"> {{$loop->index + 1}}</span></td>
                                      <td class="nk-tb-col"><span class="tb-lead"><span class="title">{{$user->full_name}}</span></span></td>
                                      <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{$user->name}}</span></span></td>
                                      <td class="nk-tb-col"><span class="tb-sub"><span class="title"> {{$user->email}}</span></span></td>
                                      <td class="nk-tb-col"><span class="tb-sub"><span class="title">
                                        <span class="tb-sub"><span class="title">	{{url('/?ref=').$user->ref_id}}</span></span>	
                                        {{--                      <td>--}}
                                        {{--                          <img src="{{url('/').'/'.$user->image}}" alt="{{$user->image}}" style="width: 50px;height: 50px;">--}}
                                        {{--                      </td>--}}
                                      </span></span></td> 

                                      <td class="nk-tb-col">
                                        @php
                                        if (!empty($user->ref_by)){
                
                                          $a_user = \App\Models\User::where('ref_id', $user->ref_by)->first();
                }
                                        @endphp
                                          {{$a_user->name ?? ''}}
                                      </td>
                                      <td class="nk-tb-col">
                                          <a href="{{url('admin/users/edit',$user->id)}}"  class="btn btn-success btn-sm edit-shop-btn">Edit</a>
                                          <a class="btn btn-danger btn-sm delete-shop-btn" onclick="event.preventDefault(); document.getElementById('delete-form-{{$user->id}}').submit();" style="color: white">Delete</a>
                                      </td>
                                      <form id="delete-form-{{$user->id}}" action="{{ url('admin/users/destroy',$user->id) }}" method="post"
                                        style="display:none;">
                                      @csrf
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


@endsection
