<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#addtext_form").validate({errorElement:"div"});
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
		$addtext_form=array("name"=>"addtext_form","id"=>"addtext_form","enctype"=>"multipart/form-data");
		
		$text_ad_name=array("name"=>"text_ad_name","id"=>"text_ad_name","class"=>"required forminput");
		
		$description=array("name"=>"description","id"=>"description","class"=>"forminput");
		
		$text_ad_url=array("name"=>"text_ad_url","id"=>"text_ad_url","class"=>"required url forminput");
		
		$add_submit=array("name"=>"addtext_submit","id"=>"addtext_submit","class"=>"formbutton","value"=>"Add","style"=>"float:left");
		
		$cancel_submit=array("name"=>"cancel_button","id"=>"cancel_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left", 'content' => 'Cancel');
		
		echo form_open('',$addtext_form);
		
		if(isset($text_ads))
		{
			$text_ad_name["value"]=$text_ads[0]->text_ad_name;
			
			$description["value"]=$text_ads[0]->description;
			
			$text_ad_url["value"]=$text_ads[0]->text_ad_url;
			
			$add_submit["value"]="Update";
			
			echo form_hidden("edit_id",$text_ads[0]->id);
			
		}
		?>
		<?php
        echo '<div><h4>'.form_label("Name","text_ad_label",array("class"=>"tTip","title"=>"Text Advertise Name")).'</h4><br>'.form_input($text_ad_name).'</div><br>';
		
		echo '<div><h4>'.form_label("Description","description_label",array("class"=>"tTip","title"=>"Text Advertise Description")).'</h4><br>'.form_input($description).'</div><br>';
		
		echo '<div><h4>'.form_label("Url","url_label",array("class"=>"tTip","title"=>"Text Advertise Description (what page or site to linked)")).'</h4><br>'.form_input($text_ad_url).'</div><br>';
		
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