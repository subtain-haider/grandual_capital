@extends('layouts.general_layout')
@section('title', 'Search')
@section('content')

<div class="all_post_items_container">

    <div class="bg-white overflow-auto">
        <div class="btn-group btn-breadcrumb">
            <a href="{{ route('home') }}" class="btn btn-default"><i class="fas fa-home"></i></a>
            <a href="{{ route ('Search_page', ['thing' => '', 'word' => '', 'sort' => '', 'cat' => '']) }}" class="btn btn-default">Search</a>
        </div>
    </div>
    <div style="min-height: 15px;"></div>
    <div class="card-header bg-white text-uppercase bold flex-sp">
        Search 
        <div class="search_uort" id="search_uort">
            @php($activeStopics = ($search['thing'] <= 1 || $search['thing'] == '') ? 'active' : 'disable')
            @php($activeSusers = ($search['thing'] == 2) ? 'active' : 'disable')
            
            <a href="javascript:void" onclick="filtersetThing(1);" class="{{ $activeStopics }} radiusleft">Topics</a>
            <a href="javascript:void" onclick="filtersetThing(2);" class="{{ $activeSusers }}">Users</a>
        </div>
    </div>

    <div class="input-group bg-white card-body bboreder">
        <div class="input-group-prepend">
          <button type="button" class="btn btn-outline-f2 dropdown-toggle-split hover_f9" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-filter"></i>
          </button>
          <div class="dropdown-menu" id="filter_body">
            @php($activeIDASC = ($search['sort'] == 1) ? ' active' : ' disable')
            <a class="dropdown-item{{ $activeIDASC }}" href="javascript:void" onclick="filterset(1);">ID Accending</a>

            @php($activeIDDESC = ($search['sort'] == 2) ? ' active' : ' disable')
            <a class="dropdown-item{{ $activeIDDESC }}" href="javascript:void" onclick="filterset(2);">ID Decending</a>

            @if($search['thing'] != 2)
            @php($activeDateASC = ($search['sort'] == 3) ? ' active' : ' disable')
            <a class="dropdown-item{{ $activeDateASC }}" href="javascript:void" onclick="filterset(3);">Date Accending</a>

            @php($activeDateDESC = ($search['sort'] == 4) ? ' active' : ' disable')
            <a class="dropdown-item{{ $activeDateDESC }}" href="javascript:void" onclick="filterset(4);">Date Decending</a>
            @endif
          </div>
        </div>
        <input type="text" class="form-control btn-outline-f2" id="search_input" value="{{ $search['word'] }}" placeholder="Search word...">
        <div class="input-group-append">
            <button class="btn btn-outline-f2 hover_f9" type="button" id="searchgob"><i class="fas fa-search"></i></button>
        </div>
    </div>

    @if($search['word'] != '')
        <div class="search_results">
            <div class="searchstat-line">
                <strong>We are searching:</strong> {{ $search['word'] }}
            </div>
            <strong>Results:</strong> {{ $search['count'] }}
        </div>
    @endif

    @if(count($search['cats']) >= 1)
    <div class="search_tags" id="search_tags">
        @php($addClassAll = ($search['cat'] == 0 || $search['cat'] == '') ? 'active' : 'disable')
        <a href="javascript:void" onclick="filtersetTag(0,0);" class="{{ $addClassAll }}">All</a>
        @php($cat_i=1)
        @foreach($search['cats'] as $cat)
            @php($cat_i++)
            @php($setclassCatList = ($search['cat'] == $cat['id']) ? 'active' : 'disable')
            <a href="javascript:void" class="{{ $setclassCatList }}" onclick="filtersetTag({{ $cat_i }},{{ $cat['id'] }});">{{ $cat['title'] }}</a>
        @endforeach
    </div>
    @endif

    
<input type="hidden" value="{{ $search['sort'] }}" id="sortby">
<input type="hidden" value="{{ $search['thing'] }}" id="searchThing">
<input type="hidden" value="{{ $search['cat'] }}" id="searchincat">


