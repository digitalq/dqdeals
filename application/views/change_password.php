<?php
	$this->load->view("header");
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#change_password_form").validate({errorElement:"p",errorClass:"Frm_Error_Msg",focusInvalid: false})
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
        <?php
			$this->load->view("user_tabs",array("select_tab"=>"change_password"));
		?>
        <br />
         <div class="clsInput_Bg1">
            <div class="login_container" style="width:201px;">
            	<?php
					$email_fre_type=array(0=>"No",1=>"Yes");
			
					if($msg = $this->session->flashdata('flash_message'))
					{
						echo "<div>".$msg."</div>";
					}
					
					echo "<ul>".validation_errors('<li class="Frm_Error_Msg">', '</li>')."</ul>";
					
					$change_password_form=array("name"=>"change_password_form","id"=>"change_password_form");
					
					$old_password=array("name"=>"old_password","id"=>"old_password","class"=>"required forminput");
					
					$password=array("name"=>"password","id"=>"password","class"=>"forminput required");
					
					$confirm_password=array("name"=>"confirm_password","id"=>"confirm_password","class"=>"forminput required");
					
					$user_submit_button=array("name"=>"change_password_button","id"=>"change_password_button","class"=>"Butt_Bg","value"=>"Save","style"=>"float:left");
				
					$user_cancel_button=array("name"=>"user_cancel_button","id"=>"user_cancel_button","class"=>"Butt_Bg","value"=>"Cancel","style"=>"float:left",'content' => 'Cancel');
				
					echo form_open('',$change_password_form);
			
					
					$not_login=0;
					
					if(isset($user_detail) && count($user_detail)!=0)
					{
						if($user_detail[0]->id==$user_id)
						{
							$not_login=0;	
						}
						else
							$not_login=1;
					}
					else
						$not_login=1;
						
					if($not_login==1)
					{
						$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Denided'));
						redirect("signup");
					}
					
					echo '<div><h4>'.form_label("Old Password","old_password_label").'&nbsp;<span class="required_fields">*</span></h4><br><span class="Input_Bg_log">'.form_password($old_password).'</span></div><br>';
					
					echo '<div><h4>'.form_label("Password","first_name_label").'&nbsp;<span class="required_fields">*</span></h4><br><span class="Input_Bg_log">'.form_password($password).'</span></div><br>';
					
					echo '<div><h4>'.form_label("confirm Password","last_name_label").'&nbsp;<span class="required_fields">*</span></h4><br><span class="Input_Bg_log">'.form_password($confirm_password).'</span></div><br>';
					
					echo '<div><br>'.form_submit($user_submit_button).'<div style="width:10px;float:left">&nbsp;</div>'.form_button($user_cancel_button).'</div><div class="clear"></div>';
				?>
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
