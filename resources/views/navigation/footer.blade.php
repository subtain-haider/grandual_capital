<div style="min-height: 30px;"></div>	

	
	
	
	
	
	
	
	
<footer class="bg-white text-left text-lg-start">
  <!-- Grid container -->
  <div class="container bg-white p-4">
    <!--Grid row-->
    <div class="row">
      <!--Grid column-->
      <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase">About us</h5>
        <p>
          {!! nl2br(sys_info('about_us_block')) !!}
        </p>
		  
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase">Links</h5>

        <ul class="list-unstyled mb-0">
          <li>
            <a href="{{ route ('Search_page', ['thing' => '', 'word' => '', 'sort' => '', 'cat' => '']) }}" class="text-dark">Search</a>
          </li>
{{--          <li>--}}
{{--            <a href="{{ route('member_list') }}" class="text-dark">Members</a>--}}
{{--          </li>--}}
          <li>
            <a href="{{ route('show_staffs') }}" class="text-dark">Staff Members</a>
          </li>
          <li>
            <a href="{{ route('show_banlist') }}" class="text-dark">Banned Members</a>
          </li>
          <li>
            <a href="{{ route('show_rules') }}" class="text-dark">Therms of use</a>
          </li>
          <li>
            <a href="{{ route('about_us') }}" class="text-dark">About us</a>
          </li>
          <li>
            <a href="{{ route('HelpForm.contact') }}" class="text-dark">Contact</a>
          </li>
        </ul>

      </div>
      <!--Grid column-->

      @if(ad_Info(6,'ad_show')=="on")
      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-0">{{ ad_Info(6,'title') }}</h5>
        <div class="pl-0 pr-0 pb-0 pt-2">
          {!! ShowAd(6) !!}
        </div>
      </div>
      <!--Grid column-->
      @endif
    </div>
    <!--Grid row-->
    @if(ad_Info(7,'ad_show')=="on")
    <h5 class="text-uppercase mb-0">{{ ad_Info(7,'title') }}</h5>
    <div class="pl-0 pr-0 pb-0 pt-2">
      {!! ShowAd(7) !!}
    </div>
    @endif
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center bg-white p-3">
	  <div class="container">
	  
	    <div class="row">
    <div class="col text-left">
		<a class="logolink" href="#home"><img src="{{ asset('front_assets/img/soft/logo/logo1.png') }}" height="50"></a>
	</div>
	 </div>
	  <strong>© {{ date('Y') }} {{ env('APP_NAME') }}</strong>
	  
  </div>
	  </div>
  <!-- Copyright -->
</footer>
	
	
<script>
	function opencatsmenu(){
		var mq = window.matchMedia( "(max-width: 992px)" );
		if (mq.matches) {
    		// window width is at less than 800px
			w3.toggleShow("#cats-menu");
		}
	}
	
	function myFunction(x) {

		if (x.matches) { // If media query matches
			// dont show anyway
		}else{
			w3.hide("#cats-menu");
		}
	}
	var x = window.matchMedia("(max-width: 992px)")
	myFunction(x) // Call listener function at run time
	x.addListener(myFunction) // Attach listener function on state changes
</script>
