@extends('layouts.general_layout')
@section('title', 'Private messages')  
@section('content')
    
<div class="breadcrumb-container overflow-auto">
    <div class="btn-group btn-breadcrumb">
        <a href="{{ route('home') }}" class="btn btn-default"><i class="fas fa-home"></i></a>
        <a href="{{ route('messages') }}" class="btn btn-default">Private messages</a>
    </div>
</div>

<div class="all_post_items_container bg-white">
    <div class="contacts_nav" onclick="toggleContacts();">
        <i class="fas fa-user-friends" aria-hidden="true"></i> 
        Contacts
        <i class="fas fa-chevron-down" aria-hidden="true"></i>
    </div>


    <div class="container-wide">
        <div class="pm-sidebar" id="pm-sidebar">
        <div class="NewinboxPMs">Inbox <span class="pmbadge" id="big_pmbadge">0</span></div>
        <div class="contact_search">
            <input type="text" class="cantacts_input" id="cantacts_input" placeholder="Search in contacts...">
            <button type="button">
                <i class="las la-search"></i>
            </button>
        </div>
        <div class="messenger-side-title">Contacts</div>
        <div class="allcontacts" id="allcontacts_load"></div>
    </div>
    
    
        <div class="new-messages">
            <div class="closed_messenger_block">
                <i class="fas fa-envelope" aria-hidden="true"></i>
                <i class="fas fa-envelope-open" aria-hidden="true"></i>
            </div>
        <span id="pm_container_controller" style="display:none;">
            <div class="messages-container">
                <div class="older_triger" id="pm_previous">Older messages @csrf</div>
                <span id="messages_load_here"></span>	
            </div>
            <div class="older_triger" id="pm_folowings" style="display:none;">new messages</div>
    
    
            <div class="pm_postform_container">
                <div class="loading_uploads" id="loading_uploads" style="display:none;">
                    <i class="fas fa-spinner fa-spin" aria-hidden="true"></i> uploading
                    <span id="uploading_file">filename</span>
                </div>
                
                <div class="pm_smiles" id="pm_smiles" style="display:none;">
                    @foreach($smiles as $smile)
                        <img onclick="insPMSmile('{{ $smile->code }}');" src="{{ asset('/assets/images/smiles/'.$smile->path) }}" alt="{{ $smile->code }}">
                    @endforeach
                </div>
                
                
                <textarea class="pm_textarea" id="pm_textarea" placeholder="Put some text here..."></textarea>
                <div class="messenger_parts">
                    <div class="msp-left">
                        <div id="msp-buttons" style="display:none;">
    
                            <div><i class="far fa-image" onclick="choose_file_DM();" aria-hidden="true"></i></div>
                            <div onclick="hide_and_smiles();">
                                <i class="far fa-smile-wink" aria-hidden="true"></i>
                            </div>
                            <div onclick="insertTextarea('[url=http:/...]title here...[/url]');"><i class="i_pmab fas fa-link" aria-hidden="true"></i></div>
                            <div onclick="insertTextarea('[youtube]Video ID...[/youtube]');"><i class="fab fa-youtube" aria-hidden="true"></i></div>
    
    
                        </div>
                        <span class="pm_mtriger" id="pm_mtriger">
                            <i class="i_pmab fas fa-th" aria-hidden="true"></i>
                        </span>
                        <span class="pmdm-button" onclick="insertTextarea('[url=http:/...]title here...[/url]');"><i class="i_pmab fas fa-link" aria-hidden="true"></i></span>
                        <span class="pmdm-button" onclick="insertTextarea('[youtube]Video ID...[/youtube]');"><i class="fab fa-youtube" aria-hidden="true"></i></span>
                        <span class="pmdm-button" onclick="choose_file_DM();"><i class="far fa-image" aria-hidden="true"></i></span>
                    </div>
                    <div class="msp-center">
                        <button type="button" id="post_pm"><i class="fas fa-paper-plane" aria-hidden="true"></i> Send</button>
                    </div>
                    <div class="msp-right">
                        <span class="pmdm-button" onclick="w3.toggleShow('.pm_smiles');"><i class="far fa-smile-wink" aria-hidden="true"></i></span>
                        <span id="Sendlike"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
    
        </span>
        </div>
    </div>



