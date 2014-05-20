<?php 
$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#manage_social_form").validate({errorElement:"div"});
	show_tabs('<?php echo $open_tab?>');
	$(".<?php echo $open_tab?> .boxtitle").removeClass("closed");
	<?php
	if(isset($cancel_url))
		echo '$("#add_social_button").click(function(){ document.location="'.$cancel_url.'"})';
	?>
})
</script>
<style type="text/css">
.forminput {
 width: 295px;
}
#fanbox_width,#fanbox_height
{
	width: 250px;
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
		$fanbox_href=array("name"=>"fanbox_href","id"=>"fanbox_href","class"=>"url forminput");
		
		$fanbox_height=array("name"=>"fanbox_height","id"=>"fanbox_height","class"=>"forminput");
		
		$fanbox_width=array("name"=>"fanbox_width","id"=>"fanbox_width","class"=>"forminput");
		
		$fanbox_show_faces_1=array("name"=>"fanbox_show_faces","value"=>'true','checked'=> TRUE);
		
		$fanbox_show_faces_0=array("name"=>"fanbox_show_faces","value"=>'false');
		
		$fanbox_stream_1=array("name"=>"fanbox_stream","value"=>"true",'checked'=> TRUE);
		
		$fanbox_stream_0=array("name"=>"fanbox_stream","value"=>"false");
		
		$manage_social_form=array("name"=>"manage_social_form","id"=>"manage_social_form","enctype"=>"multipart/form-data");
		
		$facebook_url=array("name"=>"facebook_url","id"=>"facebook_url","class"=>"url forminput");
		
		$you_tube_url=array("name"=>"you_tube_url","id"=>"you_tube_url","class"=>"url forminput");
		
		$facebook_api_key=array("name"=>"facebook_api_key","id"=>"facebook_api_key","class"=>"forminput");
		
		$facebook_secret_key=array("name"=>"facebook_secret_key","id"=>"facebook_secret_key","class"=>"forminput");
		
		$twiter_page_url=array("name"=>"twiter_page_url","id"=>"twiter_page_url","class"=>"url forminput");
		
		$twitter_consumer_key=array("name"=>"twitter_consumer_key","id"=>"twitter_consumer_key","class"=>"forminput");
		
		$twitter_consumer_secret=array("name"=>"twitter_consumer_secret","id"=>"twitter_consumer_secret","class"=>"forminput");
		
		$google_analytics=array("name"=>"google_analytics","id"=>"google_analytics","class"=>"forminput","style"=>"height:100px;width:97%");
		
		$add_submit=array("name"=>"manage_social_submit","id"=>"manage_social_submit","class"=>"formbutton","value"=>"Update","style"=>"float:left");
		
		$cancel_submit=array("name"=>"manage_social_button","id"=>"manage_social_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left", 'content' => 'Cancel');
		
		echo form_open('',$manage_social_form);
		
		foreach($social_site_settings as $social_site_setting)
		{
			//var_dump($social_site_setting);
			
			if($social_site_setting->name=="fanbox_show_faces")
			{
				echo '<script type="text/javascript">
						$(document).ready(function(){
							$("input[name=\'fanbox_show_faces\']").filter("[value='.$social_site_setting->value.']").attr("checked","checked");
						})
					  </script>';
			}
			elseif($social_site_setting->name=="fanbox_stream")
			{
				echo '<script type="text/javascript">
						$(document).ready(function(){
							$("input[name=\'fanbox_stream\']").filter("[value='.$social_site_setting->value.']").attr("checked","checked");
						})
					  </script>';
			}
			elseif($social_site_setting->name=="google_analytics")
			{
				$arr=$google_analytics['value']=$social_site_setting->value;
			}
			elseif($social_site_setting->name!="google_analytics")
			{
				//$arr="['value'] ="."\"".$social_site_setting."\"";
				
				//echo '"'.$social_site_setting.'"';
				
				$arr="['value'] ="."'".htmlentities($social_site_setting->value)."'";
			
				eval("$".$social_site_setting->name.$arr.";");
				
			}
		}
		
		echo validation_errors('<div class="error">', '</div>');
		
		echo '<h1>Facebook Fanbox Settings</h1><div style="float:left;width:350px;">';
				echo '<div><h4>'.form_label("Fan page Show Stream","facebook_show_stream").'</h4><br>'.form_radio($fanbox_stream_1).'&nbsp;Yes&nbsp;&nbsp;'.form_radio($fanbox_stream_0).'No</div><br>'."\n";
				
				echo '<div><h4>'.form_label("Facebook Fan Page Height","facebook_fan_page_height").'</h4><br>'.form_input($fanbox_height).'&nbsp;px</div><br>'."\n";
		
				echo '<div><h4>'.form_label("Facebook Fan Page URL","facebook_fan_page_url").'</h4><br>'.form_input($fanbox_href).'</div>'."\n";
				
		echo '</div>'."\n";
		echo '<div style="float:left">'."\n";
				echo '<div><h4>'.form_label("Facebook Fan page Show Faces","facebook_fan_page_url").'</h4><br>'.form_radio($fanbox_show_faces_1).'&nbsp;Yes&nbsp;&nbsp;'.form_radio($fanbox_show_faces_0).'No</div><br>'."\n";
				
			    echo '<div><h4>'.form_label("Facebook Fan Page Width","facebook_fan_page_width").'</h4><br>'.form_input($fanbox_width).'&nbsp;px</div>'."\n";
		echo '</div><div class="clear"></div><br>'."\n";
		
		echo '<h1>Facebook Connect Settings</h1><div style="float:left;width:350px;">'."\n";
		
		//echo '<div><h4>'.form_label("Facebook Page URL","facebook_api_url").'</h4><br>'.form_input($facebook_url).'</div><br>'."\n";
		
		echo '<div><h4>'.form_label("Facebook API Key","facebook_api_key").'</h4><br>'.form_input($facebook_api_key).'</div><br>'."\n";
		
		//echo '<div><h4>'.form_label("Facebook secret Key","facebook_api_secret").'</h4><br>'.form_input($facebook_secret_key).'</div><br>'."\n";
		
		//echo '<div><h4>'.form_label(" YouTube Page URL"," YouTube_url").'</h4><br>'.form_input($you_tube_url).'</div><br>'."\n";
		
		echo '</div>'."\n";
		
		echo '<div style="float:left">'."\n";
		
		echo '<div><h4>'.form_label("Facebook secret Key","facebook_api_secret").'</h4><br>'.form_input($facebook_secret_key).'</div><br>'."\n";
		/*echo '<div><h4>'.form_label("Twitter Page URL","twiter_page_url").'</h4><br>'.form_input($twiter_page_url).'</div><br>'."\n";
		
		echo '<div><h4>'.form_label("Twitter Consumer key","twitter_api_key").'</h4><br>'.form_input($twitter_consumer_key).'</div><br>'."\n";
		
		echo '<div><h4>'.form_label("Twitter Consumer secret ","twitter_api_secret").'</h4><br>'.form_input($twitter_consumer_secret).'</div><br>'."\n";
		
		echo '<div><h4>'.form_label("Google Analytics Code","google_analytics").'</h4><br>'.form_textarea($google_analytics).'</div><br>'."\n";*/
		
		echo '</div><div class="clear"></div>'."\n";
		
		echo '<h1>Twitter Settings</h1><div>'."\n";
			echo '<div><h4>'.form_label("Twitter Page URL","twiter_page_url").'</h4><br>'.form_input($twiter_page_url).'</div><br>'."\n";	
		echo '</div>'."\n";
		
		echo '<h1>Google Analytics Settings</h1><div>'."\n";
			echo '<div><h4>'.form_label("Google Analytics Code","google_analytics").'</h4><br>'.form_textarea($google_analytics).'</div><br>'."\n";
		echo '</div>'."\n";
		
		//echo '<div><br>'.form_submit($add_submit).'<div style="width:10px;float:left">&nbsp;</div>'.form_button($cancel_submit).'</div><div class="clear"></div>';
		
		echo '<div><br>'.form_submit($add_submit)."</div>"."\n";
		
		echo form_close();
		
	?>	
	</div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>