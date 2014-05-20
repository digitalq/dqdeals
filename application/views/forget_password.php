<?php
	$this->load->view("header");
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
<style type="text/css">
.clsLoging_Form
{
	margin-left:20px;
}
</style>
<div class="clsFloatLeft" id="Main_left">
	<div class="inner_pages">
    	<h1 class="Main_Tittle"><span><?php echo $title?></span></h1>
        <br />
         <div class="clsInput_Bg1">
            <div class="clsLoging_Form">
                <div class="login_container">
                
			<?php 
				if($msg = $this->session->flashdata('flash_message'))
				{
					echo "<div>".$msg."</div><br>";
				}
							
                echo "<ul>".validation_errors('<li class="Frm_Error_Msg">', '</li>')."</ul>";
                
                echo form_open("home/forget_pwd",array("name"=>"forget_pwd_up","id"=>"forget_pwd_up"));
            ?>
        	<div class="form_input_con">
                <div class="label"><h4>Enter your Email Address :</h4><br /></div>
                <div class="clsE_Mail_Bg" style="width:201px;">
                    <p><span class="Input_Bg_log"><input type="text" class="clsEmail_Txt required email" name="forget_pwd_email" id="forget_pwd_email"/></span></p>
                </div>
                <div id="forget_pwd_up_error"></div>
            </div>
            <br />
            <div class="form_button_con">
                <p>
                    <input type="hidden" name="forget_pwd_up" id="forget_pwd_up" value="yes" />
                    
                    <input type="submit" class="Butt_Bg" value="Send"/>
                </p>
            </div>
            <div class="clear"></div>
				<?php echo form_close()?>
   			 </div>
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
