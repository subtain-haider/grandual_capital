<!-- footer @s -->
<div class="nk-footer">
    <div class="container-fluid">
        <div class="nk-footer-wrap">
            <div class="nk-footer-copyright"> &copy; 2021 Grandeurcapital Template by <a href="http://grandeurcapital.net/" target="_blank">grandeurcapital.net</a>
            </div>
       
        </div>
    </div>
</div>
<!-- footer @e -->
</div>
<!-- wrap @e -->
</div>
<!-- main @e -->
</div>
<!-- app-root @e -->

<!-- JavaScript -->
<script src="{{asset('admin/assets/js/bundle.js?ver=2.9.0')}}"></script>
<script src="{{asset('admin/assets/js/scripts.js?ver=2.9.0')}}"></script>
<script src="{{asset('admin/assets/js/charts/chart-ecommerce.js?ver=2.9.0')}}"></script>

<script>
    $( ".trigger" ).change(function() {
        if (this.value == 'Bitcoin'){
            $(".target_text").html('Bitcoin Wallet Address')
        }else{
            $(".target_text").html(this.value + ' email')
        }

    });
</script>
</body>

</html>