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
@php
   $user = Auth::user();

@endphp
@section('content')
    @if(empty($user->p_subscription) && !$user->is_admin)
        <h2 style="margin-top: 100px; margin-left: 20px">Please Purchase any Subscription</h2>
    @else
        <iframe src="{{url('/')}}/conversations" frameborder="0" style="display: block;       /* iframes are inline by default */
    background: #000;
    border: none;         /* Reset default border */
    height: 100vh;        /* Viewport-relative units */
    width: 100%;"></iframe>
    @endif
@endsection