</div>



<!-- The Modal -->
<div id="IFWV" class="IFWV-modal">
  <span class="IFWV-close">&times;</span>
  <img class="IFWV-content" id="IFWV-load">
</div>



<span id="load_script_sync_another"></span>
<div style="display:none; !important">
	<input type="hidden" value="{{ $id }}" id="current_chat_window"><br>
	<input type="hidden" value="{{ LoadDialog_withto($id) }}" id="pm_to_negga"><br>
	<input type="hidden" id="total_now"><br>
	<input type="hidden" id="current_page" value="1"><br>
	<input type="hidden" id="total_pages"><br>
	<input type="hidden" id="page_manual" value="1"><br>
</div>

<form method="post" id="upload_form" enctype="multipart/form-data" style="display:none !important;">
    {{ csrf_field() }}
    <input type="file" name="file" id="file" />
    <input type="submit" name="upload" id="upload" class="btn btn-primary" value="upload">
</form>
       
    <!-- Script -->
    <script type='text/javascript'>

		function load_allcontacts()
		{
			var all_data = '';
			var zeda_mdzime = "'";
    		$.getJSON("{{ route('messages_data', ['contacts', 'max' => 'all']) }}", function(data)
			{
    			$.each(data.ddcontacts, function(i, row){
					all_data += '<a href="'+row.url+'" class="'+row.seen+'"><div class="contact-avatar"><img src="'+row.recipient_avatar+'" alt="avatar"></div><div class="contact-username contact-username2"><strong>'+row.recipient+'</strong><time>'+row.last_time+'</time></div><div class="online-status"><div class="'+row.bullet_class+'"></div></div></a>';
      			});
	  			$('#allcontacts_load').html(all_data);
    		});
		}

        load_allcontacts();
        
		@if($var_contact >= 1)
			w3.hide('#pm_previous');
			var startwithPROFILEurl = "{{ route('user_profile',['']) }}";
			$('#messages_load_here').html('<div class="start_first_conversdition"><div class="startpm_avatar"><a href="'+startwithPROFILEurl+'/{{ user_info($var_contact, 'id') }}"><img src="{{ user_info($var_contact, 'avatar') }}"></a></div><span>Start first pirate conversition with <a href="'+startwithPROFILEurl+'/{{ user_info($var_contact, 'id') }}"><strong>{{ user_info($var_contact, 'name') }}</strong></a></span></div>');
			// singarela	
			load_pm_dialogs(0,{{ $var_contact }});
		@else    
        	{!! LoadDialog($id) !!}
		@endif
		
		
        function toggleContacts(){
			
			var checkstyle = document.getElementById('pm_container_controller'); 

			if (window.matchMedia('(max-width: 808px)').matches) {
        		//...
				if(checkstyle.style.display=='block'){
					w3.hide('#pm_container_controller');
					w3.show('#pm-sidebar'); 
				}
				else
				{
					w3.show('#pm_container_controller');
					w3.hide('#pm-sidebar');
				}
    		}
			else 
			{	
				w3.toggleShow('#pm-sidebar'); 
			}
			

		}

		function choose_file_DM()
		{
			$('#file').click();
		}
		
		

        $(document).ready(function(){
			$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


		$("#post_pm").click(function()
		{
			var posted_textarea = $('#pm_textarea').val();
			var posted_tid = $('#current_chat_window').val();
			var posted_pmto = $('#pm_to_negga').val();
			
			if($('#pm_textarea').val() != '')
			{   
				$.post("{{ route('SendPM') }}",
				{   
					pm_post: posted_textarea,
					pm_topic: posted_tid,
					pm_to: posted_pmto
				},
				function(data)
				{
					$('#pm_textarea').val('');

					if(Number(data.success) >= 1)
					{
						//load_pm_dialogs(Number(data.success),posted_pmto);
						window.location.href = "{{ route('messages',['messages']) }}/"+Number(data.success);
					}
					else
					{
						load_pm_dialogs(posted_tid,posted_pmto);
					}
					
				});
			}
			
	 	});


			$("#file").change(function(){
				if(document.getElementById("file").files.length != 0){
    				$('#upload').click();
				}
			}); 


			$('#upload_form').on('submit', function(event){
                	
				event.preventDefault();
				w3.show('#loading_uploads');
                var fd = new FormData();
                var files = $('#file')[0].files[0];
				$('#uploading_file').html('<b>'+files.name+'</b>');
                fd.append('file',files);
                fd.append('request',1);
                   $.ajax({
                        url:"{{ route('UploadAction') }}",
                        method:"POST",
                        data:new FormData(this),
                        dataType:'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(response)
                        {
							if(response.uploaded_file != 0)
							{
								insertTextarea('[img]'+response.uploaded_file+'[/img]');
								w3.hide('#loading_uploads');
								$("#file").val('');

                        	}
							else
							{
                            	alert(response.message);
                        	}
                        }
                   })
               });













			$("#pm_previous").click(function()
			{	
				var conversitionID = Number($('#current_chat_window').val());
				var conversitionWith = Number($('#pm_to_negga').val());
			
				var totalPages = Number($('#total_pages').val());
				var currentPage = Number($('#current_page').val());
				var manualPage = Number($('#page_manual').val());
				
				// Generate next page
				var genNext = currentPage + 1;
				if(genNext <= totalPages)
				{
					$('#page_manual').val(genNext);
					$("#pm_folowings").show();
					load_pm_dialogs(conversitionID,conversitionWith);
				}
				if(genNext >= totalPages)
				{
					$("#pm_previous").hide();
				}
  			});


			$("#pm_folowings").click(function()
			{
				var conversitionID = Number($('#current_chat_window').val());
				var conversitionWith = Number($('#pm_to_negga').val());
			
				var totalPages = Number($('#total_pages').val());
				var currentPage = Number($('#current_page').val());
				var manualPage = Number($('#page_manual').val());
				
				// Generate Previous page
				var genPrev = currentPage - 1;

				if(genPrev >= 1)
				{
					$('#page_manual').val(genPrev);
					$("#pm_previous").show();
					load_pm_dialogs(conversitionID,conversitionWith);
				}
				if(genPrev <= 1)
				{
					$("#pm_folowings").hide();
				}
				

			});



        });

		function b64_to_utf8( str ) {
  			return decodeURIComponent(escape(window.atob( str )));
		}

		function insPMSmile(text){
			insertTextarea(text);
			w3.hide('.pm_smiles');
		}
		function insertTextarea(text) { 
        	var curPos = document.getElementById("pm_textarea").selectionStart; 
        	let x = $("#pm_textarea").val(); 
        	let text_to_insert = text; 
        	$("#pm_textarea").val(x.slice(0, curPos) + text_to_insert + x.slice(curPos)); 
    	} 
	

	$("#Sendlike").click(function(){
    	$('#pm_textarea').val(':like');
		$('#post_pm').click();
  	});


	function load_pm_dialogs(id, pm_to){
		
		if(id != '0')
		{	ChangeUrl('Conversition', '{{ route('messages',['messages']) }}/'+id);
			// ზოგადი ცვლადები
			var all_data = '';
			var zeda_mdzime = "'";
			
			var conversitionID = Number($('#current_chat_window').val());
			var conversitionWith = Number($('#pm_to_negga').val());
		
			var totalPages = Number($('#total_pages').val());
			var currentPage = Number($('#current_page').val());
			var manualPage = Number($('#page_manual').val());

			$(".closed_messenger_block").slideUp();
			w3.show('#pm_container_controller');

			//თუ სხვა მომხმარებელთან გადავალთ საჩათაოდ
			if(conversitionID != Number(id))
			{
				$('#current_chat_window').val(Number(id));
				$('#pm_to_negga').val(Number(pm_to));
				$('#total_now').val('');
				$('#current_page').val(1);
				$('#total_pages').val('');
				$('#page_manual').val(0);	
			}
			
			var manual_page_value = $('#page_manual').val();
		
			if(Number(manual_page_value) >= 1 && conversitionID == Number(id)){
				var page_PMgoto = '&page='+manual_page_value;
			}
			else
			{
				var page_PMgoto = '&page=1';
			}

        	var PaginURL = "{{ route('messages_data',['conversition', 'load' => '']) }}"+Number(id)+page_PMgoto;

    		$.getJSON(PaginURL, function(data){
    			$.each(data.posts, function(i, message)
				{
 					var decodedPostString = b64_to_utf8(message.text);   
					if(message.by == message.just_me)
					{	
						all_data += '<div class="pm_msg"><div class="my_message">'+decodedPostString+'<div class="pmmsg_date_mine"><i class="las la-clock"></i> '+message.date+'</div></div><div class="pm_avatar_mine"><a href="'+message.profileURL+'"><img src="'+message.avatar+'"></a></div></div>';
					}
					else
					{
						all_data += '<div class="pm_msg"><div class="pm_avatar"><a href="'+message.profileURL+'"><img src="'+message.avatar+'"></a></div><div class="recipient_message">'+decodedPostString+'<div class="pmmsg_date"><i class="las la-clock"></i> '+message.date+'</div></div></div>';
					}
             
      			});
			
				$.each(data.page_stat, function(just_i, page){
					$('#current_page').val(page.current);
					$('#total_pages').val(page.total_pages);
					$('#page_manual').val(page.current);
				});
                
	  			$('#messages_load_here').html(all_data);
    		});

			if (window.matchMedia('(max-width: 808px)').matches) {
        		//...
				w3.hide('#pm-sidebar');
    		}
			else 
			{	//...
				w3.show('#pm-sidebar');
    		}
		
		}
		else
		{	
			$(".closed_messenger_block").slideUp();
			$('#current_chat_window').val(Number(id));
			$('#pm_to_negga').val(Number(pm_to));
			w3.show('#pm_container_controller');		
		}

		
  	}


	$("#cantacts_input").on("keyup", function() {
    	var value = $(this).val().toLowerCase();
   		$("#allcontacts_load a div strong").filter(function() 
		{
    		$(this).closest('a').toggle($(this).text().toLowerCase().indexOf(value) > -1)
    	});
  	});
	
	function pm_with(id){
		alert(id);
	}


	function hide_and_smiles(){
		var pm_smiles = document.getElementById('pm_smiles');
		if(pm_smiles.style.display == 'block')
		{
    		w3.hide('#pm_smiles');
    		w3.show('#msp-buttons');
    	}
    	else
		{
    		w3.show('#pm_smiles');
    		w3.hide('#msp-buttons');
    	}
	}

	document.getElementById("pm_mtriger").onclick = function() {
		w3.toggleShow('#msp-buttons');
    	w3.hide('#pm_smiles');
	};

	
	function ChangeUrl(title, url) {  

    	if (typeof(history.pushState) != "undefined") 
		{  
        	var obj = { Title: title, Url: url };  
        	history.pushState(obj, obj.Title, obj.Url);  
    	} 
		else 
		{  
        	alert("Browser does not support HTML5.");  
    	}  
	} 

	var modal = document.getElementById("IFWV");
	var modalImg = document.getElementById("IFWV-load");
	var captionText = document.getElementById("IFWV-caption");

	document.getElementsByClassName("IFWV-close")[0].onclick = function() { 
		modal.style.display = "none";
	}

	function IFWVShow(x) 
	{  
  		modal.style.display = "block";
  		modalImg.src = x.src;
	}
</script>

@endsection