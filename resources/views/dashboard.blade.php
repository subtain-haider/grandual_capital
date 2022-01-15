@extends('user.dashboard.app')
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
                                                <h6 class="title">Affiliations</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount"> Total: {{count($affiliations)}}</div>
                                                <div class="nk-ecwg6-ck" style="height:90px !important">
                                                    <div class="preview-icon-wrap">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90">
                                                            <rect x="3.5" y="14" width="36" height="62" rx="2" ry="2" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                                            <line x1="3.5" y1="22" x2="39.5" y2="22" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <line x1="3.5" y1="64" x2="39.5" y2="64" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <line x1="20.5" y1="18" x2="25.5" y2="18" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <line x1="17.17" y1="18" x2="17.17" y2="18" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <circle cx="21.5" cy="70" r="2" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
                                                            <rect x="7.5" y="25" width="28" height="35" fill="#eff1ff"></rect>
                                                            <rect x="10.5" y="40" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                                            <rect x="16.5" y="40" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                                            <rect x="22.5" y="40" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                                            <rect x="28.5" y="40" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                                            <rect x="50.5" y="14" width="36" height="62" rx="2" ry="2" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                                            <line x1="50.5" y1="22" x2="86.5" y2="22" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <line x1="50.5" y1="64" x2="86.5" y2="64" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <line x1="67.5" y1="18" x2="72.5" y2="18" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <line x1="64.45" y1="17.86" x2="64.45" y2="17.86" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <circle cx="68.5" cy="70" r="2" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
                                                            <rect x="54.5" y="25" width="28" height="35" fill="#eff1ff"></rect>
                                                            <rect x="57.5" y="39" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                                            <rect x="63.5" y="39" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                                            <rect x="69.5" y="39" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                                            <rect x="75.5" y="39" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                                            <ellipse cx="45.51" cy="44" rx="15.18" ry="15" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></ellipse>
                                                            <ellipse cx="45.51" cy="44" rx="11.13" ry="11" fill="#e3e7fe"></ellipse>
                                                            <path d="M46,50.92s5.5-2.77,5.5-6.92V39.16L46,37.08l-5.5,2.08V44C40.5,48.15,46,50.92,46,50.92Z" fill="#6576ff"></path>
                                                            <polyline points="48.04 42 44.56 46 42.98 44.18" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polyline>
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
                                                <h6 class="title">Affiliation Income</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount"> Totol: ${{$user->a_cash}}</div>
                                                <div class="nk-ecwg6-ck" style="height:90px !important">
                                                    <div class="preview-icon-wrap">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90">
                                                            <rect x="9" y="21" width="55" height="39" rx="6" ry="6" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                                            <line x1="17" y1="44" x2="25" y2="44" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <line x1="30" y1="44" x2="38" y2="44" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <line x1="42" y1="44" x2="50" y2="44" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <line x1="17" y1="50" x2="36" y2="50" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <rect x="16" y="31" width="15" height="8" rx="1" ry="1" fill="#c4cefe"></rect>
                                                            <path d="M76.79,72.87,32.22,86.73a6,6,0,0,1-7.47-4L17,57.71A6,6,0,0,1,21,50.2L65.52,36.34a6,6,0,0,1,7.48,4l7.73,25.06A6,6,0,0,1,76.79,72.87Z" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                                            <polygon points="75.27 47.3 19.28 64.71 17.14 57.76 73.12 40.35 75.27 47.3" fill="#6576ff"></polygon>
                                                            <path d="M30,77.65l-1.9-6.79a1,1,0,0,1,.69-1.23l4.59-1.3a1,1,0,0,1,1.23.7l1.9,6.78A1,1,0,0,1,35.84,77l-4.59,1.3A1,1,0,0,1,30,77.65Z" fill="#c4cefe"></path>
                                                            <path d="M41.23,74.48l-1.9-6.78A1,1,0,0,1,40,66.47l4.58-1.3a1,1,0,0,1,1.23.69l1.9,6.78A1,1,0,0,1,47,73.88l-4.58,1.29A1,1,0,0,1,41.23,74.48Z" fill="#c4cefe"></path>
                                                            <path d="M52.43,71.32l-1.9-6.79a1,1,0,0,1,.69-1.23L55.81,62A1,1,0,0,1,57,62.7l1.9,6.78a1,1,0,0,1-.69,1.23L53.66,72A1,1,0,0,1,52.43,71.32Z" fill="#c4cefe"></path>
                                                            <ellipse cx="55.46" cy="19.1" rx="16.04" ry="16.1" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></ellipse>
                                                            <ellipse cx="55.46" cy="19.1" rx="12.11" ry="12.16" fill="#e3e7fe"></ellipse><text transform="translate(50.7 23.72) scale(0.99 1)" font-size="16.12" fill="#6576ff" font-family="Nunito-Black, Nunito Black">$</text>
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
                                                <div class="amount"> {{ !empty( $user->subscription->name)  ? $user->subscription->name . ' Months' : 'No Subscription'}}</div>
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

                        
                        <div class="col-xxl-3 col-sm-6">
                            <div class="card">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Products</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount">Totol Products: {{count($user->products)}} </div>
                                                <div class="nk-ecwg6-ck" style="height:90px !important">
                                                    <div class="preview-icon-wrap">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90">
                                                            <path d="M26,70.78V24.5a7,7,0,0,1,7-7H69a9,9,0,0,1,9,9v49a7,7,0,0,1-7,7H16.55S25.72,78.89,26,70.78Z" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                                            <path d="M7,30.5H26a0,0,0,0,1,0,0V73.9a8.6,8.6,0,0,1-8.6,8.6H13.6A8.6,8.6,0,0,1,5,73.9V32.5a2,2,0,0,1,2-2Z" fill="#e3e7fe" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                                            <circle cx="71.5" cy="21" r="13.5" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
                                                            <rect x="34" y="33.5" width="16" height="8" rx="1" ry="1" fill="#c4cefe"></rect>
                                                            <line x1="35" y1="46.5" x2="67" y2="46.5" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <line x1="35" y1="53.5" x2="67" y2="53.5" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <line x1="35" y1="59.5" x2="67" y2="59.5" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <line x1="35" y1="64.5" x2="67" y2="64.5" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <line x1="35" y1="71.5" x2="51" y2="71.5" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                            <path d="M75.24,23.79a5.2,5.2,0,0,1-6.42,2.57,5.78,5.78,0,0,1-3.26-7.25,5.25,5.25,0,0,1,6.8-3.47,5.35,5.35,0,0,1,2,1.34l2.75,2.75" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                                            <polyline points="77.75 16.61 77.75 20.61 73.75 20.61" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polyline>
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
@if(!\Illuminate\Support\Facades\Auth::user()->is_admin)
    
