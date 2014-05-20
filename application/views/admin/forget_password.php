<?php 
$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
$("#forget_pwd_up").validate({
		errorElement:"div",
		wrapper: "div",  // a wrapper around the error message
        errorPlacement: function(error, element) {
            error.appendTo($("#forget_pwd_up_error"));
        }
		
	});
})
</script>
<div id="loginbox" class="box">
        <div id="loginbox-top">
            <h4>Forgot password</h4>
            <div class="clear"></div>
        </div>
        <div id="loginbox-body">
    	<?php echo form_open(admin_url("admin/forget_pwd"),array("name"=>"forget_pwd_up","id"=>"forget_pwd_up"))?>
        	<br>
            <?php
			//Show Flash Message
				if($msg = $this->session->flashdata('flash_message'))
				{
					echo "<div>".$msg."</div>";
				}
	  		?>
        	<div class="form_input_con">
                <div><h4>Enter your Email Address :</h4></div>
                <br>
                <div class="clsE_Mail_Bg">
                    <p><input type="text" class="forminput required email" name="forget_pwd_email" id="forget_pwd_email"/></p>
                </div>
                <div id="forget_pwd_up_error"></div>
            </div>
            <br>
            <div class="form_button_con">
                <p>
                    <input type="hidden" name="forget_pwd_up" id="forget_pwd_up" value="yes" />
                    
                    <input type="submit" class="formbutton" value="Send"/>
                </p>
            </div>
            <div class="clear"></div>
             <br><br><br>
		<?php echo form_close()?>
       </div>
   </div>
   <br>
<?php
$this->load->view("admin/footer");
?>