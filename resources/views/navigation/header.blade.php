@guest
<div class="header">
    <div class="topnav" id="navbar">
    <div class="serty-percent flex-left">
        <a class="logolink p-3" href="{{ route('index') }}">
			<img src="{{ asset('front_assets/img/soft/logo/logo1.png') }}" height="50">
		</a>
    </div>
    <div class="search-box serty-percent flex-center flex-sp">
      <input type="text" name="q" placeholder="Search word...">
      <div class="material-icons search-button">search</div>
    </div>
    <div class="login-container serty-percent flex-right">
        @if (Route::has('login'))
        <a href="{{ route('login') }}" class="logreg">
             <span class="material-icons">login</span> 
             <span class="logreg-titles">{{ __('Login') }}</span>
        </a>

        @endif
        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="logreg" id="reglink">
            <span class="material-icons">person_add</span> 
            <span class="logreg-titles">{{ __('Register') }}</span>
        </a>
        @endif
  
      <a onclick="opencatsmenu()" id="nav-triger"><span class="material-icons">reorder</span></a>
    </div>
  </div>
</div>
@else



<div class="header">
  <div class="topnav" id="navbar">
	  <div class="login-container serty-percent" id="left_triger">
	  	<a onclick="w3.toggleShow('#login_cats');opencatsmenu()" id="nav-triger"><span class="material-icons">reorder</span></a>
	  </div>
  <div class="serty-percent flex-left logo-block">
	  <a class="logolink" href="{{ route('index') }}">
		  <img src="{{ asset('front_assets/img/soft/logo/logo1.png') }}" id="logo_def" height="50">
		  <img src="{{ asset('front_assets/img/soft/logo/logo1.png') }}" id="small_logo" height="50"></a>
  </div>
  <div class="search-box serty-percent flex-center flex-sp">
	<input type="text" name="q" id="headerSearchInput" placeholder="Search word...">
	<div class="material-icons search-button" id="HeaderSearchButton">search</div>
  </div>

  <div class="login-container serty-percent flex-right">
	 <a class="notification triger-headcats" onClick="w3.toggleShow('#trig_header-cats')">
		 <span class="material-icons">apps</span>
	 </a>
	 <a href="javascript:w3.toggleShow('#messages-box');load_ddcontacts();" class="notification">
		 <span class="material-icons">mail</span> 
		 <span class="badge bg-dodger text-white" id="inbox_total" style="display: none;">0</span>
	 </a>
	 <a href="javascript:w3.toggleShow('#notifications-box')" class="notification">
		 <span class="material-icons">inbox</span>
		 <span class="badge bg-dodger text-white" id="notifs_total" style="display:none;">0</span>
	 </a>
	 <a class="header_avatar" onclick="w3.toggleShow('#us-li');" title="{{ Auth::user()->name }}">
       <img src="{{ asset(user_info(myid(), 'avatar')) }}" alt="avatar">
    </a>
  </div>	  
</div>
</div>




