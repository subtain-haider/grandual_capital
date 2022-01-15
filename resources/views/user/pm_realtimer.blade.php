dialog = {{ $dialog }}<br>
user_toooo = {{ $to }}

<script>
    if(typeof(EventSource) !== "undefined") {
        var posted_tid = $('#current_chat_window').val();
        var source_realtimer = new EventSource("{{ route('messages_data', ['cconversition']) }}?count={{ $dialog }}");
        source_realtimer.onmessage = function(event) {
            
            if(Number(event.data) >=1 && Number(event.data) != Number($("#total_now").val()) ){
                $("#total_now").val(Number(event.data));
                $("#post_pm").append("-1")
                load_pm_dialogs({{ $dialog }},{{ $to }});
            }
        };
    } 
    else 
    {	
        alert("Sorry, your browser does not support server-sent events...");
    }
    
</script>
