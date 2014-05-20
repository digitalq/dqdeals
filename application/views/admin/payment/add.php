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
		echo '$("#cancel_button").click(function(){ document.location="'.$cancel_url.'"});';
	?>
	
	$("#add_payment_gateway").validate({errorElement:"div"});
})
$(function() {
	$('.tTip').tipsy({gravity: 'w',html: true})
});
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
			
			if($msg = $this->session->flashdata('flash_message'))
            {
            	echo "<div>".$msg."</div>";
            }
			
			$add_payment_gateway=array("name"=>"add_payment_gateway","id"=>"add_payment_gateway");
			
			$name=array("name"=>"name","id"=>"name","class"=>"required forminput");
			
			
			$paypent_gateway_submit_button=array("name"=>"paypent_gateway_submit_button","id"=>"paypent_gateway_submit_button","class"=>"formbutton","value"=>"Add","style"=>"float:left");
        
        	$cancel_button=array("name"=>"cancel_button","id"=>"cancel_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left",'content' => 'Cancel');
		
			echo form_open('',$add_payment_gateway);
			
			echo '<div><h4>'.form_label("Name","name_label",array("title"=>"Please enter a name for this pay gateway. The name will be displayed throughout the system (admin/order forms/customer area) in refrence to this gateway.","class"=>"tTip")).'</h4><br>'.form_input($name).'</div><br>';
			
			echo '<div><h4>'.form_label("Payment Gateway Type","gateway_type_label",array("title"=>"Please choose a payment gateway from the list.","class"=>"tTip")).'</h4><br>
					<select name="gateway_type" id="gateway_type" class="select_box required">
					<option value="">Select</option>
						'.dropdown_box("gateway_type","id","name",array("product_type"=>0)).'
					</select>
				  </div><br>';
				  
			echo '<div><h4>'.form_label("Use E-mail Configuration","email_config_label",array("title"=>"Choose the default e-mail configuration for this pay gateway. It will be use anytime e-mail is sent.","class"=>"tTip")).'</h4><br>
					<select name="email_configuration_id" id="email_configuration_id" class="select_box required">
						<option value="'.$this->config->item("site_admin_mail").'">'.$this->config->item("site_admin_mail").'</option>
					</select>
				  </div><br>';
			
			echo '<div><br>'.form_submit($paypent_gateway_submit_button).'<div style="width:10px;float:left">&nbsp;</div>'.form_button($cancel_button).'</div><div class="clear"></div>';
				
			echo form_close();
		?>
    </div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>