<div class="nk-content">
  <div class="container-fluid">
      <div class="nk-content-inner">
          <div class="nk-content-body">
              <div class="nk-block-head nk-block-head-sm">
                  <div class="nk-block-between">
                      <div class="nk-block-head-content">
                          <h3 class="nk-block-title page-title">Your Referrals</h3>
                      </div><!-- .nk-block-head-content -->
                     
                  </div><!-- .nk-block-between -->
              </div><!-- .nk-block-head -->
              <div class="nk-block">
                  <div class="row g-gs">
                      <div class="col-xxl-12">
                          <div class="col-12 div_alert">
                            </div>
                          
                          <table class="datatable-init nowrap nk-tb-list is-separate dataTable no-footer" data-auto-responsive="false" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
                              <thead>
                                  <tr class="nk-tb-item nk-tb-head" role="row">
                                      <th class="nk-tb-col sorting" ><span>ID</span></th>
                                      <th class="nk-tb-col  sorting" ><span>Name</span></th>
                                      <th class="nk-tb-col  sorting" ><span>Email</span></th>
                                      <th class="nk-tb-col  sorting" ><span>Amount</span></th>

                                  </tr>
                              </thead>
                              <tbody>
                                @if(count($affiliations) > 0)
              @foreach($affiliations as $affiliation)
                                  <tr class="nk-tb-item odd">
                                      <td class="nk-tb-col"><span class="tb-sub">{{$loop->index + 1}}</span></td>
                                      <td class="nk-tb-col"><span class="tb-sub"><span class="title">{{$affiliation->full_name}}</span></span></td>
                                      <td class="nk-tb-col">
                                          <span class="tb-sub"><span class="title">{{$affiliation->email}}</span></span>
                                      </td>
                                      @php
                                      if ($affiliation->subscription){
                        $subscription = $affiliation->subscription;
                                          $affiliation_settings = \App\Models\Affiliation::first();
                                        $amount = ($subscription->price * $affiliation_settings->percentage) / 100;
                    }else{
                        $amount = 0;
                    }
                    
                                      @endphp
                                    
                                      <td class="nk-tb-col">
                                          <span class="tb-sub"><span class="title">${{$amount}}</span></span>
                                      </td>
                                   </tr> 
                                   @endforeach
                                   @else
                                     <tr class="nk-tb-item odd">
                                       <th class="nk-tb-col " colspan="4">No Referrals</th>
                                     </tr>
                                   @endif
                                  
                              </tbody>
                          </table>
                          
                    
                      </div><!-- .col -->
                  </div><!-- .row -->



              </div><!-- .nk-block -->
          </div>
      </div>
  </div>
</div>
@endif
@endsection
