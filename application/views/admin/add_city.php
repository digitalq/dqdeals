<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
	
$(document).ready(function(){
	show_tabs('<?php echo $open_tab?>');
	<?php if(isset($country_id)) {?>
		$("#country").val('<?php echo $country_id?>');
	<?php }
		if(isset($cancel_url))
			echo '$("#cancel_button").click(function(){ document.location="'.$cancel_url.'"});';
	?>
	
	$("#add_city").validate({errorElement:"div"});
	
	$("#city_name").alphanumeric({allow:".,-,_, ,&"});
})
	
</script>
<?php $this->load->view("admin/thesidebar");?>
<div id="dashboardwrap">
	<div id="dashboard" class="box new">
	<div id="dashboard-top">
    	<h2><?php if(isset($title)) echo ucfirst($title)?></h2><br />
    </div>
    <div id="dashboard-body">
    	<?php
			if($msg = $this->session->flashdata('flash_message'))
            {
            	echo "<div>".$msg."</div>";
            }
			
			$add_city_form=array("name"=>"add_city","id"=>"add_city");
			
			$city_input=array("name"=>"city_name","id"=>"city_name","class"=>"required forminput");
			
			$add_submit=array("name"=>"add_city_submit","id"=>"add_city_submit","class"=>"formbutton","value"=>"Add","style"=>"float:left");
        
        	$cancel_submit=array("name"=>"cancel_button","id"=>"cancel_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left", 'content' => 'Cancel');
		
			echo form_open('',$add_city_form);
			
			$js = 'id="country" class="select_box required"';
			
			if(isset($city_id))
				$city_input["value"]=$city_name;
				
			if(isset($city_id))
			{
				echo form_hidden("edit_id",$city_id);
				echo form_hidden("mode","edit");
				
				$add_submit["value"]="Edit";
				
				if($mode=="manage")
					$add_submit["value"]="Save";
				
			}
			
			if($mode!="manage")
			{
				if(isset($country_drop_val))
					echo '<div><h4>'.form_label("Country Name","country_name_label").'</h4><br>'.form_dropdown("country",$country_drop_val,'',$js).'</div><br>';
			}
				
			if($mode!="manage")
			{
				echo '<div><h4>'.form_label("City Name","city_name_label").'</h4><br>'.form_input($city_input).'</div><br>';
			}
		
			if(isset($web_site_city_name_texts))
			{
				echo $web_site_city_name_texts;
			}
			if(isset($website_count))
				echo form_hidden("website_count",$website_count);
			
			echo '<div><br>'.form_submit($add_submit).'<div style="width:10px;float:left">&nbsp;</div>'.form_button($cancel_submit).'</div><div class="clear"></div>';
			
			echo form_close();			
		?>
   </div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>