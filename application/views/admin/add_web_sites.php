<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	show_tabs('<?php echo $open_tab?>');
	$("#referral_code").hide();
	$("#CJ_aff_option").hide();
	<?php
		if(isset($affliates_option) && $affliates_option!='')
		{
			echo '$("[name=affliates_option]").filter("[value='.$affliates_option.']").attr("checked","checked");';
			
			if($affliates_option=='cj')
			{
				echo '$("#CJ_aff_option").show();
					  $("#CJ_aff_option input").addClass("required");
					  $("#CJ_aff_option input").val(\''.$affliates_value.'\');
					  $("#referral_code").hide();
					  $("#referral_code input").val(\'\');
					  $("#referral_code input").removeClass("required");';
			}
			elseif($affliates_option=="aff_prg")
			{
					echo '$("#referral_code").show();
					$("#referral_code input").addClass("required");
					$("#referral_code input").val(\''.$affliates_value.'\');
					$("#CJ_aff_option").hide();
					$("#CJ_aff_option input").val(\'\');
					$("#CJ_aff_option input").removeClass("required");';
			}
			else
			{
				echo '$("#CJ_aff_option").hide();
					  $("#CJ_aff_option input").val(\'\');
					  $("#CJ_aff_option input").removeClass("required");
  					  $("#referral_code").hide();
					  $("#referral_code input").val(\'\');
					  $("#referral_code input").removeClass("required");';
			}
		}
		else
			echo '$("[name=affliates_option]").filter("[value=none]").attr("checked","checked");';
		
		if(isset($import_option_value))
		{
			echo '$("[name=import_type]").filter("[value='.$import_option_value.']").attr("checked","checked");';
			echo '$("[name=city_type]").filter("[value='.$city_type_value.']").attr("checked","checked");';
			
			if($import_option_value=="api")
				echo '$("#key_info_container").show();$("#key_info_container input").addClass("required");';
			else
				echo '$("#key_info_container").hide();$("#key_info_container input").removeClass("required");';
		}
		else
		{
			echo '$("[name=import_type]").filter("[value=rss]").attr("checked","checked");';
			echo '$("[name=city_type]").filter("[value=yes]").attr("checked","checked");';
			echo '$("#key_info_container").hide();';
		}
		if(isset($cancel_url))
			echo '$("#cancel_button").click(function(){ document.location="'.$cancel_url.'"});';
		
	?>

	$("#add_city").validate({errorElement:"div"});
	
	$("#website_name").alphanumeric({allow:".,-,_, ,&"});
	
	$("#add_web_sites").validate({errorElement:"div"});
	
	$("[name=import_type]").change(function (){
		var import_option=$("#import_type:checked").val();
		if(import_option=="api")
		{
			$("#key_info_container").show();
			$("#key_info_container input").addClass("required");
		}
		else
		{
			$("#key_info_container").hide();
			$("#key_info_container input").val('');
			$("#key_info_container input").removeClass("required");
		}
	});
	
	$("[name=affliates_option]").change(function (){
		var affliates_option=$("#affliates_option:checked").val();
		if(affliates_option=="cj")
		{
			$("#CJ_aff_option").show();
			$("#CJ_aff_option input").addClass("required");
			$("#referral_code").hide();
			$("#referral_code input").val('');
			$("#referral_code input").removeClass("required");
			
		}
		else if(affliates_option=="aff_prg")
		{
			$("#referral_code").show();
			$("#referral_code input").addClass("required");
			$("#CJ_aff_option").hide();
			$("#CJ_aff_option input").val('');
			$("#CJ_aff_option input").removeClass("required");
		}
		else
		{
			$("#CJ_aff_option").hide();
			$("#CJ_aff_option input").val('');
			$("#CJ_aff_option input").removeClass("required");
			$("#referral_code").hide();
			$("#referral_code input").val('');
			$("#referral_code input").removeClass("required");
		}
	});
})
$(function() {
	//$('.tTip').tipsy({gravity: $.fn.tipsy.autoNS,html: true})
	$('.aff_setting .tTip').tipsy({gravity: 's',html: true})
	
	$('.tTip').tipsy({gravity: 'w',html: true})
	
	
});
</script>
<style type="text/css">
.forminput
{
	width:280px;
}
#add_web_sites .left_con
{
	float:left;
	width:335px;
}
#add_web_sites .right_con
{
	float:left;
}
.aff_setting .tTip
{
	background:none !important;
}
.aff_setting label
{
	background:none !important;
	padding:0px !important;
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
			
			$add_web_site_form=array("name"=>"add_web_sites","id"=>"add_web_sites","enctype"=>"multipart/form-data");
			
			$website_name_input=array("name"=>"website_name","id"=>"website_name","class"=>"required forminput");
			
			$website_name_url=array("name"=>"website_url","id"=>"website_url","class"=>"required url forminput");
			
			$key_info=array("name"=>"key_info","id"=>"key_info","class"=>"forminput");
			
			$import_url=array("name"=>"import_url","id"=>"import_url","class"=>"forminput url");
			
			$website_image=array("name"=>"website_image","id"=>"website_image");
			
			$add_submit=array("name"=>"add_web_site_submit","id"=>"add_web_site_submit","class"=>"formbutton","value"=>"Add","style"=>"float:left");
        	
			$rss_option=array("name"=>"import_type","value"=>"rss","id"=>"import_type");
			
			$api_option=array("name"=>"import_type","value"=>"api","id"=>"import_type");
			
			$city_option_yes=array("name"=>"city_type","value"=>"yes","id"=>"city_type");
			
			$affliates_cj_option=array("name"=>"affliates_option","value"=>"cj","id"=>"affliates_option");
			
			$none_option=array("name"=>"affliates_option","value"=>"none","id"=>"affliates_option");
			
			$affliates_ref_option=array("name"=>"affliates_option","value"=>"aff_prg","id"=>"affliates_option");
			
			$city_option_no=array("name"=>"city_type","value"=>"no","id"=>"city_type");
			
			$manual_option=array("name"=>"import_type","value"=>"manual","id"=>"import_type");
			
			$content_option=array("name"=>"import_type","value"=>"content","id"=>"import_type");
			
        	$cancel_submit=array("name"=>"cancel_button","id"=>"cancel_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left", 'content' => 'Cancel');
		
			//set edit values
			if(isset($web_site_name))
				$website_name_input["value"]=$web_site_name;
			if(isset($web_site_url))
				$website_name_url["value"]=$web_site_url;
			
			if(isset($apikey))
				$key_info["value"]=$apikey;
			
			if(isset($import_url_value))
				$import_url["value"]=$import_url_value;
				
			if(isset($edit_id))
			{
				echo form_hidden("edit_id",$edit_id);
				echo form_hidden("mode","edit");
				$add_submit["value"]="Edit";
			}
			echo form_open('',$add_web_site_form);
			
			echo '<div>
						<div class="left_con">
							<div>
								<h4>'.form_label("Website Name","website_name_label",array("class"=>"tTip","title"=>"Name of the Site")).'</h4><br>'.form_input($website_name_input).'
							</div><br>';
			
			echo '<div><h4>'.form_label("Website URL","website_url_label",array("class"=>"tTip","title"=>"Affiliate site url")).'</h4><br>'.form_input($website_name_url).'</div><br>';
			
			echo '<div><h4>'.form_label("Import option","import_option_label",array("class"=>"tTip","title"=>"How to import the data From Affiliate site")).'</h4><br>'.
							 form_radio($rss_option).'Rss&nbsp;&nbsp;'.form_radio($api_option).'API&nbsp;'.
							 form_radio($manual_option).'Manual&nbsp;</div><br>';//.form_radio($content_option).'<strong>Content Reader</strong>&nbsp;</div><br>';
			
			echo '<div id="key_info_container"><h4>'.form_label("API Key","api_key_label",array("class"=>"tTip","title"=>"API key for Affiliate site")).'</h4><br> '.form_input($key_info).'<br><br></div>';
			if(isset($file_name_image) && $file_name_image!="")
				echo '<div><h4>'.form_label("Exsisting Logo","website_url_label").'</h4><br><img src="'.base_url().'uploads/web_site_logo/'.$file_name_image.'" style="width:205;height:30px;"/></div>';
				
			echo '<div><h4>'.form_label("Logo","logo_label",array("class"=>"tTip","title"=>"Logo For Affiliate Site")).'</h4><br>'.form_upload($website_image).'</div><br></div>';
			
			echo '<div><h4>'.form_label("Is this City based","city_option_label",array("class"=>"tTip","title"=>"Import deals from affiliate Sites its depends upon city ?")).'</h4><br>'.form_radio($city_option_yes).'Yes&nbsp;&nbsp;'.form_radio($city_option_no).'No</div><br>';
			
			echo '<div class="right_con"><div><h4>'.form_label("Import URL","import_url_label",array("class"=>"tTip","title"=>"If its City based url like 'http://www.sitename.com/api/v1/(city_name)/deals' otherwise 'http://www.sitename.com/deals/rss'") ).'</h4><br> '.form_input($import_url).'</div><br>';
			
			echo '<div><h4>'.form_label("Affiliate Programs","affiliate_programs_label",array("class"=>"tTip","title"=>"How you earn from this site?")).'</h4>
							<div class="aff_setting"><br>
								<label>'.form_radio($none_option).'None&nbsp;</label><label>'.form_radio($affliates_cj_option).'Refer Url</label>&nbsp;
								<!--<label class="tTip" title="You get some amount for refer to their service.if its Refer Service you should give your referral code ">'.form_radio($affliates_ref_option).'Refer Service</label>--!>
							</div>
				  </div><br>';
			
			$CJ_aff_option_text=array("name"=>"cj_track_url","id"=>"cj_track_url","class"=>"forminput");
			
			echo '<div id="CJ_aff_option"><h4>'.form_label("Tracking Url","CJ_aff_option_label",array("class"=>"tTip","title"=>"Example:http://www.anrdoezrs.net/click-CJPID-cj_pubid?url=(deal_url)or(deal_id)")).'</h4><br>'.form_input($CJ_aff_option_text).'<br><br></div>';
			
			$referral_code=array("name"=>"referral_code","id"=>"referral_code","class"=>"forminput");
			
			echo '<div id="referral_code"><h4>'.form_label("Referral Code","referral_code_label",array("class"=>"tTip","title"=>"")).'</h4><br>'.form_input($referral_code).'<br><br></div>';
			
			echo '</div><div class="clear"></div>';
			
			echo '<div><br>'.form_submit($add_submit).'<div style="width:10px;float:left">&nbsp;</div>'.form_button($cancel_submit).'</div></div><div class="clear"></div></div>';
			
			echo form_close();			
		?>
   </div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>