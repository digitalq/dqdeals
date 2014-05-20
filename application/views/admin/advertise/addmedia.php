<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#addmedia_form").validate({errorElement:"div"});
	show_tabs('<?php echo $open_tab?>');
	$(".<?php echo $open_tab?> .boxtitle").removeClass("closed");
	<?php
	if(isset($cancel_url))
		echo '$("#cancel_button").click(function(){ document.location="'.$cancel_url.'"});';
	if(isset($media_ads))
		echo '$("#media_file").removeClass("required");';
	?>
})
$(function() {
	//$('.tTip').tipsy({gravity: $.fn.tipsy.autoNS,html: true})
	$('.tTip').tipsy({gravity: 'w',html: true})
});
</script>
<script type="text/javascript" src="<?php echo base_url()?>uploads/player/jwplayer.js"></script>
<?php /*?><script type="text/javascript" src="<?php echo base_url()?>uploads/player/swfobject.js"></script><?php */?>
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
		$addmedia_form=array("name"=>"addmedia_form","id"=>"addmedia_form","enctype"=>"multipart/form-data");
		
		$addmedia_name=array("name"=>"media_name","id"=>"media_name","class"=>"required forminput");
		
		$description=array("name"=>"description","id"=>"description","class"=>"forminput");
		
		$media_duration=array("name"=>"media_duration","id"=>"media_duration","class"=>"forminput","style"=>"width:240px;");
		
		$media_file=array("name"=>"media_file","id"=>"media_file","class"=>"forminput required");
		
		$media_ad_url=array("name"=>"media_ad_url","id"=>"media_ad_url","class"=>"required url forminput");
		
		$add_submit=array("name"=>"ad_media_submit","id"=>"ad_media_submit","class"=>"formbutton","value"=>"Add","style"=>"float:left");
		
		$cancel_submit=array("name"=>"cancel_button","id"=>"cancel_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left", 'content' => 'Cancel');
		
		echo form_open('',$addmedia_form);
		
		if(isset($media_ads))
		{
			$addmedia_name["value"]=$media_ads[0]->media_name;
			
			$description["value"]=$media_ads[0]->description;
			
			$media_ad_url["value"]=$media_ads[0]->media_ad_url;
			
			$media_duration["value"]=$media_ads[0]->media_duration;
			
			$add_submit["value"]="Update";
			
			echo form_hidden("edit_id",$media_ads[0]->id);
			
			echo form_hidden("edit_file_name",$media_ads[0]->media_file);
			
			$ext=pathinfo($media_ads[0]->media_file, PATHINFO_EXTENSION);
			
			$file_view='';
			
			if($ext=="flv")
			{
				$file_view='<div id="mediaplayer">JW Player goes here</div><script type="text/javascript">
						jwplayer("mediaplayer").setup({
						flashplayer: "'.base_url().'uploads/player/player.swf",
						file: "'.base_url().'uploads/ads/'.$media_ads[0]->media_file.'",
						height:250,
						width:350
					});
					</script>';
			}
			elseif($ext=="swf")
				$file_view='<embed width="350px" height="250px" name="plugin" src="'.base_url().'uploads/ads/'.$media_ads[0]->media_file.'" type="application/x-shockwave-flash"></embed>';
			else
				$file_view='<img src="'.base_url().'uploads/ads/'.$media_ads[0]->media_file.'" style="width:350px;height:250px;" />';
			
		}
		?>
		<?php
		if(isset($file_view))
			echo '<div>'.$file_view.'</div><br>';
			
        echo '<div><h4>'.form_label("Name","text_ad_label",array("class"=>"tTip","title"=>"Name of the media")).'</h4><br>'.form_input($addmedia_name).'</div><br>';
		
		echo '<div><h4>'.form_label("Description","description_label",array("class"=>"tTip","title"=>"Description for media")).'</h4><br>'.form_input($description).'</div><br>';
		
		echo '<div><h4>'.form_label("Url","url_label",array("class"=>"tTip","title"=>"Link of the ad(what page or site to linked)")).'</h4><br>'.form_input($media_ad_url).'</div><br>';
		
		echo '<div><h4>'.form_label("Duration","Duration_label",array("class"=>"tTip","title"=>"Length of the media file")).'</h4><br>'.form_input($media_duration).'&nbsp;(Seconds)</div><br>';
		
		echo '<div><h4>'.form_label("File","file_label",array("class"=>"tTip","title"=>"File for media Ad")).'</h4><br>'.form_upload($media_file).'<br>(*.jpg, *.swf, *.flv)</div><br>';
		
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