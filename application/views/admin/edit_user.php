<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
	
$(document).ready(function(){
	show_tabs('<?php echo $open_tab?>');
	<?php if(!isset($user_id)) {?>
		$("#password").addClass('required');
	<?php }
	if(isset($cancel_url))
		echo '$("#user_cancel_button").click(function(){ document.location="'.$cancel_url.'"});';
	?>
	
	$("#add_user").validate({errorElement:"div"});
})
	
</script>
<style type="text/css">
.forminput
{
 width: 335px;
}
.select_box
{
 width: 350px;
}
</style>
<?php $this->load->view("admin/thesidebar");?>
<div id="dashboardwrap">
	<div id="dashboard" class="box new">
	<div id="dashboard-top">
    	<h2><?php if(isset($title)) echo ucfirst($title)?></h2><br />
    </div>
    <div id="dashboard-body">
    	<?php
			$email_fre_type=array(0=>"No",1=>"Yes");
			
			if($msg = $this->session->flashdata('flash_message'))
            {
            	echo "<div>".$msg."</div>";
            }
			
			$add_user_form=array("name"=>"add_user","id"=>"add_user");
			
			$email=array("name"=>"email","id"=>"email","class"=>"required email forminput");
			
			$first_name=array("name"=>"first_name","id"=>"first_name","class"=>"forminput");
			
			$last_name=array("name"=>"last_name","id"=>"last_name","class"=>"forminput");
			//$password=array("name"=>"password","id"=>"password","class"=>"forminput");
			
			$user_submit_button=array("name"=>"user_submit_button","id"=>"user_submit_button","class"=>"formbutton","value"=>"Add","style"=>"float:left");
        
        	$user_cancel_button=array("name"=>"user_cancel_button","id"=>"user_cancel_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left",'content' => 'Cancel');
		
			echo form_open('',$add_user_form);
			
				$default = 'UTC';
				
				if(isset($user_id))
				{
					echo form_hidden("edit_id",$user_id);
					
					echo form_hidden("mode","edit");
					
					echo form_hidden("edit_user","yes");
					
					$user_submit_button["value"]="Edit";
					
					//var_dump($user_details);
					if($user_details!="not_found")
					{
						$email["value"]=$user_details[0]->email;
						
						$first_name["value"]=$user_details[0]->first_name;
						
						$last_name["value"]=$user_details[0]->last_name;
						
						$default=$user_details[0]->time_zone;
						
						echo '<script type="text/javascript">
							$(document).ready(function(){
								$("#city").val(\''.$user_details[0]->city.'\');
								$("#email_frequency").val(\''.$user_details[0]->email_frequency.'\');
							})
						</script>';
					}
					else
					{
						$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','User Not found'));
						redirect(admin_url("users"));
					}
					
				}
				else
					echo form_hidden("add_user","yes");
					
				
					
				echo '<div><h4>'.form_label("User Email","email_label").'</h4><br>'.form_input($email).'</div><br>';
				
				echo '<div><h4>'.form_label("First Name","first_name_label").'</h4><br>'.form_input($first_name).'</div><br>';
				
				echo '<div><h4>'.form_label("Last Name","last_name_label").'</h4><br>'.form_input($last_name).'</div><br>';
				
				echo '<div><h4>'.form_label("Time Zone","time_zone_label").'</h4><br>'.timezone_menu($default, $class = "select_box",'timezones').'</div><br>';
				
				$email_fre_js = 'id="email_frequency" class="select_box required"';
				
				echo '<div><h4>'.form_label("Email Frequency","email_frequency_label").'</h4><br>'.form_dropdown("email_frequency",$email_fre_type,'',$email_fre_js).'</div><br>';
				
				$city_js= 'id="city" class="select_box"';
				
				echo '<div><h4>'.form_label("City","city_name_label").'</h4><br>'.form_dropdown("city",$city_drop_val,'',$city_js).'</div><br>';
				
				echo '<div><br>'.form_submit($user_submit_button).'<div style="width:10px;float:left">&nbsp;</div>'.form_button($user_cancel_button).'</div><div class="clear"></div>';
				
			echo form_close('',$add_user_form);
		?>
    </div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>