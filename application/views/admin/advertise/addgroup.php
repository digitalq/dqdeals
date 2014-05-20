<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#addgroup_form").validate({errorElement:"div"});
	show_tabs('<?php echo $open_tab?>');
	$(".<?php echo $open_tab?> .boxtitle").removeClass("closed");
	<?php
	if(isset($cancel_url))
		echo '$("#cancel_button").click(function(){ document.location="'.$cancel_url.'"});';
	if(isset($groups))
		echo '$("[name=rotating]").filter("[value='.$groups[0]->rotating.']").attr("checked","checked")';
	else
		echo '$("[name=rotating]").filter("[value=1]").attr("checked","checked")';
	?>
})

</script>
<style type="text/css">
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
		$addgroup_form=array("name"=>"addgroup_form","id"=>"addgroup_form","enctype"=>"multipart/form-data");
		
		$group_name=array("name"=>"group_name","id"=>"group_name","class"=>"required forminput");
		
		$height=array("name"=>"height","id"=>"height","class"=>"required forminput");
		
		$width=array("name"=>"width","id"=>"width","class"=>"required forminput");
		
		$rotating_option_yes=array("name"=>"rotating","value"=>'1');
		
		$rotating_option_no=array("name"=>"rotating","value"=>'0');
		
		$add_submit=array("name"=>"addgroup_submit","id"=>"addgroup_submit","class"=>"formbutton","value"=>"Add","style"=>"float:left");
		
		$cancel_submit=array("name"=>"cancel_button","id"=>"cancel_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left", 'content' => 'Cancel');
		
		echo form_open('',$addgroup_form);
		
		if(isset($groups))
		{
			$group_name["value"]=$groups[0]->group_name;
			
			$height["value"]=$groups[0]->height;
			
			$width["value"]=$groups[0]->width;
			
			$add_submit["value"]="Update";
			
			echo form_hidden("edit_id",$groups[0]->id);
			
		}
		?>
		<?php
        echo '<div><h4>'.form_label("Group Name","group_name_label").'</h4><br>'.form_input($group_name).'</div><br>';
		
		echo '<div><h4>'.form_label("Width","width_label").'</h4><br>'.form_input($width).'</div><br>';
		
		echo '<div><h4>'.form_label("Height","height_label").'</h4><br>'.form_input($height).'</div><br>';
		
		echo '<div><h4>'.form_label("Rotating","rotating_label").'</h4><br>'.form_radio($rotating_option_yes).'&nbsp;Yes'.'&nbsp;'.form_radio($rotating_option_no).'&nbsp;No</div><br>';
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