@extends('admin.app')

@section('content')

<!-- content @s -->
<div class="nk-content ">
  <div class="container-fluid">
      <div class="nk-content-inner">
          <div class="nk-content-body">
              <div class="nk-block-head nk-block-head-sm">
                  <div class="nk-block-between">
                      <div class="nk-block-head-content">
                          <h3 class="nk-block-title page-title">Grandeurcapital</h3>
                      </div><!-- .nk-block-head-content -->
                  </div><!-- .nk-block-between -->
              </div><!-- .nk-block-head -->
              <div class="nk-block">
                  <div class="row g-gs">
                      <div class="col-xxl-3 col-sm-6">
                          <div class="card">
                              <div class="nk-ecwg nk-ecwg6">
                                  <div class="card-inner">
                                      <div class="card-title-group">
                                          <div class="card-title">
                                              <h6 class="title">Users</h6>
                                          </div>
                                      </div>
                                      <div class="data">
                                          <div class="data-group">
                                              <div class="amount"> Total: {{$users}}</div>
                                              <div class="nk-ecwg6-ck" style="height:90px !important">
                                                  <div class="preview-icon-wrap">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                                                      <rect x="5" y="7" width="60" height="56" rx="7" ry="7" fill="#e3e7fe" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                                      <rect x="25" y="27" width="60" height="56" rx="7" ry="7" fill="#e3e7fe" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                                      <rect x="15" y="17" width="60" height="56" rx="7" ry="7" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                                      <line x1="15" y1="29" x2="75" y2="29" fill="none" stroke="#6576ff" stroke-miterlimit="10" stroke-width="2"></line>
                                                      <circle cx="53" cy="23" r="2" fill="#c4cefe"></circle>
                                                      <circle cx="60" cy="23" r="2" fill="#c4cefe"></circle>
                                                      <circle cx="67" cy="23" r="2" fill="#c4cefe"></circle>
                                                      <rect x="22" y="39" width="20" height="20" rx="2" ry="2" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                                      <circle cx="32" cy="45.81" r="2" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
                                                      <path d="M29,54.31a3,3,0,0,1,6,0" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                                      <line x1="49" y1="40" x2="69" y2="40" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                      <line x1="49" y1="51" x2="69" y2="51" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                      <line x1="49" y1="57" x2="59" y2="57" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                      <line x1="64" y1="57" x2="66" y2="57" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                      <line x1="49" y1="46" x2="59" y2="46" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                      <line x1="64" y1="46" x2="66" y2="46" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                  </svg>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><span> vs. last week</span></div> -->
                                      </div>
                                  </div><!-- .card-inner -->
                              </div><!-- .nk-ecwg -->
                          </div><!-- .card -->
                      </div><!-- .col -->
                      <div class="col-xxl-3 col-sm-6">
                          <div class="card">
                              <div class="nk-ecwg nk-ecwg6">
                                  <div class="card-inner">
                                      <div class="card-title-group">
                                          <div class="card-title">
                                              <h6 class="title">Subscription</h6>
                                          </div>
                                      </div>
                                      <div class="data">
                                          <div class="data-group">
                                              <div class="amount"> Total: {{$subscriptions}}</div>
                                              <div class="nk-ecwg6-ck" style="height:90px !important">
                                                  <div class="preview-icon-wrap">
                                                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 114 113.9">
                                                          <path d="M87.84,110.34l-48.31-7.86a3.55,3.55,0,0,1-3.1-4L48.63,29a3.66,3.66,0,0,1,4.29-2.8L101.24,34a3.56,3.56,0,0,1,3.09,4l-12.2,69.52A3.66,3.66,0,0,1,87.84,110.34Z" transform="translate(-4 -2.1)" fill="#c4cefe"></path>
                                                          <path d="M33.73,105.39,78.66,98.1a3.41,3.41,0,0,0,2.84-3.94L69.4,25.05a3.5,3.5,0,0,0-4-2.82L20.44,29.51a3.41,3.41,0,0,0-2.84,3.94l12.1,69.11A3.52,3.52,0,0,0,33.73,105.39Z" transform="translate(-4 -2.1)" fill="#c4cefe"></path>
                                                          <rect x="22" y="17.9" width="66" height="88" rx="3" ry="3" fill="#6576ff"></rect>
                                                          <rect x="31" y="85.9" width="48" height="10" rx="1.5" ry="1.5" fill="#fff"></rect>
                                                          <rect x="31" y="27.9" width="48" height="5" rx="1" ry="1" fill="#e3e7fe"></rect>
                                                          <rect x="31" y="37.9" width="23" height="3" rx="1" ry="1" fill="#c4cefe"></rect>
                                                          <rect x="59" y="37.9" width="20" height="3" rx="1" ry="1" fill="#c4cefe"></rect>
                                                          <rect x="31" y="45.9" width="23" height="3" rx="1" ry="1" fill="#c4cefe"></rect>
                                                          <rect x="59" y="45.9" width="20" height="3" rx="1" ry="1" fill="#c4cefe"></rect>
                                                          <rect x="31" y="52.9" width="48" height="3" rx="1" ry="1" fill="#e3e7fe"></rect>
                                                          <rect x="31" y="60.9" width="23" height="3" rx="1" ry="1" fill="#c4cefe"></rect>
                                                          <path d="M98.5,116a.5.5,0,0,1-.5-.5V114H96.5a.5.5,0,0,1,0-1H98v-1.5a.5.5,0,0,1,1,0V113h1.5a.5.5,0,0,1,0,1H99v1.5A.5.5,0,0,1,98.5,116Z" transform="translate(-4 -2.1)" fill="#9cabff"></path>
                                                          <path d="M16.5,85a.5.5,0,0,1-.5-.5V83H14.5a.5.5,0,0,1,0-1H16V80.5a.5.5,0,0,1,1,0V82h1.5a.5.5,0,0,1,0,1H17v1.5A.5.5,0,0,1,16.5,85Z" transform="translate(-4 -2.1)" fill="#9cabff"></path>
                                                          <path d="M7,13a3,3,0,1,1,3-3A3,3,0,0,1,7,13ZM7,8a2,2,0,1,0,2,2A2,2,0,0,0,7,8Z" transform="translate(-4 -2.1)" fill="#9cabff"></path>
                                                          <path d="M113.5,71a4.5,4.5,0,1,1,4.5-4.5A4.51,4.51,0,0,1,113.5,71Zm0-8a3.5,3.5,0,1,0,3.5,3.5A3.5,3.5,0,0,0,113.5,63Z" transform="translate(-4 -2.1)" fill="#9cabff"></path>
                                                          <path d="M107.66,7.05A5.66,5.66,0,0,0,103.57,3,47.45,47.45,0,0,0,85.48,3h0A5.66,5.66,0,0,0,81.4,7.06a47.51,47.51,0,0,0,0,18.1,5.67,5.67,0,0,0,4.08,4.07,47.57,47.57,0,0,0,9,.87,47.78,47.78,0,0,0,9.06-.87,5.66,5.66,0,0,0,4.08-4.09A47.45,47.45,0,0,0,107.66,7.05Z" transform="translate(-4 -2.1)" fill="#2ec98a"></path>
                                                          <path d="M100.66,12.81l-1.35,1.47c-1.9,2.06-3.88,4.21-5.77,6.3a1.29,1.29,0,0,1-1,.42h0a1.27,1.27,0,0,1-1-.42c-1.09-1.2-2.19-2.39-3.28-3.56a1.29,1.29,0,0,1,1.88-1.76c.78.84,1.57,1.68,2.35,2.54,1.6-1.76,3.25-3.55,4.83-5.27l1.35-1.46a1.29,1.29,0,0,1,1.9,1.74Z" transform="translate(-4 -2.1)" fill="#fff"></path>
                                                      </svg>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><span> vs. last week</span></div> -->
                                      </div>
                                  </div><!-- .card-inner -->
                              </div><!-- .nk-ecwg -->
                          </div><!-- .card -->
                      </div><!-- .col -->
                  </div><!-- .row -->
              </div><!-- .nk-block -->
          </div>
      </div>
  </div>
</div>
<!-- content @e -->


{{-- <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Users</p>
              <h3 class="card-title">{{$users}}
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">warning</i>
                <a href="javascript:;">Get More Space...</a>
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
              <h3 class="card-title">{{$subscriptions}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Last 24 Hours
              </div>
            </div>
          </div>
        </div> --}}
{{--        <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--          <div class="card card-stats">--}}
{{--            <div class="card-header card-header-danger card-header-icon">--}}
{{--              <div class="card-icon">--}}
{{--                <i class="material-icons">info_outline</i>--}}
{{--              </div>--}}
{{--              <p class="card-category">Affiliations</p>--}}
{{--              <h3 class="card-title">{{$affiliations}}</h3>--}}
{{--            </div>--}}
{{--            <div class="card-footer">--}}
{{--              <div class="stats">--}}
{{--                <i class="material-icons">local_offer</i> Tracked from Github--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
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
    </div>
  </div>
@endsection
