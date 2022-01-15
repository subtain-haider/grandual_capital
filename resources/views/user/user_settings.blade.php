@extends('layouts.general2-container')

@if($subpage=="")
  @section('title', user_info($id, "name").' - Settings')
@elseif($subpage=='account')
  @section('title', user_info($id, "name").' - Account')  
@elseif($subpage=='shortcuts')
  @section('title', user_info($id, "name").' - Shortcuts')
@elseif($subpage=='level')
  @section('title', user_info($id, "name").' - Level')
@endif





@section('content')


<!-- Breadcrumb -->
<div class="breadcrumb-container overflow-auto">
  <div class="btn-group btn-breadcrumb">
      <a href="{{ route('home') }}" class="btn btn-default"><i class="fas fa-home"></i></a>
      <a class="btn btn-default">User</a>
      @if($subpage=="")
      <a href="{{ route('UserModSettings', [$id]) }}" class="btn btn-default">Settings</a>
      @elseif($subpage=='account')
      <a href="{{ route('UserModSettings', [$id, 'account']) }}" class="btn btn-default">Account</a>
      @elseif($subpage=='shortcuts')
      <a href="{{ route('UserModSettings', [$id, 'shortcuts']) }}" class="btn btn-default">Shortcuts</a>
      @elseif($subpage=='level')
      <a href="{{ route('UserModSettings', [$id, 'level']) }}" class="btn btn-default">Level</a>
      @endif
      
  </div>
</div>
<!-- /Breadcrumb -->

@if($subpage=='')
<!-- Modal -->
<div class="modal fade" id="chang_avatar_window" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Change avatar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <div id="upload-demo"></div>
        <input type="file" name="thefile" style="display:none;" id="image">
        @csrf
      
      </div>
      <div class="modal-footer">
        <div id="modalmessages" style="width:100%"></div>
        <div class="avaupload-buttons">
            <div class="browse_ava" id="browse_ava" title="Choose image">
              <i class='fas fa-image' style='font-size:28px'></i>
            </div>
            <div class="ava_rightsb">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button class="btn btn-primary btn-upload-image">Upload</button> 
            </div>
        </div>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
 
 
 $(document).ready(function(){
  $("#browse_ava").click(function(){
    $("#image").click();
  });
});

  var resize = $('#upload-demo').croppie({
      enableExif: true,
      enableOrientation: true,    
      viewport: { // Default { width: 100, height: 100, type: 'square' } 
          width: 200,
          height: 200,
          type: 'circle' //square
      },
      boundary: {
          width: 300,
          height: 300
      }
  });
  
  
  $('#image').on('change', function () { 
    var reader = new FileReader();
      reader.onload = function (e) {
        resize.croppie('bind',{
          url: e.target.result
        }).then(function(){
         
          var name = document.getElementById('image'); 
          $('#modalmessages').html('<div class="alert alert-primary" role="alert" style="width:100%;">'+name.files.item(0).name+'</div>');

        });
      }
      reader.readAsDataURL(this.files[0]);
  });
  
  
  $('.btn-upload-image').on('click', function (ev) {
    resize.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function (img) {
  
      /*Ajax Request Header setup*/
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      var moderate_user = "{{ $id }}";
      ev.preventDefault();
      
      $.ajax({
        type:'POST',
        url:"{{ route('upavatar.action') }}",
        data:{avatar:img, moderate_user: moderate_user},
        success:function(data){
        $('#myavatar').html('<img src="'+data.file_url+'" style="max-width:100%">');
        $('#file_name').css('display', 'none');
        $('#file_name').css('display', 'block');

        if(data.file_url == '0')
        {
            $('#modalmessages').html('<div class="alert alert-danger"  role="alert" style="width:100%;">'+data.message+'</div>');
        }
        else
        {
            $('#modalmessages').html('<div class="alert alert-success" role="alert" style="width:100%;">'+data.message+'</div>');
            $('#chang_avatar_window').slideUp(2000);
            //$('#chang_avatar_window').parent().animate({opacity: 0}, 500).hide('slow');
            $(".modal-backdrop").remove();
            $(".modal-open").css("overflow-y", "scroll");
        }
        
      }
      
      });
  
    });
  });
  
  
</script>
@endif

