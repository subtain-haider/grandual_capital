@if($count_notifications>=1)
@php ($i = 0)

{ "records":[
    @foreach($notifications as $notification)
        @php($i++)
        
        @if($count_notifications>1 && $count_notifications != $i)
            @php($mdzime=',')
        @else
            @php($mdzime='')
        @endif

      
        @php($seenclass = ($notification->seen == 0 ? 'unread' : ''))
        @php($url = route('see_notification', [$notification->id]))
        
        { "id" : "{{$notification->id}}", "text" : "{!! $notification->text !!}", "link_to" : "{{$url}}", "see_class" : "{{$seenclass}}"}{{$mdzime}}
              
        
    @endforeach
]}

@endif  