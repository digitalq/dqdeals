<?php $this->load->view("splash/header");?>
<script type="text/javascript">
$(document).ready(function(){
	$("#subscribe").validate({errorElement:"p",errorClass:"Frm_Error_Msg",focusInvalid: false});
})
</script>
<div id="selSignUp_Blk">
    	<h2>Sign up. <span>Get great deals.</span> Enjoy.</h2>
        <?php echo form_open("home/subscribe",array("name"=>"subscribe","id"=>"subscribe"))?>
        <div id="selSign_Form">
        	 <div class="clsInput_Bg1">
		         <p><input type="text" value="Enter your Email Address"  class="email" name="email" id="email"/></p>
                 <!--<p class="Frm_Error_Msg">Error Msg Here</p>-->
             </div>
             <div class="clsInput_Bg2">
		         <p>
                 	<select name="change_location_select" id="change_location_select" class="required">
                    	<option value="">Select</option>
				 		<?php echo $city_drop_down?>
                    </select>
                </p>
                 <!--<p class="Frm_Error_Msg">Error Msg Here</p>-->
             </div>
             <div class="clsButt_Blk">
             	<p class="clearfix">
                	<?php /*?><a class="clsSign_Link" href="#">SIGNUP</a><?php */?>
                    <input type="submit" id="subscribesubmit" name="subscribesubmit" value="Subscribe" class="clsSign_Btn" />
                    <a href="<?php echo $facebook_loginUrl?>"><img src="<?php echo base_url()?>images/face_butt.png" alt="image" /></a>
					<?php echo anchor("deals","Skip",array("class"=>"subscribe_skip"))?>
                      
                     <div class="clear"></div>
                </p>
             </div>
             <?php /*?><div class="subscribe_skip">
             	<p><?php echo anchor("deals","Skip")?></p>
             </div><?php */?>
        </div>
        <?php
			echo form_close();
		?>
        <h3>Offers from your city's best businesses brought to you by Moms, for Moms. Treat your family, reward yourself. Daily.</h3>
    </div>

<!-- End of Main -->
<?php $this->load->view("splash/footer");?>