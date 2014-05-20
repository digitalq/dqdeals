<?php
	$this->load->view("header");
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#user_login").validate({errorElement:"p",errorClass:"Frm_Error_Msg",focusInvalid: false})
}) 
</script>
<div class="clsFloatLeft" id="Main_left">
	<div class="clsLoging_Form">
    	<h1 class="Main_Tittle"><span><?php echo $title?></span></h1>
         <div class="clsInput_Bg1">
            <div class="login_container">
            	
            </div>
            <div class="login_ad_container">
               
            </div>
        	<div class="clear"></div>
        </div>
   </div>
</div>
<?php
$this->load->view("right_side_bar");
?>    
<?php
	$this->load->view("footer");
?>
