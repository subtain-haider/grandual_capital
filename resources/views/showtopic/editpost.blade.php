@extends('layouts.general_layout')
@section('title', 'Editing post #'.$postid.' at '.topic_info($topicid, 'title'))
@section('content')

<div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('index') }}" class="btn btn-default"><i class="fas fa-home"></i></a>
        <a href="{{ route('forum', [cat_info_by_topic($topicid, 'id')]) }}" class="btn btn-default">{{ cat_info_by_topic($topicid, 'title') }}</a>
        <a href="{{ route('showtopic', [$topicid]) }}" class="btn btn-default">{{ topic_info($topicid, 'title') }}</a>
    </div>
</div>
<div class="topic-container">
    <div class="card-header bg-white text-uppercase bold">
        Edit post #{{ $postid }} <span class="material-icons pull-right">timeline</span>
    </div>
</div>
<div class="bg-white">
    @include('showtopic.forms.edit_post_form')
</div>

@endsection