<div class="row flex-lg-nowrap">
    <div class="col-12 col-lg-auto mb-3 paddingzero" style="width: 200px;">
      <div class="card p-3">
        <div class="e-navlist e-navlist--active-bg">
          <ul class="nav">
            <li class="nav-item"><a class="nav-link px-2 active" href="{{ route('index') }}"><i class="fas fa-fw fa-home mr-1"></i><span>Home</span></a></li>
            <li class="nav-item"><a class="nav-link px-2" href="{{ route('user_profile', $id) }}"><i class="fas fa-fw fa-user mr-1"></i><span>Profile</span></a></li>
            <li class="nav-item"><a class="nav-link px-2" href="{{ route('UserModSettings', [$id]) }}"><i class="fa fa-fw fa-cog mr-1"></i><span>Settings</span></a></li>
            <li class="nav-item"><a class="nav-link px-2" href="{{ route('UserModSettings', [$id, 'shortcuts']) }}"><i class="fas fa-fw fa-tablet-alt mr-1"></i><span>Shortcuts</span></a></li>
            <li class="nav-item"><a class="nav-link px-2" href="{{ route('UserModSettings', [$id, 'account']) }}"><i class="fas fa-fw fa-unlock-alt mr-1"></i><span>Account</span></a></li>
            @if(user_info($id, 'owner') != 1 && user_info($id, 'level') < my('level') && my('level') == 3)
              <li class="nav-item"><a class="nav-link px-2" href="{{ route('UserModSettings', [$id, 'level']) }}"><i class="fas fa-fw fa-user-secret mr-1"></i><span>Level</span></a></li>        
            @endif
          </ul>
        </div>
      </div>
    </div>
  
    <div class="col paddingzero">
      <div class="row">
        <div class="col mb-3">
          <div class="card">
            <div class="card-body">
              <div class="e-profile">
                <div class="row">
                  <div class="col-12 col-sm-auto mb-3">
                    <div class="mx-auto" style="width: 140px;">
                      <div class="d-flex justify-content-center align-items-center rounded" id="myavatar" style="height: 140px; background-color: rgb(233, 236, 239);">
                        <img src="{{ user_info($id, 'avatar') }}" alt="{{ user_info($id, 'name') }}" class="rounded-circle" width="150">
                      </div>
                    </div>
                  </div>
                  <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                    <div class="text-center text-sm-left mb-2 mb-sm-0">
                      <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ user_info($id, 'name') }}</h4>
                   
                      @if(!empty(user_info($id, 'profession'))) <p class="mb-0">{{ user_info($id, 'profession') }}</p>@endif
                      @if(!empty(user_info($id, 'location'))) <div class="text-muted"><small>{{ user_info($id, 'location') }}</small></div>@endif
                      
                      @if($subpage=='')
                      <div class="mt-2">
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#chang_avatar_window">
                          <i class="fa fa-fw fa-camera"></i>
                          <span>Change Photo</span>
                        </button>
                      </div>
                      @endif
                    </div>
                    <div class="text-center text-sm-right">
                      <span class="badge badge-secondary">{{ level($id) }}</span>
                      <div class="text-muted"><small>{{ humman_date(user_info($id, 'created_at')) }}</small></div>
                    </div>
                  </div>
                </div>
                <ul class="nav nav-tabs">
                  @if($subpage=='')
                  <li class="nav-item"><a href="{{ route('UserModSettings', [$id]) }}" class="active nav-link">Settings</a></li>
                  <li class="nav-item"><a href="{{ route('UserModSettings', [$id, 'account']) }}" class="nav-link">Account</a></li>
                  <li class="nav-item"><a href="{{ route('UserModSettings', [$id, 'shortcuts']) }}" class="nav-link">Shortcuts</a></li>
                  @if(user_info($id, 'owner') != 1 && user_info($id, 'level') < my('level') && my('level') == 3)
                    <li class="nav-item"><a href="{{ route('UserModSettings', [$id, 'level']) }}" class="nav-link">Level</a></li>
                  @endif

                  @elseif($subpage=='account')
                  <li class="nav-item"><a href="{{ route('UserModSettings',[$id]) }}" class="nav-link">Settings</a></li>
                  <li class="nav-item"><a href="{{ route('UserModSettings', [$id, 'account']) }}" class="active nav-link">Account</a></li>
                  <li class="nav-item"><a href="{{ route('UserModSettings', [$id, 'shortcuts']) }}" class="nav-link">Shortcuts</a></li>
                  @if(user_info($id, 'owner') != 1 && user_info($id, 'level') < my('level') && my('level') == 3)
                    <li class="nav-item"><a href="{{ route('UserModSettings', [$id, 'level']) }}" class="nav-link">Level</a></li>
                  @endif
                
                  @elseif($subpage=='shortcuts')
                  <li class="nav-item"><a href="{{ route('UserModSettings', [$id]) }}" class="nav-link">Settings</a></li>
                  <li class="nav-item"><a href="{{ route('UserModSettings', [$id, 'account']) }}" class="nav-link">Account</a></li>
                  <li class="nav-item"><a href="{{ route('UserModSettings', [$id, 'shortcuts']) }}" class="active nav-link">Shortcuts</a></li>

                  @if(user_info($id, 'owner') != 1 && user_info($id, 'level') < my('level') && my('level') == 3)
                    <li class="nav-item"><a href="{{ route('UserModSettings', [$id, 'level']) }}" class="nav-link">Level</a></li>
                  @endif

                  @elseif($subpage=='level')
                  <li class="nav-item"><a href="{{ route('UserModSettings', [$id]) }}" class="nav-link">Settings</a></li>
                  <li class="nav-item"><a href="{{ route('UserModSettings', [$id, 'account']) }}" class="nav-link">Account</a></li>
                  <li class="nav-item"><a href="{{ route('UserModSettings', [$id, 'shortcuts']) }}" class="nav-link">Shortcuts</a></li>
                    @if(user_info($id, 'owner') != 1 && user_info($id, 'level') < my('level') && my('level') == 3)
                    <li class="nav-item"><a href="{{ route('UserModSettings', [$id, 'level']) }}" class="active nav-link">Level</a></li>
                    @endif
                  @endif
                </ul>

                <div class="tab-content pt-3">
                  <div class="tab-pane active">
                    <form class="form" action="" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $id }}" required="">
                    @if(!empty($success_msg))
                    <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true" style="font-size:20px">×</span>
                      </button>
                      <strong>Success!</strong> {{ $success_msg }}
                    </div>
                    @endif

                    @if(!empty($warrning_msg))
                    <div class="alert alert-warning fade in alert-dismissible show">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true" style="font-size:20px">×</span>
                      </button>    
                      <strong>Warning!</strong> {{ $warrning_msg }}
                    </div>
                    @endif

                    @if($subpage=='')
                      <div class="row">
                        <div class="col">
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Full Name</label>
                                <input class="form-control" type="text" name="name" placeholder="Name Surname..." value="{{ user_info($id, 'full_name') }}">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" type="text" name="username" placeholder="{{ user_info($id, 'name') }}" value="{{ user_info($id, 'name') }}">
                              </div>
                            </div>
                          </div>



                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Sex</label>
                                <select class="custom-select" name="sex">
                                  <option value="0" selected="">Select your gender</option>
                                  <option value="1">Female</option>
                                  <option value="2">Male</option>
                                  <option value="3">Custom</option>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" type="text" name="address" value="{{ user_info($id, 'location') }}" placeholder="California, LA...">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Profeesion</label>
                                <input class="form-control" type="text" name="profeesion" value="{{ user_info($id, 'profession') }}" placeholder="Your proffession here...">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col mb-3">
                              <div class="form-group">
                                <label>Soacial message</label>
                                <textarea class="form-control" rows="5" name="social_msg" placeholder="Write something what would you say to people...">{{ user_info($id, 'social_msg') }}</textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif

                    @if($subpage=='account')
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <div class="mb-2"><b>Email</b></div>
                            <input class="form-control" type="email" name="email" placeholder="{{ user_info($id, 'name') }}" value="{{ user_info($id, 'email') }}">
                            @error('email')
                              <span class="invalid-feedback" style="display:block !important;" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </div>

                        <div class="col-12 col-sm-6 mb-3">
                          <div class="mb-2"><b>Change Password</b></div>
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Current Password</label>
                                <input class="form-control" type="password" name="password" placeholder="••••••">
                                @error('password')
                                <span class="invalid-feedback" style="display:block !important;" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>New Password</label>
                                <input class="form-control" type="password" name="newpassword" placeholder="••••••">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                <input class="form-control" type="password" name="repeatpassword" placeholder="••••••"></div>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                    @endif








                    @if($subpage=='shortcuts')
                      <div class="row">
                        <div class="col">
                          <div class="form-group">


                            <div class="dropdown">
                              <div class="show-snes" data-toggle="dropdown"> Add shortcat </div>
                              <div class="dropdown-menu" style="width: 100% !important;">
                                
                                @foreach ($shortcuts as $shortcut)
                                  <a class="snes-item" id="drepdown_sn_id_{{ $shortcut->id }}" onclick="addShortcut('{{ $shortcut->icon }}','{{ $shortcut->color }}', '{{ $shortcut->title }}','{{ $shortcut->id }}');" style="color: #{{ $shortcut->color }}; font-weight: bold;font-size:15px;">
                                    <i class="{!! $shortcut->icon !!}"></i>{{ $shortcut->title }}
                                  </a>
                                @endforeach
                                
            
                              </div>
                            </div>




                            <div class="form-group mb-3" style="margin-top: 10px;">
                              <label>Enter url</label>
                              <div class="input-group ">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-white" id="addShortcatformIcon">@</span>
                                </div>
                                <input type="text" class="form-control custominputheight" id="addSNS" placeholder="http://...">
                              </div>
                              <button type="button" id="appendsm" class="btn btn-outline-success btn-sm" style="width: 100%;margin: 5px auto">Add</button>
                              <button type="button" id="reappendsm" class="btn btn-outline-info btn-sm" style="width: 100%;margin: 5px auto; display:none;">Edit</button>
                            </div> 

                          </div>
                        </div>

                        <div class="col-12 col-sm-6 mb-3">
                          <div class="row">
                            <div class="col">
                              <ul class="list-group" id="mylinks_sm">
                                {!! get_shortcuts($id) !!}
                              </ul> 
                            </div>
                          </div>
                        
                        </div>
                        
                      </div>
                      
                      <div style="display:none !important;">
                        <textarea name="keepenCode" id="keepenCode">{{ user_info($id, 'shortcuts') }}</textarea>
                        <button id="sendform" type="submit">Keep Changes</button>
                      </div>

                      <div class="row">
                        <div class="col d-flex justify-content-end">
                          <button type="button" id="savechanges" class="btn btn-primary">Save Changes</button>
                        </div>
                      </div>


                      <script>
                        
                        $("#savechanges").click(function(){
                        
                          var c = document.getElementById('mylinks_sm').children;
                          var Convert = '';
                          var i;
                          var mdzime;
                          for (i = 0; i < c.length; i++) 
                          { 
                            if(c.length >=2 && i < c.length-1){
                                mdzime  = ',';
                            }
                            else
                            {
                                mdzime = '';
                            }
                            var toset_num = c[i].getAttribute('toset_num');
                            var toset_url = c[i].getAttribute('toset_url');
                            Convert += '[sm='+toset_num+']'+toset_url+'[/sm]'+mdzime;
                          }
  
                          
                          if($('#keepenCode').val(Convert)){
                            $('#sendform').click();
                          }

  
                        });
  
                        $(document).ready(function(){
                            dodododo();    
                        });
  
                        function dodododo() {
                          var c = document.getElementById('mylinks_sm').children;
                          var i;
                          for (i = 0; i < c.length; i++) {
                            var str = c[i].getAttribute('id');
                            var res = str.replace(/\D/g, "");
  
                            w3.hide('#drepdown_sn_id_'+res);
                          }
  
                        }
  
                        function addShortcut(code, color, sn, num)
                        { 
                          var myEle = document.getElementById("mylink_sn_"+Number(num));
                          
                          if(myEle == null) 
                          { 
                            $('#reappendsm').hide();
                            $('#appendsm').show();
                          }
                          else
                          { 
                     
                            $('#reappendsm').show();
                            $('#appendsm').hide();
                            
                            $('#addSNS').val(myEle.getAttribute('toset_url'));
                          }
  
                          $('#addShortcatformIcon').html('<i class="'+code+'" num="'+num+'" site="'+sn+'" clr="'+color+'" style="color: #'+color+';""></i>');
  
                        }
                      
                        $("#appendsm").click(function(){
                          if($('#addSNS').val() !="")
                          {
                            var qwer = $('#addShortcatformIcon > i').attr('class');
                            var qwerstyle = $('#addShortcatformIcon > i').attr('style');
                            var site = $('#addShortcatformIcon > i').attr('site');
                            var snnum = $('#addShortcatformIcon > i').attr('num');
                            var clr = $('#addShortcatformIcon > i').attr('clr');
                            var smurl = $('#addSNS').val();
                            
                            var m = "'";
                            var onclick = "addShortcut("+m+qwer+m+","+m+clr+m+","+m+site+m+","+m+snnum+m+")";
                            
                            $('#addShortcatformIcon i').each(function(index)
                            {
                                if(smurl != "")
                                { 
                                  $("#mylinks_sm").append('<li id="mylink_sn_'+snnum+'" class="list-group-item heveredf2" toset_num="'+snnum+'" toset_url="'+smurl+'" toset_clr="'+clr+'"><i class="'+qwer+'" style="'+qwerstyle+'"></i> '+site+' <span class="smallbadge pull-right"> <button type="button" class="btn btn-outline-info btn-sm" onclick="'+onclick+'"><i class="fas fa-edit"></i></button> <button type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></button></span></li>');
                                }
                            });

                            $('#addSNS').val('');
                            $('#addShortcatformIcon').html('@');
                            $('#drepdown_sn_id_'+snnum).hide();
                          }
  
                        });
                      
                        $("#reappendsm").click(function(){
                          if($('#addSNS').val() !="")
                          {
                            var qwer = $('#addShortcatformIcon > i').attr('class');
                            var qwerstyle = $('#addShortcatformIcon > i').attr('style');
                            var site = $('#addShortcatformIcon > i').attr('site');
                            var snnum = $('#addShortcatformIcon > i').attr('num');
                            var clr = $('#addShortcatformIcon > i').attr('clr');
                            var smurl = $('#addSNS').val();
                            var m = "'";
                            $('#mylink_sn_'+Number(snnum)).remove();
                            
                            var onclick = "addShortcut("+m+qwer+m+","+m+clr+m+","+m+site+m+","+m+snnum+m+")";
                            $('#addShortcatformIcon i').each(function(index)
                            {
                              if(smurl != "")
                              { 
                                $("#mylinks_sm").append('<li id="mylink_sn_'+snnum+'" class="list-group-item heveredf2" toset_num="'+snnum+'" toset_url="'+smurl+'" toset_clr="'+clr+'"><i class="'+qwer+'" style="'+qwerstyle+'"></i> '+site+' <span class="smallbadge pull-right"> <button type="button" class="btn btn-outline-info btn-sm" onclick="'+onclick+'"><i class="fas fa-edit"></i></button> <button type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></button></span></li>');
                              }
                            });

                            $('#addSNS').val('');
                            $('#addShortcatformIcon').html('@');
                            $('#drepdown_sn_id_'+snnum).hide();
                          }
  
                        });
  
                        function delSN(n)
                        {
                          $('#mylink_sn_'+Number(n)).remove();
                          w3.show('#drepdown_sn_id_'+Number(n));
                        }
                      </script>


                      


                      @elseif($subpage=='level')
                      
                      @php
                        $levels = [
                          0 => 'Member',
                          1 => 'Moderator',
                          2 => 'Global Moderator',
                          3 => 'Administrator'
                        ];

                        $account_disabled['checked'] = (user_info($id, 'disable_account') == "on") ? 'checked' : '';
                      @endphp
                
                      <div class="row">

                        <div class="col">
                          <div class="form-group">
                            <div class="mb-2"><b>Level</b></div>
                            <select name="levelup" class="custom-select mb-3">
                              @foreach($levels as $x => $val)
                                @if(user_info($id, 'level') == $x)
                                  <option value="{{ $x }}" selected>{{ $val }}</option>
                                @else
                                  <option value="{{ $x }}">{{ $val }}</option>
                                @endif
                              @endforeach
                            </select>
                          </div>


                          <div class="form-group pl-3 pr-3 mb-2">
                            <label class="disable_account">Disable user account</label><br>
                            <label class="switch">
                              <input type="checkbox" id="disable_account" name="disable_account" {{ $account_disabled['checked'] }}>
                              <span class="switch-slider round"></span>
                            </label>
                          </div>








                        </div>
                    
                      </div>
                    @endif


                      @if($subpage != 'shortcuts')
                      <div class="row">
                        <div class="col d-flex justify-content-end">
                          <button class="btn btn-primary" type="submit">Keep Changes</button>
                        </div>
                      </div>
                      @endif
                    </form>
  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <div class="col-12 col-md-3 mb-3">
          <div class="card mb-3">
            <div class="card-body">
              <div class="px-xl-3">
                <a href="{{ route('logout') }}" class="btn btn-block btn-secondary">
                  <i class="fa fa-sign-out"></i>
                  <span>{{ __('Logout') }}</span>
                </a>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h6 class="card-title font-weight-bold">Support</h6>
              <p class="card-text">Get fast, free help from our friendly assistants.</p>
              <a href="{{ route('HelpForm.contact') }}" class="btn btn-primary">
					Contact Us
				</a>
            </div>
          </div>
        </div>
      </div>
  
    </div>
  </div>









@endsection