<?php 
$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#add_social_form").validate({errorElement:"div"});
	show_tabs('<?php echo $open_tab?>');
	$(".<?php echo $open_tab?> .boxtitle").removeClass("closed");
	<?php
	if(isset($cancel_url))
		echo '$("#add_social_button").click(function(){ document.location="'.$cancel_url.'"})';
	?>
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
		
    ?>
    <?php
		$add_social_form=array("name"=>"add_social_form","id"=>"add_social_form","enctype"=>"multipart/form-data");
		
		$add_social_input=array("name"=>"social_name","id"=>"social_name","class"=>"required forminput");
		
		$add_social_url=array("name"=>"social_url","id"=>"social_url","class"=>"required url forminput");
		
		$add_submit=array("name"=>"add_social_submit","id"=>"add_social_submit","class"=>"formbutton","value"=>"Add","style"=>"float:left");
		
		$cancel_submit=array("name"=>"add_social_button","id"=>"add_social_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left", 'content' => 'Cancel');
		
		echo form_open('',$add_social_form);
		
		if(isset($social_datas))
		{
			$add_social_input["value"]=$social_name;
			
			$add_social_url["value"]=$social_url;
			
			$add_submit["value"]="Edit";
			
			echo form_hidden("edit_id",$edit_id);
			
		}
			
		echo '<div><h4>'.form_label("Name","social_name_label").'</h4><br>'.form_input($add_social_input).'</div><br>';
		
		echo '<div><h4>'.form_label("URL","social_url_label").'</h4><br>'.form_input($add_social_url).'</div><br>';
		
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