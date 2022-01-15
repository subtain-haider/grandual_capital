@extends('layouts.general_layout')
@section('title', 'Notifications')
@section('content')

<div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('home') }}" class="btn btn-default"><i class="fas fa-home"></i></a>
        <a href="{{ route('MyNotifications') }}" class="btn btn-default">Notifications</a>
    </div>
</div>

<div class="all_post_items_container">
 
  
        <div class="container_notif">
            <div class="clear_orsee">
                <div class="c_o_s" title="Mark as read" id="markasread"><i class="fas fa-eye" aria-hidden="true"></i></div>
                <div>Notifications</div>
                <div class="c_o_s" title="Clear notifications" id="clearTriger"><i class="far fa-trash-alt" aria-hidden="true"></i></div>
            </div>
        
            <div class="notifications-borderer">
                
                @if($total < 1)
                <div class="imennaa_radius_border">
                    <a href="{{ route('home') }}">
                        <div class="notif_msg-center text-center" style="display:block;width: 100%;">
                            Notifications not found
                        </div>
                    </a>
                </div>
                @else
                <div class="imennaa_radius_border" id="load_notifications_here"></div>
                @endif
            </div>

        </div>


</div>

@if($total >= 1)
<div class="white_pagination_container">
	<span class="white_pagination" id="pages_list">
		<span id="prevPageins"></span>
		<span id="p_list_load">
			pages
		</span>
		<span id="Nextpageins"></span>
	</span>
</div>

<div style="display:none !important;">
    <form action="{{ route('MyNotifications') }}" method="POST">
        @csrf
        <input type="text" name="read_all" value="read">
        <input type="submit" id="letssetasread">
    </form>

    <form action="{{ route('MyNotifications') }}" method="POST">
        @csrf
        <input type="text" name="clear" value="all">
        <input type="submit" id="letsDropall">
    </form>
    </div>
@endif

<script>
changePage({{ $page }});

function changePage(page)
{   
    var numpage = Number(page);
    var insurancePremium = numpage > 0 ? numpage : 1;
    var realpage = "{{ route('page_notifications_json') }}?page=" + insurancePremium;
    
    $.getJSON(realpage, 
        function (data)
        { 
            var student = ''; 
            var pages = '';
            var mdzime="'";
        
            $.each(data.notifications, function (key, value) { 	
                student += '<a href="'+value.url+'"><div class="notif_msg-left"><i class="'+value.class+' fas fa-bell" aria-hidden="true"></i></div><div class="notif_msg-center">'+value.text+'<p class="text-muted mb-0"><small>'+value.date+'</small></p></div></a>';
            }); 

            $.each(data.pglist, function (key, value) { 	
                pages += '<a class="'+value.pn_class+'" href="'+value.url+'">'+value.p_num+'</a>';
            }); 

            $.each(data.p_n, function (key, value) { 	
                
                $('#prevPageins').html('<a href="{{ route('MyNotifications') }}?page='+value.prev+'"><i class="fas fa-chevron-left" aria-hidden="true"></i></a>');
                $('#Nextpageins').html('<a href="{{ route('MyNotifications') }}?page='+value.next+'"><i class="fas fa-chevron-right" aria-hidden="true"></i></a>');
                
            }); 

            $('#load_notifications_here').html(student);
            $('#p_list_load').html(pages);
 
        });  
}   

$("#markasread").click(function(){
    $("#letssetasread").click();
});

$("#clearTriger").click(function(){
    $("#letsDropall").click();
}); 
</script>









@endsection