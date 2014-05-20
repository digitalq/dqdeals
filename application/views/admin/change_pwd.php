<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#change_pwd_form").validate({errorElement:"div"});
	show_tabs('<?php echo $open_tab?>');
	$(".<?php echo $open_tab?> .boxtitle").removeClass("closed");
	<?php
	if(isset($cancel_url))
		echo '$("#cancel_button").click(function(){ document.location="'.$cancel_url.'"});';
	?>
})

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
		
        $form_arribute=array("name"=>"change_pwd_form","id"=>"change_pwd_form");
        
        $add_submit=array("name"=>"change_pwd_submit","id"=>"change_pwd_submit","class"=>"formbutton","value"=>"Save","style"=>"float:left");
        
        $cancel_submit=array("name"=>"cancel_button","id"=>"cancel_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left","onclick"=>"goto_view_page()", 'content' => 'Cancel');
        
        echo form_open('',$form_arribute);
        
        $old_password_input=array("name"=>"old_password","id"=>"old_password","class"=>"forminput required");
		
		$new_password_input=array("name"=>"new_password","id"=>"new_password","class"=>"forminput required");
		
		$new_confirm_password=array("name"=>"new_confirm_password","id"=>"new_confirm_password","class"=>"forminput required");
		
		echo '<div><h4>'.form_label("Old Password","old_password_label").'</h4><br>'.form_password($old_password_input).'</div><br>';
		
		echo '<div><h4>'.form_label("New Password","new_password_label").'</h4><br>'.form_password($new_password_input).'</div><br>';
		
		echo '<div><h4>'.form_label("Confirm Password","new_password_confirm_label").'</h4><br>'.form_password($new_confirm_password).'</div>';
		
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