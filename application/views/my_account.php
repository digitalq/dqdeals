<?php
	$this->load->view("header");
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#add_user").validate({errorElement:"p",errorClass:"Frm_Error_Msg",focusInvalid: false})
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
			$this->load->view("user_tabs",array("select_tab"=>"myaccout"));
		?>
        <br />
            <div class="login_container">
            	<?php
					$email_fre_type=array(0=>"No",1=>"Yes");
			
					if($msg = $this->session->flashdata('flash_message'))
					{
						echo "<div>".$msg."</div>";
					}
					
					$add_user_form=array("name"=>"add_user","id"=>"add_user");
					
					$email=array("name"=>"email","id"=>"email","class"=>"required email forminput");
					
					$first_name=array("name"=>"first_name","id"=>"first_name","class"=>"required forminput");
					
					$last_name=array("name"=>"last_name","id"=>"last_name","class"=>"forminput");
					//$password=array("name"=>"password","id"=>"password","class"=>"forminput");
					
					$user_submit_button=array("name"=>"user_submit_button","id"=>"user_submit_button","class"=>"Butt_Bg","value"=>"Save","style"=>"float:left");
				
					$user_cancel_button=array("name"=>"user_cancel_button","id"=>"user_cancel_button","class"=>"Butt_Bg","value"=>"Cancel","style"=>"float:left",'content' => 'Cancel');
				
					echo form_open('',$add_user_form);
			
					$default = 'UTC';
					
					$not_login=0;
					
					if(isset($user_detail) && count($user_detail)!=0)
					{
						if($user_detail[0]->id==$user_id)
						{
							$email["value"]=$user_detail[0]->email;
							
							$first_name["value"]=$user_detail[0]->first_name;
							
							$last_name["value"]=$user_detail[0]->last_name;
							
							$default=$user_detail[0]->time_zone;
							
							echo '<script type="text/javascript">
								$(document).ready(function(){
									$("#city").val(\''.$user_detail[0]->city.'\');
									$("#email_frequency").val(\''.$user_detail[0]->email_frequency.'\');
								})
							</script>';
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
					
					echo '<div><h4>'.form_label("Email","email_label").'</h4><br><span class="Input_Bg_log">'.form_input($email).'</span></div><br>';
										
					echo '<div><h4>'.form_label("First Name","first_name_label").'</h4><br><span class="Input_Bg_log">'.form_input($first_name).'</span></div><br>';
					
					echo '<div><h4>'.form_label("Last Name","last_name_label").'</h4><br><span class="Input_Bg_log">'.form_input($last_name).'</span></div><br>';
					
					echo '<div><h4>'.form_label("Time Zone","time_zone_label").'</h4><br><span class="InputBg_Slecet">'.timezone_menu($default, $class = "select_box",'timezones').'</span></div><br>';
					
					$email_fre_js = 'id="email_frequency" class="select_box required"';
					
					echo '<div><h4>'.form_label("Email Frequency","email_frequency_label").'</h4><br><span class="InputBg_Slecet">'.form_dropdown("email_frequency",$email_fre_type,'',$email_fre_js).'</span></div><br>';
					
					$city_js= 'id="city" class="select_box"';
					
					echo '<div><h4>'.form_label("City","city_name_label").'</h4><br><span class="InputBg_Slecet">'.form_dropdown("city",$city_drop_val,'',$city_js).'</span></div><br>';
					
					echo '<div><br>'.form_submit($user_submit_button).'<div style="width:10px;float:left">&nbsp;</div>'.form_button($user_cancel_button).'</div><div class="clear"></div>';
				?>
            </div>
            <div class="login_ad_container">
               
            </div>
        	<div class="clear"></div>
       
   </div>
</div>
<?php
$this->load->view("right_side_bar");
?>    
<?php
	$this->load->view("footer");
?>
