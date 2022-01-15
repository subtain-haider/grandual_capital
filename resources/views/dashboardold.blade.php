@extends('user.dashboard.app')
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">info_outline</i>
              </div>
              <p class="card-category">Affiliations</p>
              <h3 class="card-title">{{count($affiliations)}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">local_offer</i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Affiliation Income</p>
              <h3 class="card-title">${{$user->a_cash}}
                {{-- <small>GB</small> --}}
              </h3>
            </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons text-danger">warning</i>
{{--                            <a href="javascript:;">Get More Space...</a>--}}
                          </div>
                        </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Subscription</p>
              <h3 class="card-title">{{ !empty( $user->subscription->name)  ? $user->subscription->name . ' Months' : 'No Subscription'}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i>
                @if(!empty($user->subscription))
                  Expires at: {{$user->expires_at}}
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Products</p>
              <h3 class="card-title">{{count($user->products)}}
                {{-- <small>GB</small> --}}
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">warning</i>
{{--                <a href="javascript:;">Get More Space...</a>--}}
              </div>
            </div>
          </div>
        </div>


        {{-- <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fa fa-twitter"></i>
              </div>
              <p class="card-category">Followers</p>
              <h3 class="card-title">+245</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div>
            </div>
          </div>
        </div> --}}
      </div>
      @if(!\Illuminate\Support\Facades\Auth::user()->is_admin)
      <div class="row">
        <div class="col">
          <h2>Your Referrals</h2>
          <table class="table table-bordered" style="background-color: white">
            <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Amount</th>
            </tr>
            </thead>
            <tbody>
            @if(count($affiliations) > 0)
              @foreach($affiliations as $affiliation)
                <tr>
                  <th scope="row">{{$loop->index + 1}}</th>
                  <td>{{$affiliation->full_name}}</td>
                  <td>{{$affiliation->email}}</td>
                  @php
                  if ($affiliation->subscription){
    $subscription = $affiliation->subscription;
                      $affiliation_settings = \App\Models\Affiliation::first();
                    $amount = ($subscription->price * $affiliation_settings->percentage) / 100;
}else{
    $amount = 0;
}

                  @endphp
                  <td>${{$amount}}</td>
                </tr>
              @endforeach
            @else
              <tr>
                <th class="text-center" colspan="4">No Referrals</th>
              </tr>
            @endif
            </tbody>
          </table>
        </div>
      </div>
        @endif
    </div>
  </div>
@endsection
