@extends('layouts.general2-container')
@section('title', user_info($uid, 'name'))
@section('content')


<div class="main-body">
    
  <!-- Breadcrumb -->
  <div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('home') }}" class="btn btn-default"><i class="fas fa-home"></i></a>
        <a href="{{ route('member_list') }}" class="btn btn-default">Members</a>
    </div>
  </div>
  <!-- /Breadcrumb -->


  @auth
    @if($uid != myid() && my('level') >=1 && my('level') <=3 && my('level') > user_info($uid, 'level'))
   
    <!-- Move topic Modal -->
    <div class="modal fade" id="ban_modal">
      <div class="modal-dialog">
          <div class="modal-content">
    
              <!-- Modal Header -->
              <div class="modal-header">
                  <div class="modal-header-title">Ban <b>{{ user_info($uid, 'name') }}</b></div>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
      
              <!-- Modal body -->
              <div class="modal-body">
                @if(ban_info($uid, 'banned_till') < dayXnow())
                <div class="alert alert-warning fade in alert-dismissible show" style="font-size: 15px;">
                  <strong>Warning!</strong> Before you block this user, please note that the user registered on the site must follow the consumer rules regardless of his status. Unserved blocking for the customer involves blocking.
                </div>
                @else
                <div class="card-body bg-white text-center" style="font-size: 15px;">
                  <strong>Edit current Ban status</strong>
                </div>
                @endif


                <form name="form" action="{{ route('user_profile',[$uid]) }}" method="post">
                  @csrf
                  <label for="comment">Baning reason (max:250):</label>
                  @if(ban_info($uid, 'banned_till') < dayXnow())
                    <textarea class="form-control mb-3" name="reason" rows="5" id="comment"></textarea>
                  @else
                    <textarea class="form-control mb-3" name="reason" rows="5" id="comment">{{ ban_info($uid, 'reason') }}</textarea>
                  @endif
                  <div class="inpnav">Duration</div>
                  <select class="custom-select mt-3" name="ban_duration" id="myselect">
                    @foreach($BanTimes as $BanTime)
                      <option value="{{ $BanTime['duration_minutes'] }}">{{ $BanTime['title'] }}</option>
                    @endforeach
                    @if(ban_info($uid, 'banned_till') >= dayXnow())
                      <option value="1">Unban (In a minute)</option>
                    @endif
                  </select>
                  <input type="submit" style="display:none !important;" id="banNow" value="Let`s ban">
                </form>

              </div>
      
              <!-- Modal footer -->
              <div class="modal-footer">
                @if(ban_info($uid, 'banned_till') < dayXnow())
                  <button type="button" class="btn btn-danger btn-custom" id="banuser"><i class="fas fa-user-alt-slash"></i> Ban</button>
                @else
                  <button type="button" class="btn btn-danger btn-custom" id="banuser"><i class="fas fa-user-alt-slash"></i> Re-Ban</button>
                @endif
                  <button type="button" class="btn btn-primary btn-custom" data-dismiss="modal"><i class="far fa-times-circle"></i> Cancel</button>
              </div>
      
          </div>
      </div>
    </div>

    <script>
      $(document).ready(function(){
        $("#banuser").click(function(){
          $('#banNow').click();
        });
      });
    </script>
      
    @endif
  @endauth

  <div class="row gutters-sm">
    <div class="col-md-4 mb-3 paddingzero">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-column align-items-center text-center">
            <img src="{{ user_info($uid, 'avatar') }}" alt="{{ user_info($uid, 'name') }}" class="rounded-circle" width="150">
            <div class="mt-3">
              <h4>{{ user_info($uid, 'name') }}</h4>
              <p class="text-muted font-size-sm mb-1">{{ level($uid) }}</p>
              @if(!empty(user_info($uid, 'profession'))) <p class="text-secondary mb-1">{{ user_info($uid, 'profession') }}</p>@endif
              @if(!empty(user_info($uid, 'location'))) <p class="text-muted font-size-sm">{{ user_info($uid, 'location') }}</p>@endif
              @auth
                @if($uid != myid())
                  <a href="{{ pmlink($uid) }}" class="btn btn-outline-primary">Private message</a>
                @endif
              @endauth
            </div>
          </div>
        </div>
      </div>
      
      @if(ban_info($uid, 'banned_till') >= dayXnow())
      <div class="card-body bg-white">
        <div class="alert alert-danger" style="font-size:14px;">
          Banned for Violation of the rules Till <strong>{{ ban_info($uid, 'banned_till') }}</strong><br> {{ ban_info($uid, 'reason') }}
        </div>
      </div>
      @endif
      
      @if(!empty(get_user_shortcuts($uid)))
      <div class="card mt-3">
        <ul class="list-group list-group-flush">
          {!! get_user_shortcuts($uid) !!}
        </ul>
      </div>
      @endif

      @auth
        @if($uid != myid() && my('level') >=1 && my('level') <=3 && my('level') > user_info($uid, 'level') && user_info($uid, 'owner') != 1)
        <ul class="list-group mt-3">
          <li class="list-group-item"><strong> Moderate </strong></li>
          <li class="list-group-item">
            @if(my('level')==3)
            <a href="{{ route('UserModSettings',[$uid]) }}" class="btn btn-outline-info btn-sm"> Edit Info </a>
            @endif
            @if(ban_info($uid, 'banned_till') < dayXnow())
              <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#ban_modal"> Ban </button>
            @else
            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#ban_modal"> Edit Ban status </button>
            @endif
          </li>
        </ul> 
        @endif
      @endauth





      <div class="card-body bg-white mt-3">
        <h6 class="d-flex align-items-center mb-3"><span class="material-icons text-info mr-2">sticky_note_2</span>Topic statistics</h6>
      
        @foreach ($categories as $row)
    
          <small>{{ $row->title }}</small>
          <div class="progress mb-3" style="height: 5px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ procenti(count_topics_incatBy($row->id, $uid), count_statistics_by('topics', $uid)) }}%" aria-valuenow="{{ procenti(count_topics_incatBy($row->id, $uid), count_statistics_by('topics', $uid)) }}" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          
        @endforeach
         
      </div>

      <div class="card-body bg-white mt-3">
        <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">chat</i>Posts statistics</h6>
        @foreach ($categories as $row)

        <small>{{ $row->title }}</small>
        <div class="progress mb-3" style="height: 5px">
          <div class="progress-bar bg-primary" role="progressbar" style="width: {{ procenti( count_posts_incatBy($row->id, $uid), count_statistics_by('posts', $uid)) }}%" aria-valuenow="{{ procenti( count_posts_incatBy($row->id, $uid), count_statistics_by('posts', $uid)) }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      
        @endforeach
       
      </div>
  
      
    </div>
    <div class="col-md-8 paddingzero">
      <div class="card mb-3">
    
        <div class="card-body">
          @if(!empty(user_info($uid, 'social_msg')))
          <div class="social_msg mt-0 mb-5">{{ user_info($uid, 'social_msg') }}</div>
          @endif
          @if(!empty(user_premissed_at($uid)))
          <div class="row">
            <div class="col-sm-3" id="frt3r4t43r34">
              <h6 class="mb-0">{{ level($uid) }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              {!! user_premissed_at($uid) !!}
            </div>
          </div>
          <hr>
          @endif

          @if(!empty(user_info($uid, 'full_name')))
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Full Name</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              {{ user_info($uid, 'full_name') }}
            </div>
          </div>
          <hr>
          @endif
          
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Email</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              {{ user_info($uid, 'email') }}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Joined</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              {{ humman_date(user_info($uid, 'created_at')) }}
            </div>
          </div>
          
          @if(!empty(user_info($uid, 'location')))
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Address</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              {{ user_info($uid, 'location') }}
            </div>
          </div>
          @endif

          @if(!empty(gender($uid)))
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Sex</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              {{ gender($uid) }}
            </div>
          </div>
          @endif


        </div>
      </div>


    @if($topicsby->count()>=1)
      <div class="card-header bg-white text-uppercase bold">
        Topics by  {{ user_info($uid, 'name') }}<span class="material-icons pull-right">timeline</span>
      </div>
      @foreach($topicsby as $row)
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
   
      <!-- start pagination -->
      <nav class="pagination-body m-0">
        <ul class="pagination justify-content-center">
          {!! $topicsby->links() !!}
        </ul>
      </nav>
      <!-- end pagination -->

    @endif


    </div>
  </div>
</div>










@endsection