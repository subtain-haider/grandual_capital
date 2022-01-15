
@if($tags->count() >= 1)
    @php($dzagluka='@')
    @foreach($tags as $tag)
        <span class="suggested_utags"onclick="answer('{{ $tag->name }}','{{ $tag->id }}')">{{$dzagluka}}{{ $tag->name }}</span>
    @endforeach
                
@else
    User not found ;)</a>
@endif