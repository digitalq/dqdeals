<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#site_map_form").validate({errorElement:"div"});
	show_tabs('<?php echo $open_tab?>');
	$(".<?php echo $open_tab?> .boxtitle").removeClass("closed");
	<?php
	if(isset($cancel_url))
		echo '$("#cancel_button").click(function(){ document.location="'.$cancel_url.'"});';
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
		$site_map_form=array("name"=>"site_map_form","id"=>"site_map_form","enctype"=>"multipart/form-data");
		
		$xml_file=array("name"=>"xml_file","id"=>"xml_file","class"=>"required forminput");
		
		$add_submit=array("name"=>"addxml_submit","id"=>"addxml_submit","class"=>"formbutton","value"=>"Save","style"=>"float:left");
		
		$cancel_submit=array("name"=>"cancel_button","id"=>"cancel_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left", 'content' => 'Cancel');
		
		echo form_open('',$site_map_form);
		
		?>
		<?php
        echo '<div><h4>'.form_label("Xml file","Xml_label").'</h4><br>'.form_upload($xml_file).'<br>(xml files only)</div><br>';
		
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