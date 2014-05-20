<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	show_tabs('<?php echo $open_tab?>');
	<?php
		if(isset($cancel_url))
			echo '$("#go_back").click(function(){ document.location="'.$cancel_url.'"})';
	?>
})
</script>
<style type="text/css">
textarea.form_input
{
	height:150px;
	width:100%;
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
			//var_dump($payment_log_data);
			
			if(count($payment_log_data)!=0)
			{
				$user_name=$this->common_model->getTableData("users",array("id"=>$payment_log_data[0]->user_id))->result();
				
				$order_detail=$this->common_model->getTableData("orders",array("id"=>$payment_log_data[0]->order_id))->result();
				
				echo '<div><h4>'.form_label("Order Id","Order_id_label").'</h4><br>'.$payment_log_data[0]->order_id.'</div><br>';
				
				echo '<div><h4>'.form_label("User","User_label").'</h4><br>'.$user_name[0]->user_name.'</div><br>';
				
				echo '<div><h4>'.form_label("Form Data","form_data_label").'</h4><br><textarea class="form_input">'.print_r(unserialize($payment_log_data[0]->retrun_array),TRUE).'</textarea></div><br>';
				
				echo '<div><h4>'.form_label("Debug Form","debug_form_label").'</h4><br><textarea class="form_input">'.$order_detail[0]->form_debug.'</textarea></div><br>';
				
				echo '<div><input type="button" name="go_back" id="go_back" value="Go Back" class="formbutton"></div>';
			}
		?>
   </div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>