<div class="dropdowns-container">
	<div class="container bg-warning relative">
		
		
		<div class="u_links overflow-auto thinScrolbar" id="us-li" style="max-height: 220px;display:none">
			<a href="{{ route('user_profile', myid()) }}" class="btn btn-default active">
				<span class="material-icons">account_circle</span>
				Profile
			</a>
      		<a href="{{ route('mysettings') }}" class="btn btn-default">
				<span class="material-icons">settings</span>
				Settings
			</a>
      		<a href="{{ route('logout') }}" class="btn btn-default"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
				<span class="material-icons">power_settings_new</span>
       			 {{ __('Logout') }}
      		</a>
			
   			<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      			@csrf
   			</form>
			
			<div class="dropdown-divider"></div> 
            @if(my('level') == 3)
			<a href="{{ route('dashboard') }}" class="btn btn-default">
				<span class="material-icons">code</span>
				Control Panel
			</a>
            @endif
			
			<a href="{{ route ('Search_page', ['thing' => '', 'word' => '', 'sort' => '', 'cat' => '']) }}" class="btn btn-default">
				<span class="material-icons">search</span>
				Search
			</a>
{{--			<a href="{{ route('member_list') }}" class="btn btn-default">--}}
{{--				<span class="material-icons">people_alt</span>--}}
{{--				Members--}}
{{--			</a>--}}
			<a href="{{ route('show_staffs') }}" class="btn btn-default">
				<span class="material-icons">supervisor_account</span>
				Staff Members
			</a>
			<a href="{{ route('show_banlist') }}" class="btn btn-default">
				<span class="material-icons">person_off</span>
				Banned Members
			</a>
			
			<a href="{{ route('show_rules') }}" class="btn btn-default">
				<span class="material-icons">settings_accessibility</span>
				Therms of use
			</a>

			<a href="{{ route('about_us') }}" class="btn btn-default">
				<span class="material-icons">help_outline</span>
				About us
			</a>
			<a href="{{ route('HelpForm.contact') }}" class="btn btn-default">
				<span class="material-icons">alternate_email</span>
				Contact
			</a>
			

		</div>
		
		<!--messages-->
		<div class="notifications-box" id="messages-box" style="display:none">
			<div class="nb-header">
				<span class="material-icons">mail</span> 
				&nbsp; Messages
			</div>
			<div class="nb-content" id="load_dropdown_contacts">

				<div class="no_notifications" style="display:none;">
					You haven't private messages now
				</div>
				<div class="drpm-sidebar" id="pm-dropdown">
					<div class="allcontacts" id="allcontactsDB_load"><a href="javascript:void" class="non_active-pm"><div class="contact-avatar"><img src="http://laravel.me/upload/avatars/1615665402.png" alt="avatar"></div><div class="contact-username contact-username2"><strong>TEST1</strong><time>12 Mar 2021 - 02:07:48</time></div><div class="online-status"><div class="pm_bullet not-online"></div></div></a></div>
				</div>

			</div>
			<a class="nb-footer" href="{{ route('messages') }}">Massenger</a>
		</div>
		<!--end messages-->





		<div class="notifications-box" id="notifications-box" style="display:none">
			<div class="nb-header">
				<span class="material-icons">notification_important</span> 
				notification(s)
			</div>
			<div class="nb-content" id="ntfsss">

				<div class="no_notifications">
					You haven't notifications now
				</div>
				
			</div>
			<a class="nb-footer" href="{{ route('MyNotifications') }}">see all notifications</a>
		</div>
		
		
		
		<div class="header-categories" id="trig_header-cats" style="display:none;">
			<div class="allcats overflow-auto" id="ins_cats_from">
				{{ list_categories() }}
			</div>
		</div>
		
		
		
	</div>
</div>	






<script>
function load_ddcontacts()
{	
	var all_data = '';
	var zeda_mdzime = "'";
    $.getJSON("{{ route('messages_data', ['contacts']) }}", function(data)
	{
    	$.each(data.ddcontacts, function(i, row){
			all_data += '<a href="'+row.url+'" class="'+row.seen+'"><div class="contact-avatar"><img src="'+row.recipient_avatar+'" alt="avatar"></div><div class="contact-username contact-username2"><strong>'+row.recipient+'</strong><time>'+row.last_time+'</time></div><div class="online-status"><div class="'+row.bullet_class+'"></div></div></a>';
      	});
	  	$('#allcontactsDB_load').html(all_data);
    });
}




