<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
@php
    $sitename = env('APP_NAME') ?: sys_info('site_name');
@endphp
<title>{{ $sitename }} - @yield('title')</title>

<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, user-scalable=0">
<meta name="description" content="{{ sys_info('meta_description') }}" />
<meta name="keywords" content="{{ allmetakeywords() }}" />
<meta name="author" content="WEB-TM" />
<meta name="robots" content="all"/>

<!-- Facebook / LinkedIn & Others ... -->
<meta property="og:site_name" content="{{ $sitename }}" />
<meta property="og:locale" content="en_US" />
<meta property="fb:app_id" content="146229160825885" /> 

<meta property="og:type" content="Website" />
<meta property="og:url" content="{{ url()->full() }}" />
<meta property="og:title" content="@yield('title')" />
<meta property="og:description" content="{{ sys_info('meta_description') }}" />
<meta property="og:image" content="{{ asset('assets/images/9uu9u98u899u98u89u98.jpg') }}" />

<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="{{ url()->full() }}">
<meta name="twitter:title" content="@yield('title')"/>
<meta property="twitter:description" content="{{ sys_info('meta_description') }}" />

<!-- Photo Size -->
<meta property="og:image:secure_url" content="{{ asset('assets/images/9uu9u98u899u98u89u98.jpg') }}"/>
<meta property="og:image:type" content="image/jpg" />
<meta property="og:image:width" content="971" />
<meta property="og:image:height" content="509" />

{{ sys_info('meta_additionalkeywords') }}


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<script src="{{ asset('assets/js/w3.js') }}"></script>
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/css/style_forum.css') }}" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css?family=Archivo+Black|Economica|Orbitron&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/bpg-arial-caps.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/css/bpg-algeti.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/css/buttons.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('assets/css/breadcrumb.css') }}" type="text/css"/>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet"> 
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>