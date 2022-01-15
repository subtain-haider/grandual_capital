@if(Auth::user()->is_admin == 1)
    @php
        $layout = 'admin'
    @endphp
@else
    @php
        $layout = 'user.dashboard'
    @endphp
@endif
@extends($layout.'.app')

@section('content')
    <iframe src="{{url('/')}}/conversations" frameborder="0" style="display: block;       /* iframes are inline by default */
    background: #000;
    border: none;         /* Reset default border */
    height: 100vh;        /* Viewport-relative units */
    width: 100%;"></iframe>
@endsection