<script>

    function filterset(n)
    {   
        if($("#filter_body>a.active").removeClass("active")){
            document.getElementById("filter_body").children[n-1].classList.add("active");
            $('#sortby').val(n);
        }
    }
    
    function filtersetThing(n)
    {   
        if($("#search_uort>a.active").removeClass("active")){
            document.getElementById("search_uort").children[n-1].classList.add("active");
            $('#searchThing').val(n);
        }
    }

    function filtersetTag(n,id)
    {   
        if($("#search_tags>a.active").removeClass("active")){
            
            if(Number(n) == 0 && Number(id) == 0)
            {   //alert();
                document.getElementById("search_tags").children[0].classList.add("active");
            }
            else
            {
                document.getElementById("search_tags").children[n-1].classList.add("active");
            }
            
            $('#searchincat').val(id);
        }
    }
    
    $("#searchgob" ).click(function() {
        var searchform = $('#search_input').val();
        var sortby = $('#sortby').val();
        var searchThing = $('#searchThing').val();
        var searchincat = $('#searchincat').val();
        
        var thing_fixed = (Number(searchThing) != '' && Number(searchThing) != 0) ? searchThing : 1; 
        var thing_sort = (Number(sortby) != '' && Number(sortby) != 0) ? ('/'+sortby) : (   (Number(searchincat) != '' && Number(searchincat) != 0) ? '/4' : ''   ); 
        var thing_cat = (Number(searchincat) != '' && Number(searchincat) != 0) ? ('/'+searchincat) : ''; 
        
        
        if(searchform != '')
        {
            var url = '{{ route ('Search_page', ['thing' => '', 'word' => '', 'sort' => '', 'cat' => '']) }}/'+thing_fixed+'/'+encodeURIComponent(searchform)+thing_sort+thing_cat;
            window.location.href = url;
         
        }
              
    });


    $("#search_input").on('keyup', function (event) {
        if (event.keyCode === 13) {
            $("#searchgob").click();
        }
    });
</script>


@if($search['word'] != '')

    @if($search['thing'] == '1')

        @foreach ($data as $row)

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
                        <span class="post-mtiem-date">{{ $row->created_at }}</span>
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
                        <span class="real-count">61</span>   
                    </div>
                    <div>
                        <span class="material-icons">quickreply</span>
                        <span class="real-count">{{ topic_info($row->id, 'posts_in') }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


    @elseif($search['thing'] == '2')

    <div class="row">
		

		@foreach($data as $user)
        <div class="col-md-4" style="margin-top: 10px;margin-bottom: 10px;">
            <div class="card m-b-30">
                <div class="card-body row">
                    <div class="col-6">
                        <a href="{{ route('user_profile',['id'=>$user->id]) }}"><img src="{{ user_info($user->id, 'avatar') }}" alt="" class="img-fluid rounded-circle w-60"></a>
                    </div>
                    <div class="col-6 card-title align-self-center mb-0">
                        <h5>{{ user_info($user->id, 'name') }}</h5>
                        <p class="m-0">{{ level($user->id) }}</p>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fa fa-envelope float-right"></i>Email : <a href="mailto:{{ user_info($user->id, 'email') }}">{{ user_info($user->id, 'email') }}</a></li>
                    <li class="list-group-item"><i class="far fa-calendar-check float-right"></i>Joined : {{ humman_date(user_info($user->id, 'created_at')) }}</li>
                </ul>
                <div class="card-body">
                    <div class="float-right btn-group btn-group-sm">
                        <a href="{{ route('user_profile',['id'=>$user->id]) }}" class="btn btn-primary tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit"><i class="far fa-user"></i> View Profile</a>
                        <a href="#" class="btn btn-secondary tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-envelope"></i></a>
                    </div>
                    <ul class="social-links list-inline mb-0">
                        {!! get_user_mini_shortcuts($user->id, 3) !!}
                    </ul>
                </div>
            </div>
        </div>
        @endforeach




	</div>
        
    @endif
    

@else
    <div class="search_block">
        <i class="fas fa-search"></i>
    </div>
@endif  


</div>

<!-- start pagination -->
<nav class="pagination-body">
    <ul class="pagination justify-content-center">
        {!! $data->links() !!}
    </ul>
</nav>
<!-- end pagination -->

@endsection