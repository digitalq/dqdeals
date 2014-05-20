<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#addbanner_form").validate({errorElement:"div"});
	show_tabs('<?php echo $open_tab?>');
	$(".<?php echo $open_tab?> .boxtitle").removeClass("closed");
	<?php
	if(isset($cancel_url))
		echo '$("#cancel_button").click(function(){ document.location="'.$cancel_url.'"});';
	?>
})
$(function() {
	//$('.tTip').tipsy({gravity: $.fn.tipsy.autoNS,html: true})
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
		$addbanner_form=array("name"=>"addbanner_form","id"=>"addbanner_form","enctype"=>"multipart/form-data");
		
		$banner_name=array("name"=>"banner_name","id"=>"banner_name","class"=>"required forminput");
		
		$code=array("name"=>"code","id"=>"code","class"=>"required forminput","style"=>"height:100px");
		
		$add_submit=array("name"=>"addbanner_submit","id"=>"addbanner_submit","class"=>"formbutton","value"=>"Add","style"=>"float:left");
		
		$cancel_submit=array("name"=>"cancel_button","id"=>"cancel_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left", 'content' => 'Cancel');
		
		echo form_open('',$addbanner_form);
		
		$selected='';
		
		if(isset($banners))
		{
			$banner_name["value"]=$banners[0]->bannername;
			
			$selected=$banners[0]->group_id;
			
			$code["value"]=$banners[0]->code;
			
			$add_submit["value"]="Update";
			
			echo form_hidden("edit_id",$banners[0]->id);
			
		}
		?>
		<?php
        echo '<div><h4>'.form_label("Name","name_label",array("class"=>"tTip","title"=>"Name of the banner")).'</h4><br>'.form_input($banner_name).'</div><br>';
		
		echo '<div><h4>'.form_label("Group","group_label",array("class"=>"tTip","title"=>"Banner Possition")).'</h4><br>'.form_dropdown("group_id",$group_datas,$selected,"id='group_id' class='select_box required'").'</div><br>';
		
		echo '<div><h4>'.form_label("Code","code_label",array("class"=>"tTip","title"=>"HTML Source of the Banner")).'</h4><br>'.form_textarea($code).'</div><br>';
		
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