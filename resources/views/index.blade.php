@extends('layouts.general_layout')
@section('title', 'Main page')
@section('content')

@if(announcement_info('show_status') == "on")
    <div class="all_post_items_container bg-white p-3 border-bottom">
    <div class="bold">{{ announcement_info('title') }}</div>
        {{ announcement_info('text') }}
    </div>
@endif

@if(ad_Info(1,'ad_show')=="on")
<div class="all_post_items_container">
    {!! ShowAd(1) !!}
</div>
@endif
<div class="slog">
    <span style="font-family: 'Orbitron', sans-serif; font-size: 19px;">
        {{ sys_info('site_name') }}
    </span>
    <br>
    <span style="font-family: 'Economica', sans-serif;font-size: 24px;">
        {{ sys_info('slogan') }}
    </span>
</div>

@if(session('login-success'))
    <div class="alertbox bg-white" id="login_notice" onclick="w3.hide('#login_notice');">
        <div class="alert_avatar"><img src="{{ asset('assets/images/radius-logo.png') }}" alt="logo"></div>
        {{ session('login-success') }}
    </div>
@endif

<div class="all_post_items_container">
    <div class="card-header bg-white text-uppercase bold">
      New Postes  <span class="material-icons pull-right">timeline</span>
    </div>
<!-- an question -->


@if($topics)

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
@endif

<!-- an question -->

@if(ad_Info(8,'ad_show')=="on")
    {!! ShowAd(8) !!}
@endif

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