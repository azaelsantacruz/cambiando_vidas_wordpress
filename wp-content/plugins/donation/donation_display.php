<link rel="stylesheet" href="<?php echo bloginfo('url'); ?>/wp-content/plugins/donation/css/rangeslider.css"/>
<script src="<?php echo bloginfo('url'); ?>/wp-content/plugins/donation/js/rangeslider.min.js"></script>
<script>


jQuery(function() {
    var $document   = jQuery(document),
        $inputRange = jQuery('input[type="range"]');
    
    // Example functionality to demonstrate a value feedback
    function valueOutput(element) {
        var value = element.value;
        jQuery( "#amount" ).val( element.value );
        
if(value > 300 && value <= 1000 ){

        jQuery( ".lip4" ).addClass( "active_highlight" );


            jQuery('.lip_cnt4').show();
            jQuery('.lip_cnt5').hide();
}else
{
       jQuery( ".lip4" ).removeClass( "active_highlight" );

            jQuery('.lip_cnt4').hide();


}


if(value > 1000 && value <= 5000 ){

    jQuery( ".lip3" ).addClass( "active_highlight" );
    jQuery('.lip_cnt3').show();

}else{
    jQuery( ".lip3" ).removeClass( "active_highlight" );
    jQuery('.lip_cnt3').hide();
}


if(value > 5000 && value <=  10000 ){
        jQuery( ".lip2" ).addClass( "active_highlight" );
 jQuery('.lip_cnt2').show();

}else {
    jQuery( ".lip2" ).removeClass( "active_highlight" );
     jQuery('.lip_cnt2').hide();
}


if(value >=  10001 ){
        jQuery( ".lip1" ).addClass( "active_highlight" );
        jQuery("#amount").removeAttr("readonly");
         jQuery('.lip_cnt1').show();
}else {
     jQuery('.lip_cnt1').hide();
     jQuery("#amount").attr("readonly", true);
    jQuery( ".lip1" ).removeClass( "active_highlight" );
}


if(value > 0 && value <= 300 ){
    jQuery( ".lip5" ).addClass( "active_highlight" );

 jQuery('.lip_cnt5').show();

}else{

 jQuery( ".lip5" ).removeClass( "active_highlight" );

}
        
    
    }
    for (var i = $inputRange.length - 1; i >= 0; i--) {
        valueOutput($inputRange[i]);
        
    };
    $document.on('input', 'input[type="range"]', function(e) {
        valueOutput(e.target);
    });

  
    $inputRange.rangeslider({
      polyfill: false 
    });
});
</script>
<style>
output {
  display: block;
  text-align: center;
}
.ui-widget-header {
  background: #6910a2 !important;
}
.cnt_hidea {
  display: none!important;
}
.active_highlight {
  font-weight: bold;
}
.leftcnt p {
  margin: 0;
  color: #fff;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
  background: #6910a2;
  border: medium none;
  top: -3px;
}
.ui-corner-all {
  border-radius: 0 !important;
  background: #aaa;
  border: 0 !important;
}
</style>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="box-wrapper">
      <div class="custom_donation">
        <div class="row">
          <ul class="leftcnt col-md-3">
            <li class="lip1">
              <p><b><?php echo $donation_members[0]['donation_name']; ?></b><br />
                $10000-?</p>
            </li>
            <li class="lip2">
              <p><b><?php echo $donation_members[1]['donation_name']; ?></b><br />
                $5000-$10000</p>
            </li>
            <li class="lip3">
              <p><b><?php echo $donation_members[2]['donation_name']; ?></b><br />
                $1000-$5000</p>
            </li>
            <li class="lip4">
              <p><b><?php echo $donation_members[3]['donation_name']; ?></b><br />
                $300-$1000</p>
            </li>
            <li class="lip5">
              <p><b><?php echo $donation_members[4]['donation_name']; ?></b><br />
                $5-$300</p>
            </li>
          </ul>
          <div class="right_cnt col-md-5"> <span style="display: none;" class="lip_cnt1 row">
            <div class="col-md-6"><?php echo $donation_members[0]['donation_description']; ?></div>
            <div class="col-md-6"><?php echo "<img class='dntclass' src='".  plugins_url() ."/donation/members/thumb/". $donation_members[0]['donation_images']."' />"; ?></div>
            </span> <span style="display: none;" class="lip_cnt2 row">
            <div class="col-md-6"><?php echo $donation_members[1]['donation_description']; ?></div>
            <div class="col-md-6"><?php echo "<img class='dntclass' src='".  plugins_url() ."/donation/members/thumb/". $donation_members[1]['donation_images']."' />"; ?></div>
            </span> <span style="display: none;" class="lip_cnt3 row">
            <div class="col-md-6"><?php echo $donation_members[2]['donation_description']; ?></div>
            <div class="col-md-6"><?php echo "<img class='dntclass' src='".  plugins_url() ."/donation/members/thumb/". $donation_members[2]['donation_images']."' />"; ?></div>
            </span> <span style="display: none;" class="lip_cnt4 row">
            <div class="col-md-6"><?php echo $donation_members[3]['donation_description']; ?></div>
            <div class="col-md-6"><?php echo "<img class='dntclass' src='".  plugins_url() ."/donation/members/thumb/". $donation_members[3]['donation_images']."' />"; ?></div>
            </span> <span class="lip_cnt5 row">
            <div class="col-md-6"><?php echo $donation_members[4]['donation_description']; ?></div>
            <div class="col-md-6"><?php echo "<img class='dntclass' src='".  plugins_url() ."/donation/members/thumb/". $donation_members[4]['donation_images']."' />"; ?></div>
            </span> </div>
          <div class="tester col-md-4">
            <p class="valu"></p>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="cmd" value="_donations">
              <input type="hidden" name="business" value="planeacion@cambiandovidas.org">
              <input type="hidden" name="item_name" value="Cambiando Vidas">
              <input type="hidden" name="item_number" value="Gracias por tu donativo">
              <input type="hidden" name="no_note" value="0">
              <input type="hidden" name="currency_code" value="MXN">
              <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
              <input type="hidden" name="no_shipping" value="0">
              <input type="hidden" name="lc" value="MX">
              <input type="hidden" name="bn" value="PP-BuyNowBF">
              <input type="hidden" name="return" value="http://cloudinnovatesolutions.com/">
              <h4>CANTIDAD A DONAR:</h4>
              <p class="amount">$
                <input type="text" id="amount" name="amount" value="30" readonly="readonly" style="font-size:59px; border:0; color:#f6931f; font-weight:bold;">
              </p>
              <br />
              <br />
              <input class="alignright" type="submit" value="DONAR AHORA">
            </form>
          </div>
        </div>
        <output></output>
        <!-- <div class="drgimgslider"> </div> -->
          <input type="range" min="50" max="10500" step="5" value="5">
    
        </div>
      </div>
    </div>
  </div>
</div>
