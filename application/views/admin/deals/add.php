<?php 
	$this->load->view("admin/header");	
?>

<script type="text/javascript">
$(document).ready(function(){
	$("#add_deal_form").validate({errorElement:"div"});
	show_tabs('<?php echo $open_tab?>');
	$(".<?php echo $open_tab?> .boxtitle").removeClass("closed");
	<?php
	if(isset($cancel_url))
		echo '$("#cancel_button").click(function(){ document.location="'.$cancel_url.'"});';
	?>
})
$(function(){
	/*$("#deal_voucher_end_date_img").click(function(){
	
		$("#deal_voucher_end_date").datetimepicker();	
	})*/
	$('.tTip').tipsy({gravity: 'w',html: true})
	$("#deal_voucher_start_date").datetimepicker(
		{
			showOn: "button",
			buttonImage:'<?php echo base_url().'css/img/calendar.gif'?>',
			showOn: 'both',
			minDate: new Date()
		}
	);
	
	$("#deal_start_date").datetimepicker({showOn: "button",buttonImage:'<?php echo base_url().'css/img/calendar.gif'?>',showOn: 'both',minDate: new Date()});
	
	$("#deal_end_date").datetimepicker({showOn: "button",buttonImage:'<?php echo base_url().'css/img/calendar.gif'?>',showOn: 'both',minDate: new Date()});
	
	$("#deal_voucher_end_date").datetimepicker({showOn: "button",buttonImage:'<?php echo base_url().'css/img/calendar.gif'?>',showOn: 'both',minDate: new Date()});
})
/*$(function() {
	//$('.tTip').tipsy({gravity: $.fn.tips		y.autoNS,html: true})
	$('.tTip').tipsy({gravity: 'w',html: true})
});*/
$(function(){
	// Slider
	var slider_val=50;
	
	var deal_min_count=0;
	
	var deal_max_count=999;
	
	
	<?php
		if(isset($edit_detail) && count($edit_detail)!=0)
        {
			echo 'slider_val='.$edit_detail[0]->deal_merchant_percent.';';
			
			echo 'deal_min_count='.$edit_detail[0]->deal_min_count.';';
			
			echo 'deal_max_count='.$edit_detail[0]->deal_max_count.';';
			
			echo '$("#deal_merchant_percent").val(\''.$edit_detail[0]->deal_merchant_percent.'\');
			
			$("#deal_groupon_percent").val(\''.$edit_detail[0]->deal_groupon_percent.'\');';
			
			echo '$("#percentage_value").html("Merchant percentage "+'.$edit_detail[0]->deal_merchant_percent.'+"%");'."\n";
			
			echo '$("#groupon_value").html("Site percentage "+'.$edit_detail[0]->deal_groupon_percent.'+"%");'."\n";
			
			echo '$("#deal_min_val").html("Min "+'.$edit_detail[0]->deal_min_count.');'."\n";
			
			echo '$("#deal_max_val").html("Max "+'.$edit_detail[0]->deal_max_count.');'."\n";
			
			echo '$("#deal_min_count").val(\''.$edit_detail[0]->deal_min_count.'\');
			
			$("#deal_max_count").val(\''.$edit_detail[0]->deal_max_count.'\');';
		}
		if($this->input->post("add_deal_submit_button"))
		{
			extract($this->input->post());
			
			echo 'slider_val='.$deal_merchant_percent.';';
			
			echo 'deal_min_count='.$deal_min_count.';';
			
			echo 'deal_max_count='.$deal_max_count.';';
			
			echo '$("#deal_merchant_percent").val(\''.$deal_merchant_percent.'\');
			
			$("#deal_groupon_percent").val(\''.$deal_groupon_percent.'\');';
			
			echo '$("#percentage_value").html("Merchant percentage "+'.$deal_merchant_percent.'+"%");'."\n";
			
			echo '$("#groupon_value").html("Site percentage "+'.$deal_groupon_percent.'+"%");'."\n";
			
			echo '$("#deal_min_val").html("Min "+'.$deal_min_count.');'."\n";
			
			echo '$("#deal_max_val").html("Max "+'.$deal_max_count.');'."\n";
			
			echo '$("#deal_min_count").val(\''.$deal_min_count.'\');
			
			$("#deal_max_count").val(\''.$deal_max_count.'\');';
		}
	 ?>
	$('#percentage_slider').slider({
		orientation: "vertical",
		range: "min",
		min: 0,
		max: 100,
		value: slider_val,
		slide: function( event, ui ) {
			var groupon_per=50;
			$("#deal_merchant_percent").val(''+ui.value);
			$("#percentage_value").html("Merchant percentage "+ui.value+"%");
			groupon_per=100-ui.value;
			$("#groupon_value").html("Site percentage "+groupon_per+"%");
			$("#deal_groupon_percent").val(''+groupon_per);
			//alert(ui.values[ 0 ] + "% - " + ui.values[ 1 ])
		}
	});
	
	$('#purchase_slider').slider({
		range: true,
		min: 0,
		max: 999, 
		values: [deal_min_count, deal_max_count],
		slide: function( event, ui ) {
			$("#deal_min_count").val(ui.values[ 0 ]);
			$("#deal_max_count").val(ui.values[ 1 ]);
			$("#deal_min_val").html("Min "+ ui.values[ 0 ]);
			$("#deal_max_val").html("Max "+ ui.values[ 1 ])
			//$("#time_slider_value").html(ui.values[ 0 ] + " days - "+ ui.values[ 1 ]+" days");
			//alert(ui.values[ 0 ] + "% - " + ui.values[ 1 ])
		}
	});
	

});
</script>
<?php /*?><script type="text/javascript" src="<?php echo base_url() ?>js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		editor_deselector : "mceNoEditor"

	});
</script>
<?php */?>
<script type="text/javascript" src="<?php echo base_url() ?>js/fck_editor/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	CKEDITOR.replace('deal_description');
	CKEDITOR.replace('deals_fine_prints');
	CKEDITOR.replace('deals_highlights');
})
</script>
<style type="text/css">
#deal_voucher_start_date,#deal_start_date,#deal_end_date,#deal_voucher_end_date
{
	width:270px;
}
.select_box
{
	width:315px;
}
.forminput
{
	width:300px;
}
.rich_text_area
{
	margin-left:10px;
}
.rich_text_area textarea
{
	width:96%;
	height:150px;
}
#add_deal_form h1
{
	margin:10px 0px;
	font-size:20px;
	color:#2E55AA;
	background:#AFCFFF;
	padding:7px;
	font-size:12px;
}
.ui-datepicker-trigger
{
	width:27px;
	height:20px;
	background:none;
	border:0px;
	vertical-align:middle;
	margin-bottom:5px;
}
#deal_min_val
{
	float:left;
	font-weight:bold;
}
#deal_max_val
{
	float:right;
	font-weight:bold;
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
				
				$deal_title=array("name"=>"deal_title","id"=>"deal_title","class"=>"required forminput");
				
				$deal_face_value=array("name"=>"deal_face_value","id"=>"deal_face_value","class"=>"forminput");
				
				$deal_price=array("name"=>"deal_price","id"=>"deal_price","class"=>"required forminput");
				
				$deal_merchant_percent=array("name"=>"deal_merchant_percent","id"=>"deal_merchant_percent","class"=>"forminput");
				
				$deal_groupon_percent=array("name"=>"deal_groupon_percent","id"=>"deal_groupon_percent","class"=>"forminput");
				
				$deal_start_date=array("name"=>"deal_start_date","id"=>"deal_start_date","class"=>"forminput required");
			
				$deal_end_date=array("name"=>"deal_end_date","id"=>"deal_end_date","class"=>"forminput required");
				
				$deal_voucher_start_date=array("name"=>"deal_voucher_start_date","id"=>"deal_voucher_start_date","class"=>"forminput required");
			
				$deal_voucher_end_date=array("name"=>"deal_voucher_end_date","id"=>"deal_voucher_end_date","class"=>"forminput required");
				
				$deal_min_count=array("name"=>"deal_min_count","id"=>"deal_min_count","class"=>"forminput");
				
				$deal_max_count=array("name"=>"deal_max_count","id"=>"deal_max_count","class"=>"forminput");
				
				$deal_max_purchase_limit=array("name"=>"deal_max_purchase_limit","id"=>"deal_max_purchase_limit","class"=>"forminput required");
				
				$deal_max_gift_limit=array("name"=>"deal_max_gift_limit","id"=>"deal_max_gift_limit","class"=>"forminput required");
				
				$deal_image=array("name"=>"deal_image","id"=>"deal_image","class"=>"forminput required");
				
				$deal_description=array("name"=>"deal_description","id"=>"deal_description","class"=>"forminput");
				
				$deal_fine_prints=array("name"=>"deals_fine_prints","id"=>"deals_fine_prints","class"=>"forminput");
				
				$deal_highlight=array("name"=>"deals_highlights","id"=>"deals_highlights","class"=>"forminput");
				
				$seo_keyword=array("name"=>"seo_keyword","id"=>"seo_keyword","class"=>"forminput mceNoEditor");
				
				$seo_description=array("name"=>"seo_description","id"=>"seo_description","class"=>"forminput mceNoEditor");
				
				$seo_keyword=array("name"=>"seo_keyword","id"=>"seo_keyword","class"=>"forminput mceNoEditor");
				
				$seo_description=array("name"=>"seo_description","id"=>"seo_description","class"=>"forminput mceNoEditor");
				
				$user_submit_button=array("name"=>"add_deal_submit_button","id"=>"add_deal_submit_button","class"=>"formbutton","value"=>"Add","style"=>"float:left");
        
	        	$user_cancel_button=array("name"=>"cancel_button","id"=>"cancel_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left",'content' => 'Cancel');
				
				$add_deal_form=array("name"=>"add_deal_form","id"=>"add_deal_form","method"=>"post","enctype"=>"multipart/form-data");
				
				echo validation_errors('<div class="error">', '</div>');
				
				echo form_open('',$add_deal_form);
			?>	
            <?php
				$text_area_value=array();
				$image_name='';
				
				$time_zone=$this->config->item("site_time_zone");
				
				if(isset($edit_detail) && count($edit_detail)!=0)
                {
					$select_box_arr=array("deal_city","deal_category","merchent");
					
					$text_areas=array("deal_description","deals_highlights","deals_fine_prints");
					
					$date_text=array("deal_voucher_start_date","deal_voucher_end_date","deal_start_date","deal_end_date");
					
				
					$user_submit_button["value"]="Edit";
					
					
					if(isset($edit_detail[0]->editable))
					{
						echo form_hidden("editable",$edit_detail[0]->editable);
					}
                	echo form_hidden("mode","edit");
				
					$add_submit["value"]="Edit";
					
					$deal_image=array("deal_image_url");
					
					foreach($edit_detail[0] as $key=>$edit_detail)
					{
						if($key!="id")
						{
							if(in_array($key,$select_box_arr))
							{
								echo '<script type="text/javascript">
										$(document).ready(function(){
											$("#'.$key.'").val(\''.$edit_detail.'\');
										})
								</script>';		
							}
							elseif(in_array($key,$text_areas))
							{
								$text_area_value[$key]=$edit_detail;
							}
							elseif(in_array($key,$deal_image))
							{
								$image_name=$edit_detail;
							}
							elseif(in_array($key,$date_text))
							{
								$edit_detail=date("m/d/Y H:i",strtotime($edit_detail));
								
								$arr="['value'] ="."\"".$edit_detail."\"";
								eval("$".$key.$arr.";");
							}
							else
							{
								$arr="['value'] ="."\"".$edit_detail."\"";
								eval("$".$key.$arr.";");	
							}
						}
						
						
						//var_dump($key,$edit_detail);
					}
                }
				if($this->input->post("add_deal_submit_button"))
				{
					//var_dump($this->input->post());<br />
					
					$select_box_arr=array("deals_city","deals_category","merchants");
					
					$text_areas=array("deal_description","deals_fine_prints","deals_highlights");
					
					$date_text=array("deal_voucher_start_date","deal_voucher_end_date","deal_start_date","deal_end_date");
					
					foreach($this->input->post() as $key=>$post_data)
					{
						//echo $key." ";
						
						//var_dump(in_array($key,$select_box_arr));
						
						if(in_array($key,$select_box_arr))
						{
							echo '<script type="text/javascript">
										$(document).ready(function(){
											$("select[name='.$key.']").val(\''.$post_data.'\');
										})
								</script>';
						}
						elseif(in_array($key,$text_areas))
						{
								$text_area_value[$key]=$post_data;
						}
						else
						{
							$arr="['value'] ="."\"".$post_data."\"";
						
							eval("$".$key.$arr.";");
						}
					}
					$deal_max_purchase_limit["value"]=set_value("deal_max_purchase_limit");
				}
			?>
            	<h1>Basic</h1>
            	<div style="float:left;margin-left:10px">
					<?php
                        echo '<div><h4>'.form_label(ucwords("deals Title"),"deal_face_value_label",array("class"=>"tTip","title"=>ucfirst("Enter Title of Deals"))).'&nbsp;<span class="require_field">*</span></h4><br>'.form_input($deal_title).'</div><br>';
						
						echo '<div><h4>'.form_label(ucwords("deal face value"),"deal_face_value",array("class"=>"tTip","title"=>ucfirst("Enter Original price of the Deals"))).'&nbsp;<span class="require_field">*</span></h4><br>'.form_input($deal_face_value).'</div><br>';
						
						echo '<div><h4>'.form_label(ucwords("deal price"),"deal_price_label",array("class"=>"tTip","title"=>ucfirst("Enter Deals Discount price"))).'&nbsp;<span class="require_field">*</span></h4><br>'.form_input($deal_price).'</div><br>';
					?>
                    </div>
                    <div  style="float:left; width:300px;">
                    <?php
						
						echo '<input type="hidden" name="deal_merchant_percent" id="deal_merchant_percent" value="50">
	   						  <input type="hidden" name="deal_groupon_percent" id="deal_groupon_percent" value="50">';
						/*echo '<div><h4>'.form_label(ucwords("Merchant percentage"),"deal_merchant_percent",array("class"=>"tTip","title"=>ucfirst("Enter Merchant percentage"))).'</h4><br>'.form_input($deal_merchant_percent).'</div><br>';
						
						echo '<div><h4>'.form_label(ucwords("Site Percentage"),"deal_title_label",array("class"=>"tTip","title"=>ucfirst("Enter Site Percentage"))).'</h4><br>'.form_input($deal_groupon_percent).'</div><br>';*/
					?>
                    <div id="percentage_value" style="text-align:center;font-weight:bold">Merchant percentage 50 %</div>
                    <br />
                    <div style="margin-left:150px;">
	               	 	<div id="percentage_slider" style="height:200px;"></div>
             		</div>
                    <br />
                    <div id="groupon_value" style="text-align:center;font-weight:bold">Site percentage 50 %</div>
                    
                    </div>
                    
                    <div class="clear"></div>
                    
                    <h1>Deals Start date &amp; Out date</h1>
                    
                    <div style="float:left;margin-left:10px">
                    <?php
						echo '<div><h4>'.form_label(ucwords("deals start date"),"deal_start_date_label",array("class"=>"tTip","title"=>ucfirst("Enter Deals Start Date"))).'&nbsp;<span class="require_field">*</span></h4><br>'.form_input($deal_start_date).'&nbsp;<!--<img src="'.base_url().'css/img/calendar.gif" id="deal_start_date_img">--></div><br>';
						 
						echo '<div><h4>'.form_label(ucwords("Voucher valid start date"),"deal_title_label",array("class"=>"tTip","title"=>ucfirst("Enter Voucher valid Start Date"))).'&nbsp;<span class="require_field">*</span></h4><br>'.form_input($deal_voucher_start_date).'&nbsp;<!--<img src="'.base_url().'css/img/calendar.gif" id="deal_voucher_start_date_img">--></div><br>';
						
						/*echo '<div><h4>'.form_label(ucwords("Min Sold for deal"),"deal_title_label",array("class"=>"tTip","title"=>ucfirst("Enter Minimum sold for deals"))).'</h4><br>'.form_input($deal_min_count).'</div><br>';*/
					?>
                    </div>
                    
                    <div style="float:left;margin-left:15px">
                    <?php
						echo '<div><h4>'.form_label(ucwords("deals end date"),"deal_end_date_label",array("class"=>"tTip","title"=>ucfirst("Enter Deals End Date"))).'&nbsp;<span class="require_field">*</span></h4><br>'.form_input($deal_end_date).'&nbsp;<!--<img src="'.base_url().'css/img/calendar.gif" id="deal_end_date_img">--></div><br>';
						
					    echo '<div><h4>'.form_label(ucwords("Voucher valid end date"),"deal_title_label",array("class"=>"tTip","title"=>ucfirst("Enter Voucher valid End Date"))).'&nbsp;<span class="require_field">*</span></h4><br>'.form_input($deal_voucher_end_date).'&nbsp;<!--<img src="'.base_url().'css/img/calendar.gif" id="deal_voucher_end_date_img">--></div><br>';
						
						/*echo '<div><h4>'.form_label(ucwords("max Sold for deal"),"deal_title_label",array("class"=>"tTip","title"=>ucfirst("Enter Maximum sold for deals"))).'</h4><br>'.form_input($deal_max_count).'</div><br>';*/
						
                    ?>
               		</div>
                    <div class="clear"></div>
                    
                    <h1>Min & Max Sold deal</h1>
                    <div>
                    	<?php
							echo '<input type="hidden" name="deal_min_count" id="deal_min_count" value="0">
		   						  <input type="hidden" name="deal_max_count" id="deal_max_count" value="999">';
						?>
                    	<div id="deal_min_val">Min 0</div><div id="deal_max_val">Max 9999</div>
                        <div class="clear"></div>
                    	<div id="purchase_slider" style="margin:10px;"></div>
                    </div>
                    <h1>Purchase Limitation</h1>
                    
                    <div style="float:left;margin-left:10px">
                    <?php
						echo '<div><h4>'.form_label(ucwords("customer min purchase limit"),"deal_title_label",array("class"=>"tTip","title"=>ucfirst("Enter Customber min purchase limit"))).'</h4><br>'.form_input($deal_max_purchase_limit).'</div><br>';
					?>
                    </div>
                    
                    <div style="float:left;margin-left:10px">
                    <?php
						echo '<div><h4>'.form_label(ucwords("customer min gift limit"),"deal_title_label",array("class"=>"tTip","title"=>ucfirst("Enter Customber Min gift to a friend limit"))).'</h4><br>'.form_input($deal_max_gift_limit).'</div><br>';
					?>
                    </div>
                    
                    <div class="clear"></div>
                    
                    <h1>City,category &amp; Merchants Detail</h1>
                    
                    <div style="float:left;margin-left:10px">
                    <?php
						echo '<div><h4>'.form_label(ucwords("City"),"deal_title_label",array("class"=>"tTip","title"=>ucfirst("Enter Deals city"))).'</h4><br><select name="deals_city" id="deal_city" class="select_box required"><option value="">Select</option>'.$city_drop_down.'</select></div><br>';
						
						echo '<div><h4>'.form_label(ucwords("merchants"),"deal_title_label",array("class"=>"tTip","title"=>ucfirst("Enter merchant name"))).'</h4><br><select name="merchants" id="merchent" class="select_box required"><option value="">Select</option>'.dropdown_box("merchants","id","company_name",array("status"=>1),array('company_name',"ASC")).'</select></div><br>';
					?>
                    </div>
                    
                    <div style="float:left;margin-left:10px">
                    <?php
						echo '<div><h4>'.form_label(ucwords("category"),"deal_title_label",array("class"=>"tTip","title"=>ucfirst("Enter Customber Min gift to a friend limit"))).'</h4><br><select name="deals_category" id="deal_category" class="select_box required">'.$category_options.'</select></div><br>';
					?>
                    </div>
                    
                    <div class="clear"></div>
                    
                    <div style="float:left; width:320px;margin-left:10px">
						<?php
                            echo '<div><h4>'.form_label(ucwords("Image"),"deal_title_label",array("class"=>"tTip","title"=>ucfirst("Enter Image"))).'</h4><br><input type="file" name="deal_image" id="deal_image"></div><br>';
                        ?>
                    </div>
                    
                    <div style="float:left;margin-left:10px">
                    	<?php
                        	if(isset($image_name) && $image_name!="")
							{
								echo form_hidden("old_image",$image_name);
								
								echo '<div><h4>'.form_label(ucwords("Exsisting Image"),"deal_title_label",array("class"=>"tTip","title"=>ucfirst("Exsisting Image"))).'</h4><br>
									  <img src="'.base_url().'uploads/deals/'.$image_name.'" style="width:300px;"/></div>';
							}
						?>
                    </div>
                    <div class="clear"></div>
                    
                     <h1>Deals SEO Details</h1>
                    
                    <div style="float:left;margin-left:10px">
                    <?php
						echo '<div><h4>'.form_label(ucwords("SEO Keyword"),"seo_keyword_label",array("class"=>"tTip","title"=>ucfirst("Enter SEO Keyword"))).'</h4><br>'.form_textarea($seo_keyword).'</div><br>';
					?>
                    </div>
                    
                    <div style="float:left;margin-left:10px">
                    <?php
						echo '<div><h4>'.form_label(ucwords("SEO Description"),"seo_description_label",array("class"=>"tTip","title"=>ucfirst("Enter SEO Description"))).'</h4><br>'.form_textarea($seo_description).'</div><br>';
					?>
                    </div>
                    
                    <div class="clear"></div>
                    
                    <h1>Deals Description &amp; highlights</h1>
                    
                    <div style="" class="rich_text_area">
                     <?php
						echo '<div><h4>'.form_label(ucwords("deals description"),"deal_deal_description",array("class"=>"tTip","title"=>ucfirst("Enter discription about the deal"))).'</h4><br><textarea id="deal_description" name="deal_description">';
						
						if(isset($text_area_value["deal_description"]))
							echo $text_area_value["deal_description"];
						echo '</textarea></div><br>';
						
						
					?>
                     <?php
						echo '<div><h4>'.form_label(ucwords("deals fine prints"),"deal_deal_description",array("class"=>"tTip","title"=>ucfirst("Enter fine prints about the deal"))).'</h4><br><textarea id="deals_fine_prints" name="deals_fine_prints">';
						
						if(isset($text_area_value["deals_fine_prints"]))
							echo $text_area_value["deals_fine_prints"];
						echo '</textarea></div><br>';
					?>
                     <?php
						echo '<div><h4>'.form_label(ucwords("deals highlights"),"deal_deal_highlight",array("class"=>"tTip","title"=>ucfirst("Enter highlights of the deal"))).'</h4><br><textarea id="deals_highlights" name="deals_highlights">';
						
						if(isset($text_area_value["deals_highlights"]))
							echo $text_area_value["deals_highlights"];
						echo '</textarea></div><br>';
					?>
                    </div>
			<?php
				echo '<div><br>'.form_submit($user_submit_button).'<div style="width:10px;float:left">&nbsp;</div>'.form_button($user_cancel_button).'</div><div class="clear"></div>';
            	echo form_close();
            ?>
        </div>
	</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>