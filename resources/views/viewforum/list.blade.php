@extends('layouts.general_layout')
@section('title', cat_info($cat, 'title'))
@section('content')




<div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('home') }}" class="btn btn-default"><i class="fas fa-home"></i></a>
        <a href="{{ cat_info($cat, 'id') }}" class="btn btn-default">{{ cat_info($cat, 'title') }}</a>
    </div>
    </div>
    <div class="all_post_items_container">
        <div class="card-header bg-white text-uppercase bold">
           {{ cat_info($cat, 'title') }} <span class="material-icons pull-right">timeline</span>
        </div>
        @if(cat_info($cat, 'description_show') == "on")
        <div class="bg-white p-3 border-bottom">
            {{ cat_info($cat, 'description') }}
        </div>
        @endif
        
        <div class="card-body bg-white border-bottom">
            <div class="viewf-twosides">
                <a>
                    <b>Results:</b> {{ $topics_in_cat  }}
                </a>
                @auth
                <a href="{{ route('addtopic', [$cat]) }}" class="tcb-basic tcb-primary">Add topic</a>
                @endauth
            </div>
        </div>
        {!! cat_info($cat, 'ad') !!}
  
 <!-- an question -->


@if($topics_in_cat)

@foreach ($topics as $row)

    <div class="d-flex mb-3 qapi">
        <div class="p-2 flex-fill mq-avatar">
            <div class="item-avatar">
                <img src="{{ asset(user_info(topic_lastpost($row->id, 'posted_by'), 'avatar')) }}" width="90">
            </div>
        </div>
        <div class="p-2 flex-fill qam-bosy">
            <a href="{{ route('showtopic', [$row->id]) }}">{{ $row->title }}</a>
            <div class="mqa-tags">
                <a href="{{ route('forum', [$row->cat_id]) }}">{{ cat_info($row->cat_id, 'title') }}</a>
            </div>  
            <div class="dateandcat">
                <div>
                    <span class="material-icons">schedule</span> 
                    <span class="post-mtiem-date">{{ humman_date($row->created_at) }}</span>
                </div>
                <div class="by_posted">
                    <span class="by">By</span>
                    <a href="{{ route('user_profile', [$row->user_by]) }}">{{ user_info($row->user_by, 'name') }}</a>
                </div>
            </div>
        </div>
        <div class="p-2 flex-fill last-stat">
            <div class="div-abs">
                <div>
                    <span class="material-icons">visibility</span>  
                    <span class="real-count">{{ topic_info($row->id, 'views') }}</span>   
                </div>
                <div>
                    <span class="material-icons">quickreply</span>
                    <span class="real-count">{{ topic_info($row->id, 'posts_in') }}</span>
                </div>
            </div>
        </div>
    </div>

    
@endforeach

@else
<div class="card mb-4 shadow-sm">
    <div class="card-header text-center">
      <h4 class="my-0 font-weight-normal">Topics not found</h4>
    </div>
    <div class="card-body text-center">
        <p>Would you like to create the first topic in this category now? We let you do so!</p>
    </div>
  </div>

@endif  

<!-- an question -->
        


    
    </div>
    
    <!-- main question end -->
    
    <!-- start pagination -->
    <nav class="pagination-body">
        <ul class="pagination justify-content-center">
            {!! $topics->links() !!}
        </ul>
    </nav>
    <!-- end pagination -->
    





@endsection