@extends('layouts.app')
@section('title')
    {{ __('messages.reported_user') }}
@endsection
@section('page_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTable.min.css') }}"/>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ mix('assets/css/admin_panel.css') }}">
@endsection
@section('content')
    <div class="container-fluid page__container">
        <div class="animated fadeIn main-table">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header page-header d-flex flex-wrap">
                             <div class="pull-left page__heading my-2 mr-2">
                                 {{ __('messages.reported_user') }}
                             </div>
                             <div class="filter-container flex-wrap ml-auto">
                                 <div class="mr-2 my-2 user-select2">
                                     {!!Form::select('is_active', \App\Models\ReportedUser::IS_ACTIVE_FILTER_ARRAY, \App\Models\ReportedUser::IS_ACTIVE_FILTER_ALL, ['id' => 'isActiveFilter', 'class'=>'form-control', 'style'=>'min-width:150px;'])  !!}
                                 </div>
                             </div>
                         </div>
                         <div class="card-body">
                             @include('reported_users.table')
                         </div>
                     </div>
                  </div>
             </div>
            @include('reported_users.show')
            @include('reported_users.templates.template')
         </div>
    </div>
@endsection
@section('page_js')
    <script type="text/javascript" src="{{ asset('js/dataTable.min.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let reportedUsersUrl = "{{ route('reported-users.index') }}";
        let usersUrl = "{{ url('users') }}";
        let defaultImageAvatar = "{{ getDefaultAvatar() }}/";
    </script>
    <script src="{{ mix('assets/js/admin/reported_users/reported_users.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/custom-datatables.js') }}"></script>
@endsection
