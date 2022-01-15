@extends('user.dashboard.app')

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
                          <h3 class="nk-block-title page-title">Videos List</h3>
                      </div><!-- .nk-block-head-content -->
                     
                  </div><!-- .nk-block-between -->
              </div><!-- .nk-block-head -->
              <div class="nk-block">
                  <div class="row g-gs">
                      <div class="col-xxl-12">
                          <div class="col-12 div_alert">
                            </div>
                          <nav>
                              <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">

                                  <a class="nav-link mr-3 active" data-toggle="tab" href="#nav_all" role="tab" >All</a>
                                  @foreach($vid_categories as $category)
                                      <a class="nav-link mr-3" data-toggle="tab" href="#nav_{{$category->id}}" role="tab" >{{$category->category}}</a>
                                  @endforeach
{{--                                  <a class="nav-link mr-3" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" >Profile</a>--}}
{{--                                  <a class="nav-link mr-3" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" >Contact</a>--}}
                              </div>
                          </nav>
                          <div class="tab-content" id="nav-tabContent">
                                  <div class="tab-pane fade show active " id="nav_all" role="tabpanel" >
                                      <div class="row">

                                      @foreach($videos as $video)
                                              <div class="col-3">
                                                  <div class="card">
                                                      <div class="card-body">
                                                          <video style="width: 100%;  min-height:240px" controls controlsList="nodownload">
                                                              <source src="{{url('/') .'/'.$video->video_link}}" type="video/mp4">
                                                          </video>
                                                          <h5 class="card-title mt-2">{{$video->video_title}}</h5>
                                                          <p class="card-text">{{$video->description}}</p>
                                                      </div>
                                                  </div>
                                              </div>
                                      @endforeach
                                      </div>

                                  </div>
                              @foreach($vid_categories as $category)
                                  <div class="tab-pane fade show" id="nav_{{$category->id}}" role="tabpanel" >
                                      <div class="row">

                                      @foreach($category->videos as $video)
                                              <div class="col-3">
                                                  <div class="card">
                                                      <div class="card-body">
                                                          <video width="320" height="240" controls controlsList="nodownload">
                                                              <source src="{{url('/') .'/'.$video->video_link}}" type="video/mp4">
                                                          </video>
                                                          <h5 class="card-title mt-2">{{$video->video_title}}</h5>
                                                          <p class="card-text">{{$video->description}}</p>
                                                      </div>
                                                  </div>
                                              </div>
                                      @endforeach
                                      </div>

                                  </div>
                              @endforeach
                          </div>
{{--                          <div class="row">--}}
{{--                              --}}
{{--                          @foreach ($videos as $video)--}}
{{--                                  <div class="col-3">--}}
{{--                                      <div class="embed-responsive embed-responsive-16by9">--}}
{{--                                          <iframe class="embed-responsive-item" src="{{$video->video_link}}" allowfullscreen></iframe>--}}
{{--                                      </div>--}}
{{--                                  </div>--}}
{{--                          @endforeach--}}
{{--                          </div>--}}

                          
{{--                          <table class="datatable-init nowrap nk-tb-list is-separate dataTable no-footer" data-auto-responsive="false" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">--}}
{{--                              <thead>--}}
{{--                                  <tr class="nk-tb-item nk-tb-head" role="row">--}}
{{--                                      <th class="nk-tb-col sorting" ><span>ID</span></th>--}}
{{--                                      <th class="nk-tb-col  sorting" ><span> Title</span></th>--}}
{{--                                      <th class="nk-tb-col  sorting" ><span>Category</span></th>--}}
{{--                                      <th class="nk-tb-col  sorting" ><span>Video Link</span></th>--}}
{{--                                      <th class="nk-tb-col  sorting" ><span>Discription</span></th>--}}
{{--                                      <th class="nk-tb-col  sorting" ><span>Actions</span></th>--}}

{{--                                  </tr>--}}
{{--                              </thead>--}}
{{--                              <tbody>--}}
{{--                                   @foreach ($products as $product)--}}
{{--                                   <tr class="nk-tb-item odd">--}}
{{--                                      <td class="nk-tb-col"><span class="tb-sub">{{$loop->index + 1}}</span></td>--}}
{{--                                      <td class="nk-tb-col"><span class="tb-lead"><span class="title"><a href="{{$product->video_link}}" target="_blank">--}}
{{--                                        {{$product->video_title}}--}}
{{--                                        </a></span></span></td>--}}
{{--                                      <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{$product->videoCategory->category}}</span></span></td>--}}
{{--                                      <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{$product->video_link}}</span></span></td>--}}
{{--                                      <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{$product->description}}</span></span></td>--}}
{{--                                      <td class="nk-tb-col">--}}
{{--                                          <a href="{{route('admin.video.edit',$product->id)}}" class="btn btn-success btn-sm edit-shop-btn">Edit</a>--}}
{{--                                          <a onclick="event.preventDefault(); document.getElementById('delete-form-{{ $product->id }}').submit();" class="btn btn-danger btn-sm delete-shop-btn" style="color: white">Delete</a>--}}
{{--                                      </td>--}}
{{--                                      <form id="delete-form-{{$product->id}}" action="{{ route('admin.video.destroy', $product->id) }}" method="post"--}}
{{--                                        style="display:none;">--}}
{{--                                      @csrf--}}
{{--                                      @method('DELETE')--}}
{{--                                    </form>--}}
{{--                                   </tr>--}}
{{--                                   @endforeach--}}



{{--                              </tbody>--}}
{{--                          </table>--}}
                          
                    
                      </div><!-- .col -->
                  </div><!-- .row -->



              </div><!-- .nk-block -->
          </div>
      </div>
  </div>
</div>


<!-- content @e --