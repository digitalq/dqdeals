<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#update_payment_setting").validate({errorElement:"div"});
	show_tabs('<?php echo $open_tab?>');
	$(".<?php echo $open_tab?> .boxtitle").removeClass("closed");
	<?php
	if(isset($cancel_url))
		echo '$("#cancel_button").click(function(){ document.location="'.$cancel_url.'"});';
	?>
})
$(function() {
	$('.tTip').tipsy({gravity: 'w',html: true})
});
</script>
<style type="text/css">
.select_box
{
	width:315px;
}
.forminput
{
	width:300px;
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
		
    ?>
    <?php
		$update_payment_setting=array("name"=>"update_payment_setting","id"=>"update_payment_setting");
		
		$name=array("name"=>"name","id"=>"name","class"=>"required forminput");
		
		$add_submit=array("name"=>"add_submit","id"=>"add_submit","class"=>"formbutton","value"=>"Save","style"=>"float:left");
        
        $cancel_submit=array("name"=>"cancel_button","id"=>"cancel_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left",'content' => 'Cancel');
		echo form_open('',$update_payment_setting);
	?>
        <div style="float:left; width:333px;">
		<?php
			$name["value"]=$gate_way_name;
			
			echo '<div><h4>'.form_label("Pay Gateway","account_label",array("class"=>"tTip","title"=>"The pay gateway module.")).'</h4><br>'.ucwords($payment_type).'</div><br>';
		?>
        </div>
        <div style="float:left">
		<?php
			echo '<div><h4>'.form_label("Name","name_label",array("title"=>"Please enter a name for this pay gateway. The name will be displayed throughout the system (admin/order forms/customer area) in refrence to this gateway.","class"=>"tTip")).'</h4><br>'.form_input($name).'</div><br>';
		?>
        </div>
        <div class="clear"></div>
        <?php
			echo $pament_type_form;
			
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