if(typeof(EventSource) !== "undefined") {
	
	var source = new EventSource("{{ route('total_notifications') }}");
  	source.onmessage = function(event) 
	{
    	if(Number(event.data) == 0)
		{
			w3.hide('#notifs_total');
			w3.show('#resultsnotfount_nf');
		}
		else
		{
			w3.show('#notifs_total');
			if(Number(event.data) != $("#notifs_total").html())
			{
				$("#notifs_total").html(event.data);
			
				$.getJSON("{{ route('my_notifications_json') }}", 
				function (data) { 
					var student = ''; 
					var mdzime="'";

					$.each(data.records, function (key, value) { 	
						student += '<div class="nf-item"><div class="notifications_icons"><span class="material-icons ' + value.see_class + '">inbox</span></div><div class="notifications-message-text" onclick="location.href = ' +mdzime+value.link_to+mdzime+ ';">' + value.text + '</div></div>';
					}); 
	
					$('#ntfsss').html(student);
				}); 
			}

		}

  	};

	var pm_source = new EventSource("{{ route('messages_data', ['countpms']) }}");
	pm_source.onmessage = function(event) 
	{
		if($('#inbox_total').text() != Number(event.data))
		{
			if(Number(event.data) == 0)
			{
				w3.hide('#inbox_total');
			}
			else
			{
				w3.show('#inbox_total');
				
				load_ddcontacts();
				@if(thisroute() == "messages")
					$('#big_pmbadge').text(Number(event.data));
					load_allcontacts();
				@endif
			}
		
			$('#inbox_total').text(Number(event.data));
		}//if not equal
		

	}//if event


	@if(thisroute() == "messages" && $id >= 1)
		var source_realtimer = new EventSource("{{ route('messages_data', ['cconversition', 'count' => $id]) }}");
		source_realtimer.onmessage = function(event) 
		{   
        	if(Number(event.data) >=1 && Number(event.data) != Number($("#total_now").val()) )
			{
        		$("#total_now").val(Number(event.data));
            	load_pm_dialogs({{ $id }},{{ PMTopicWOS($id, 'recipient') }});
        	}
    	};
	@endif







}// if supported 
else {
	alert("Sorry, your browser does not support server-sent events...");
}

</script>
{{ YouAreOnline() }}
@endguest


<!--Leftbar menu-->
<div class="overflow-auto transformer" id="cats-menu" style="display:none;">
    <div class="only-desktop">	
        <div class="card-header bg-white text-uppercase bold">
              Menu <span onclick="opencatsmenu()" class="material-icons pull-right">sort</span>
        </div>
        @guest
        <div class="ml-3 mr-3 mt-2">
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-block">
                {{ __('Login') }}
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-success btn-block">
                {{ __('Register') }}
            </a>
        </div>
        @endguest
        <div class="card-body bg-white p-0 ml-3 mr-4 mt-0">
              <div class="accordion">

                  <div class="bg-white p-0">
                    <div class="flex-sp">
                        <input type="text" name="q" id="leftsidemenu_SearchInput" placeholder="Search word...">
                        <div id="leftmenu_searchbutton" class="material-icons search-button">search</div>
                    </div>
                  </div>
                
              </div>
        </div>

    </div>
    
    <!-- menu logreg block end -->

    @if(count_statistics('categories')>=1)   
    <div class="card-header bg-white text-uppercase bold">
        Categories <span onclick="opencatsmenu()" class="material-icons pull-right icon-to-hide">sort</span>
    </div>
    <div class="allcats">
        {{ list_categories() }}
    </div>
    @endif
</div>
<!--end leftbar menu-->




<script>
$(document).ready(function(){

	$("#HeaderSearchButton" ).click(function() {
		var searchform = $('#headerSearchInput').val();
		if(searchform != '')
		{
			var url = '{{ route ('Search_page', ['thing' => '1', 'word' => '', 'sort' => '', 'cat' => '']) }}/'+encodeURIComponent(searchform);
			window.location.href = url;
		}
		  
	});


	$("#headerSearchInput").on('keyup', function (event) {
		if (event.keyCode === 13) {
			$("#HeaderSearchButton").click();
		}
	});  




	$("#leftmenu_searchbutton" ).click(function() {
		var searchform = $('#leftsidemenu_SearchInput').val();
		if(searchform != '')
		{
			var url = '{{ route ('Search_page', ['thing' => '1', 'word' => '', 'sort' => '', 'cat' => '']) }}/'+encodeURIComponent(searchform);
			window.location.href = url;
		}
		  
	});


	$("#leftsidemenu_SearchInput").on('keyup', function (event) {
		if (event.keyCode === 13) {
			$("#leftmenu_searchbutton").click();
		}
	});

});

</script>


@if(CheckBan('status') > 0)
	@if(thisroute() != 'show_rules')
		@php
			$reditect_to = route('show_rules');
			header("Location: " . URL::to($reditect_to), true, 302);
			exit();
		@endphp
	@endif

	{!! CheckBan('message') !!}
@endif

<div id="header-sized-space"></div>
{{ OnlineUsers() }}

