@extends('layouts.general_layout')
@section('title', topic_info($topicid, 'title'))
@section('content')

@php($cat_id = topic_info($topicid, 'cat_id'))

<div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('index') }}" class="btn btn-default"><i class="fas fa-home"></i></a>
        <a href="{{ route('forum', array('get_forum_id' => cat_info_by_topic($topicid, 'id')))}}" class="btn btn-default">{{ cat_info_by_topic($topicid, 'title') }}</a>
    </div>
</div>
<div class="topic-container">
    <h2 class="h2_topic">{{  topic_info($topicid, 'title') }}</h2>
    <div class="card-header bg-white text-uppercase bold">
        Posts <span class="material-icons pull-right">timeline</span>
    </div>


@if(PollQuestion_By_topicID($topicid, 'disabled') != 1 && PollQuestion_By_topicID($topicid, 'starts') <= dayXnow())
    @include('showtopic.poll')
@endif


@if($posts)

@foreach ($posts as $row)

<div class="post" id="p{{ $row->id }}">
    <!--Post header-->
    <div class="post-header">
        <div class="hp-left">
            <div>
                <a href="#" class="avatar">
                    <img src="{{ asset(user_info($row->posted_by, 'avatar')) }}" alt="avatar">
                </a>
            </div>
              <div class="uname-post">
                <a href="{{ route('user_profile',[$row->posted_by]) }}" class="post_uname" id="pby{{ $row->id }}">
                   {{ user_info($row->posted_by, 'name') }}
                </a>
                <div class="post-time"> 
                    <span class="material-icons">access_time</span> {{ $row->created_at->diffForHumans() }}
                </div>
               </div>
        </div>
        @auth
        @if(minutesago($row->created_at)<=5 && $row->posted_by == myid() || user_premission_at(myid(), $cat_id) == $cat_id || my('level') >= 2 && my('level') <= 3)
         <div>
            <a class="post-triger" onclick="w3.toggleShow('#postact_{{ $row->id }}')">
                <span class="material-icons">expand_more</span>
            </a>
        </div>
        
        <div class="post_options" id="postact_{{ $row->id }}" style="display:none;">
            <a href="{{ route('edit_post', ['postid' => $row->id]) }}">Edit</a>
           
            @if(minutesago($row->created_at)<=1 && $row->posted_by == myid() || my('level') >= 1 && my('level') <= 3)
                @if(topic_firstpost($topicid, 'id') != $row->id)
                    <a href="{{ route('delete_post', ['postid' => $row->id]) }}">Delete</a>
                @endif
            @endif     
        </div>
        @endif
        @endauth
    </div>
    <!-- End post header-->
<div class="www" style="width: 100%;">
    <!--Start post content-->
    <div class="post-content">
        <span id="pcont_{{ $row->id }}">{!! $row->text !!}</span>
        
        @if($row->attachments != '')
        <div class="attachments_title">Attachments</div>
        <div class="display_attachment">
            {!! $row->attachments !!}
        </div>
        @endif

    </div>
    <!--End post content-->
    @if($row->edited_by >= 1)
        <div id="editedinfoofapost">Edited {{ $row->updated_at }} by <a href="{{ route('user_profile', ['id' => $row->edited_by]) }}"><b>{{ user_info($row->edited_by, 'name') }}</b></a></div>
    @endif

    @auth
    @if(topic_info($topicid, 'close') == 0)

    <div class="reactions-container" id="react_{{ $row->id }}" style="display:none;"></div>

    <!--Start post footer-->
    <div class="post-footer">
    @if($row->posted_by==myid())
    <div style="width:100%"></div>
    @else
        <a href="javascript:void" class="reactParent" id="reacted_{{ $row->id }}" ract="{{ PostReacted($row->id,'reaction') }}" onclick="justreact({{ $row->id }});" onmouseover="react_options({{ $row->id }});">
            {!! PostReacted($row->id,'icon') !!}
        </a>

        <a onclick="answer('{{ user_info($row->posted_by, 'name') }}',' {{ $row->posted_by }}')">
            <i class="far fa-comment"></i>
            <span class="post-actionss_name">Answer</span>
        </a>
    @endif
        <a onclick="quote({{ $row->id }})">
            <i class="fas fa-quote-right"></i> 
            <span class="post-actionss_name">Quote</span>
        </a>
    </div>
    <!--End post footer-->
    @endif
    @endauth
    </div>
