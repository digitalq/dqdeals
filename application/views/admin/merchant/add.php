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
	
	$("#add_merchant").validate({errorElement:"div"});
})
	
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		editor_deselector : "mceNoEditor"

	});
</script>
<style type="text/css">
.forminput
{
 width: 300px;
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
			
			$add_user_form=array("name"=>"add_merchant","id"=>"add_merchant","enctype"=>"multipart/form-data");
			
			$email=array("name"=>"email","id"=>"email","class"=>"required email forminput");
			
			$first_name=array("name"=>"first_name","id"=>"first_name","class"=>"forminput required");
			
			$company_name=array("name"=>"company_name","id"=>"company_name","class"=>"forminput required");
			
			$site_url=array("name"=>"site_url","id"=>"site_url","class"=>"forminput url required");
			
			$zip_code=array("name"=>"zip_code","id"=>"zip_code","class"=>"forminput");
			
			$division_lat=array("name"=>"division_lat","id"=>"division_lat","class"=>"forminput");
			
			$division_lng=array("name"=>"division_lng","id"=>"division_lng","class"=>"forminput");
			
			$zip_code=array("name"=>"zip_code","id"=>"zip_code","class"=>"forminput");
			
			$contact_no=array("name"=>"contact_no","id"=>"contact_no","class"=>"forminput");
			
			$address=array("name"=>"address","id"=>"address","class"=>"forminput required mceNoEditor","style"=>"height:150px;");
			
			$comapny_detail=array("name"=>"comapny_detail","id"=>"comapny_detail","class"=>"forminput","style"=>"height:150px;width:97%");
			
			$last_name=array("name"=>"last_name","id"=>"last_name","class"=>"forminput");
			
			$website_image=array("name"=>"website_image","id"=>"website_image");
			
			//$password=array("name"=>"password","id"=>"password","class"=>"forminput");
			
			$user_submit_button=array("name"=>"user_submit_button","id"=>"user_submit_button","class"=>"formbutton","value"=>"Add","style"=>"float:left");
        
        	$user_cancel_button=array("name"=>"user_cancel_button","id"=>"user_cancel_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left",'content' => 'Cancel');
		
			echo form_open('',$add_user_form);
			
				$default = 'UTC';
				
				$image_url='';
					
				$comapny_detail_text='';
				
				if(isset($mergent_id))
				{
					echo form_hidden("edit_id",$mergent_id);
					
					echo form_hidden("mode","edit");
					
					echo form_hidden("edit_merchant","yes");
					
					$user_submit_button["value"]="Edit";
					
					//var_dump($user_details);
					
					
					
					if($mergent_details!="not_found")
					{
						$email["value"]=$mergent_details[0]->email;
						
						$first_name["value"]=$mergent_details[0]->first_name;
						
						$last_name["value"]=$mergent_details[0]->last_name;
						
						$company_name["value"]=$mergent_details[0]->company_name;
						
						$contact_no["value"]=$mergent_details[0]->phone_no;
						
						$comapny_detail_text=$mergent_details[0]->company_detail;
						
						$site_url["value"]=$mergent_details[0]->site_url;
						
						$zip_code["value"]=$mergent_details[0]->zipcode;
						
						$address["value"]=$mergent_details[0]->address;
						
						$division_lat["value"]=$mergent_details[0]->division_lat;
						
						$division_lng["value"]=$mergent_details[0]->division_lng;
						
						$image_url=base_url()."uploads/web_site_logo/".$mergent_details[0]->logo;
						
					}
					else
					{
						$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','User Not found'));
						redirect(admin_url("users"));
					}
					
				}
				else
					echo form_hidden("add_merchant","yes");
					
				?>
                <div style="float:left; margin-right:20px;">
                <?php
					echo '<div><h4>'.form_label("First Name","first_name_label").'&nbsp;<span class="require_field">*</span></h4><br>'.form_input($first_name).'</div><br>';
                    
                    echo '<div><h4>'.form_label("Last Name","last_name_label").'</h4><br>'.form_input($last_name).'</div><br>';
                    
					echo '<div><h4>'.form_label("Email","email_label").'&nbsp;<span class="require_field">*</span></h4><br>'.form_input($email).'</div><br>';
					
					//echo '<div><h4>'.form_label("Google map latitude","email_label").'</h4><br>'.form_input($division_lat).'</div><br>';
					
					echo '<div><h4>'.form_label("Address","address_label").'&nbsp;<span class="require_field">*</span></h4><br>'.form_textarea($address).'</div><br>';
				?>
                </div>
				<div style="float:left">
				<?php
                    echo '<div><h4>'.form_label("Company Name","company_name_label").'</h4><br>'.form_input($company_name).'</div><br>';
                    
                    echo '<div><h4>'.form_label("Site Url","site_url_label").'&nbsp;<span class="require_field">*</span></h4><br>'.form_input($site_url).'</div><br>';
					
					echo '<div><h4>'.form_label("Contact No","contact_no_label").'</h4><br>'.form_input($contact_no).'</div><br>';
					
					//echo '<div><h4>'.form_label("Google map longitude","longitude_label").'</h4><br>'.form_input($division_lng).'</div><br>';
                    
					echo '<div><h4>'.form_label("Zip code","zip_code_label").'</h4><br>'.form_input($zip_code).'</div><br>';
					
					if($image_url!='')
					{
						echo '<img src="'.$image_url.'"/><br>';
						
						echo form_hidden("exsits_image",str_replace(base_url()."uploads/web_site_logo/","",$image_url));
					}
					
					echo '<div><h4>'.form_label("Logo","logo_label").'</h4><br>'.form_upload($website_image).'<br><span>(Max Height:150px and Max width 150px)</span></div><br>';
                    
                ?>
                </div>
                <div class="clear"></div>
                
                <?php
				
				echo '<div><h4>'.form_label("About Us","about_us_label").'</h4><br><textarea name="comapny_detail" id="comapny_detail" style="height:150px;width:97%">'.$comapny_detail_text.'</textarea></div><br>';
				
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