@if(ad_Info(2,'ad_show')=="on")
    <div class="text-center">
        {!! ShowAd(2) !!}
    </div>
    <div style="min-height: 20px"></div>
@endif

    
    
<!-- menu logreg block end -->
@if(count_statistics('categories')>=1)   
<div class="card-header bg-white text-uppercase bold">
    Categories <span onclick="opencatsmenu()" class="material-icons pull-right icon-to-hide">sort</span>
</div>
<div class="allcats">
    {{ list_categories() }}
</div>
@endif


<div style="min-height: 20px"></div>

@if(ad_Info(3,'ad_show')=="on")
    <div class="text-center">
        {!! ShowAd(3) !!}
    </div>
    <div style="min-height: 20px"></div>
@endif

@if(count_statistics('posts')>=1)
<div class="card-header bg-white text-uppercase bold">
      Artive Postes  <span class="material-icons pull-right">whatshot</span>
</div>	
{{ xposts() }}
@endif

<div style="min-height: 20px"></div>
@if(ad_Info(4,'ad_show')=="on")
    <div class="text-center">
        {!! ShowAd(4) !!}
    </div>
    <div style="min-height: 20px"></div>
@endif
  
<div class="card-header bg-white text-uppercase bold">
      Statistics  <span class="material-icons pull-right">leaderboard</span>
</div>	
<div class="block_statistics">
    Total users online: {{ OnlineUsers('all') }}<br>
	Guests: {{ OnlineUsers('guests') }}<br>
	Members: {{ OnlineUsers('logged') }}<br>
	Latest registered user:
	<a href="/users.php?u=2">{{ LastUser() }}</a>
</div>
<div class="card-body bg-white">  
    <div class="row">
        <div class="col-4 text-center bg-white">
            <span class="material-icons staticons">sticky_note_2</span>
            <div class="stat-count">{{ count_statistics('topics') }}</div>
        </div>
        <div class="col-4 text-center bg-white">
            <span class="material-icons staticons">chat</span>
            <div class="stat-count">{{ count_statistics('posts') }}</div>
        </div>
        <div class="col-4 text-center bg-white">
            <span class="material-icons staticons">people</span>
            <div class="stat-count">{{ count_statistics('users') }}</div>
        </div>
    </div>
</div>

@if(ad_Info(5,'ad_show')=="on")
    <div style="min-height: 20px"></div>
    <div class="text-center">
        {!! ShowAd(5) !!}
    </div>
@endif