</div>

@endforeach
@endif  

</div>
    <!-- start pagination -->
    <nav class="pagination-body">
        <ul class="pagination justify-content-center">
            {!! $posts->links() !!}
        </ul>
    </nav>
    <!-- end pagination -->

    @if(topic_info($topicid, 'close') == 1)
        <div style="min-height: 20px;"></div>
        <div class="topic-container bg-white">
            <div class="alert alert-danger">
                <strong>Look!</strong> {{ closed_by_text($topicid, topic_info($topicid, 'closed_by')) }}
            </div>
        </div>
    @endif




    <!-- Move topic Modal -->
    <div class="modal fade" id="move_modal">
        <div class="modal-dialog">
            <div class="modal-content">
      
                <!-- Modal Header -->
                <div class="modal-header">
      	            <div class="modal-header-title">Move topic</div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="alert alert-warning fade in alert-dismissible show">
                        <strong>Warning!</strong> Make sure if you choose the right category for this topic by its thematics. Choose the category where would you like to move this topic and click to "Move".
                    </div>
                    <select class="custom-select mt-3" id="myselect">
                	    <option selected="">Select category</option>
                        @foreach ($all_cats as $cat_option)
                            @if($cat_option->id != $cat_id)
                                <option value="{{ $cat_option->id }}">{{ $cat_option->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-custom" id="movetopic" disabled><i class="fas fa-exchange-alt"></i>  Move</button>
                    <button type="button" class="btn btn-primary btn-custom" data-dismiss="modal"><i class="far fa-times-circle"></i> Cancel</button>
                </div>
        
            </div>
        </div>
    </div>




    <!-- Delete topic Modal -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">
  
                <!-- Modal Header -->
                <div class="modal-header">
                    <div class="modal-header-title">Delete topic</div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
    
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="alert alert-warning fade in alert-dismissible show">
                        <strong>Warning!</strong> Are you sure you want to delete the topic? Note that it can not be restored after deletion!
                    </div>
                    
                    <label class="d-flex p-2 bg-white text-black radio-inline">
                        <input type="checkbox" id="delete_agreement" style="margin-right: 10px !important;"> 
                        I read and understand this message
                    </label>

                </div>
    
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-custom" id="del_allow" disabled><i class="fas fa-trash-alt"></i> Delete</button>
                    <button type="button" class="btn btn-primary btn-custom" data-dismiss="modal"><i class="far fa-times-circle"></i> Cancel</button>
                </div>
    
            </div>
        </div>
    </div>


<script>
    function react_options(id)
    {
        var like = '<div class="reacted likebutton" onclick="react('+id+',1);"><i class="las la-thumbs-up"></i></div>';
        var haha = '<div class="reacted haha" onclick="react('+id+',2);"><i class="las la-grin-squint-tears"></i></div>';
        var beer = '<div class="reacted beer" onclick="react('+id+',3);"><i class="las la-beer"></i></div>';
        var diss = '<div class="reacted dislikebutton" onclick="react('+id+',4);"><i class="las la-thumbs-down"></i></div>';
        
        var innerClasses = '<div class="reaction-icons">'+like+haha+beer+diss+'</div>';
        if($('#react_'+Number(id)).css('display') == 'none')
        {
            $('#react_'+Number(id)).html(innerClasses);
            $('#react_'+Number(id)).css('display','flex');
        }
        else
        {
            $('#react_'+Number(id)).hide();
        }
        
    }
    function react(post, emotion)
    {
        $.reactToPost(post,emotion);
    }
    
    
    function justreact(n){
        var ract = $('#reacted_'+Number(n)).attr("ract");
        if(ract == '0'){
            react(n, 1);
            w3.hide('#react_'+Number(n));
        }
        else
        {
            alert('remove');
            $('#reacted_'+n).html('<i class="far fa-thumbs-up"></i><span class="post-actionss_name">Like</span>');
            $('#reacted_'+n).attr("ract", 0);
        }
    }



    $.reactToPost = function(id,reaction)
    {
        $.post("{{ route('react_action') }}",
        {
            post: id,
            reacted: reaction
        },
        function(data)
        {
            var like = '<div class="reacted likebutton"><i class="las la-thumbs-up"></i></div>';
            var haha = '<div class="reacted haha"><i class="las la-grin-squint-tears"></i></div>';
            var beer = '<div class="reacted beer"><i class="las la-beer"></i></div>';
            var diss = '<div class="reacted dislikebutton"><i class="las la-thumbs-down"></i></div>';
            
            var nPost = data.post;
            var nEmotion = data.reaction

            var emotions = [like, haha, beer, diss];
            $('#reacted_'+nPost).html(emotions[nEmotion-1]);
            $('#reacted_'+nPost).attr("ract", nEmotion);
            $('#react_'+nPost).hide();
            
        });

        $('#gtgtgtg').hide();
           
    };

$(document).ready(function(){
    
     
    $('#delete_agreement').click(function(){
        if($(this).is(":checked")){
            $("#del_allow").removeAttr("disabled");
        }
        else if($(this).is(":not(:checked)")){
            $("#del_allow").attr("disabled","");
        }
    });
    

    $("#myselect").change(function(){
        if(Number($(this).val()) >= 1){
            $("#movetopic").removeAttr("disabled");
        }
        else{
            $("#movetopic").attr("disabled","");
        }
    });

    $("#movetopic").click(function(){
        var cat_to_move_to = $("#myselect").val();
        $.post("{{ route('move_topic') }}",
        {
            topic: {{ $topicid }},
            category: cat_to_move_to
        },
        function(response)
        {   
            if(response.link != '0')
            {
                $('#move_modal').hide();
                $('.modal-backdrop').hide();
    
                $('.loader-fullwidth').show();
                $('#loader-answer-received').html(response.message);

            
                window.location.href = response.link;
            }
            else{
                alert(response.message);
            }
            
            
        });
    });


    $("#del_allow").click(function(){
        var cat_to_move_to = $("#myselect").val();
        $.post("{{ route('delete_topic') }}",
        {
            topic: {{ $topicid }},
            category: {{ topic_info($topicid, 'cat_id') }}
        },
        function(response)
        {   
            if(response.link != '0')
            {
                $('#delete_modal').hide();
                $('.modal-backdrop').hide();
    
                $('.loader-fullwidth').show();
                $('#loader-answer-received').html(response.message);
            
                window.location.href = response.link;
            }
            else{
                alert(response.message);
            }
            
            
        });
    });




});
</script>





@auth
    @if(topic_info($topicid, 'close') == 0)
        <div style="min-height: 20px;"></div>
        <div style="margin-bottom: -15px;">
            <h4>Quick reply</h4> 
        </div>

        @include('showtopic.forms.post_form')
    @endif

    @if(minutesago(Post_info($first_postid, 'created_at'))<=5 && Post_info($first_postid, 'posted_by') == myid() || user_premission_at(myid(), $cat_id) == $cat_id || my('level') >= 2 && my('level') <= 3)
        
    <div class="topic_moterate bg-white">
        Moderate: 
        @if(topic_info($topicid, 'close') == 0)
        <a href="{{ route('close_topic', ['id' => $topicid]) }}">Close topic</a>
        @else
        <a href="{{ route('open_topic', ['id' => $topicid]) }}">Open topic</a>
        @endif
        |
        <a href="{{ route('EditTopic', ['id' => $topicid]) }}">Edit topic</a>
        @if (Post_info($first_postid, 'posted_by') == myid() && my('level') == 0 || user_premission_at(myid(), $cat_id) == 0)
            This actions avaiable while five minutes
        @endif
        


        @if(user_premission_at(myid(), $cat_id) == $cat_id || my('level') >= 2 && my('level') <= 3)
        |<a href="javascript:void" data-toggle="modal" data-target="#move_modal">Move topic</a>|
        <a href="javascript:void" data-toggle="modal" data-target="#delete_modal">Delete topic</a>
        @endif
    </div>
    @endif
@endauth
    


@endsection