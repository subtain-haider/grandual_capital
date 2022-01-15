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
                            <h3 class="nk-block-title page-title">Video Category List</h3>
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
                                        <th class="nk-tb-col  sorting" ><span>Category Name</span></th>
                                        <th class="nk-tb-col  sorting" ><span>Edit</span></th>
                                        <th class="nk-tb-col  sorting" ><span>Delete</span></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $cat)


                                     <tr class="nk-tb-item odd">
                                        <td class="nk-tb-col"><span class="tb-sub">{{ $loop->index + 1 }}</span></td>
                                        <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{ $cat->category }}</span></span></td>
                                        <td class="nk-tb-col">
                                            <a href="{{ route('admin.videoCategory.edit', $cat->id) }}"  class="btn btn-success btn-sm edit-shop-btn">Edit</a>
                                        </td>
                                        <td class="nk-tb-col">
                                            <a onclick="event.preventDefault(); document.getElementById('delete-form-{{ $cat->id }}').submit();" class="btn btn-danger btn-sm delete-shop-btn" style="color: white">Delete</a>
                                        </td>
                                         <form id="delete-form-{{ $cat->id }}"
                                               action="{{ route('admin.videoCategory.destroy', $cat->id) }}" method="post"
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
