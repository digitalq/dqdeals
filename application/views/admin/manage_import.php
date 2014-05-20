<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	show_tabs('<?php echo $open_tab?>');
	})
$(function() {
	//$('.tTip').tipsy({gravity: $.fn.tipsy.autoNS,html: true})
	$('.tTip').tipsy({gravity: 'w',html: true})
});
</script>
<?php $this->load->view("admin/thesidebar");?>
<div id="dashboardwrap">
  <div id="dashboard" class="box new">
	<div id="dashboard-top">
      <h2><?php if(isset($title)) echo ucfirst($title)?></h2><br />
    </div>
    <div id="dashboard-body">
    	<?php
			$add_city_form=array("name"=>"manage_import","id"=>"manage_import");
			
			$deal_tag=array("name"=>"deal_tag","id"=>"deal_tag","class"=>"required forminput");
			
			$deal_title=array("name"=>"deal_title","id"=>"deal_title","class"=>"required forminput");
			
			$deal_id=array("name"=>"deal_id","id"=>"deal_id","class"=>"required forminput");
			
			$deal_city=array("name"=>"deal_city","id"=>"deal_city","class"=>"forminput");
			
			$deal_description=array("name"=>"deal_description","id"=>"deal_description","class"=>"forminput");
			
			$deal_link=array("name"=>"deal_link","id"=>"deal_link","class"=>"forminput required");
			
			$deal_price=array("name"=>"deal_price","id"=>"deal_price","class"=>"forminput required");
			
			$deal_face_value=array("name"=>"deal_face_value","id"=>"deal_face_value","class"=>"forminput required");
			
			$deal_save_value=array("name"=>"deal_save_value","id"=>"deal_save_value","class"=>"forminput");
			
			$deal_save_percent=array("name"=>"deal_save_percent","id"=>"deal_save_percent","class"=>"forminput");
			
			$deal_sold_out=array("name"=>"deal_sold_out","id"=>"deal_sold_out","class"=>"forminput");
			
			$deal_time_zone=array("name"=>"deal_time_zone","id"=>"deal_time_zone","class"=>"forminput");
			
			$deal_start_date=array("name"=>"deal_start_date","id"=>"deal_start_date","class"=>"forminput");
			
			$deal_end_date=array("name"=>"deal_end_date","id"=>"deal_end_date","class"=>"forminput");
			
			$division_lat=array("name"=>"division_lat","id"=>"division_lat","class"=>"forminput");
			
			$division_lng=array("name"=>"division_lng","id"=>"division_lng","class"=>"forminput");
			
			$deal_image_url=array("name"=>"deal_image_url","id"=>"deal_image_url","class"=>"forminput");
			
			
			$deal_zip_code=array("name"=>"deal_zip_code","id"=>"deal_zip_code","class"=>"forminput");
			
			$deal_phone=array("name"=>"deal_phone","id"=>"deal_phone","class"=>"forminput");
			
			$deal_category=array("name"=>"deal_category","id"=>"deal_category","class"=>"forminput");
			
			$deal_merchent_url=array("name"=>"deal_merchent_url","id"=>"deal_merchent_url","class"=>"forminput");
			
			$deal_conditions=array("name"=>"deal_conditions","id"=>"deal_conditions","class"=>"forminput");
			
			$division_id=array("name"=>"division_name","id"=>"division_name","class"=>"forminput");
			
			$add_submit=array("name"=>"manage_import_submit","id"=>"manage_import_submit","class"=>"formbutton","value"=>"Save","style"=>"float:left");
        
        	$cancel_submit=array("name"=>"manage_import_button","id"=>"manage_import_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left","onclick"=>"goto_view_page()", 'content' => 'Cancel');
		
        	echo form_open("",$add_city_form);
			
			if($mode="edit")
			{
				if(isset($edit_data))
				{
					foreach($edit_data[0] as $key=>$edit_detail)
					{
						if($key!="id")
						{
							$arr="['value'] ="."'".$edit_detail."'";
							eval("$".$key.$arr.";");
						}
						//var_dump($key,$edit_detail);
					}
					
				}
				
			}	
			?>
				<div style="float:left; width:300px;">
                <?php
					
					echo '<div><h4>'.form_label(ucwords("deals tag"),"deal_tag_label",array("class"=>"tTip","title"=>"Enter Deals Tag, Which is hold deals Ex:Deals, Deal, item")).'</h4><br>'.form_input($deal_tag).'</div><br>';
					echo '<div><h4>'.form_label(ucwords("deals title tag"),"deal_title_label",array("class"=>"tTip","title"=>"Enter Deals Title Tag")).'</h4><br>'.form_input($deal_title).'</div><br>';
					echo '<div><h4>'.form_label(ucwords("deals id tag"),"deal_id_label",array("class"=>"tTip","title"=>"Enter Deals ID Tag")).'</h4><br>'.form_input($deal_id).'</div><br>';
					echo '<div><h4>'.form_label(ucwords("deals city tag"),"deal_city_label",array("class"=>"tTip","title"=>"Enter Deals city Tag")).'</h4><br>'.form_input($deal_city).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals description tag"),"deal_description_label",array("class"=>"tTip","title"=>"Enter Deals description Tag, Which is hold description of the deals")).'</h4><br>'.form_input($deal_description).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals category name tag"),"deal_category_name_label",array("class"=>"tTip","title"=>"Enter Deals category Tag, Which is hold Tags of the deals")).'</h4><br>'.form_input($deal_category).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals link tag"),"deal_link_label",array("class"=>"tTip","title"=>"Enter Deals Link Tag, Which is hold Link of the deals")).'</h4><br>'.form_input($deal_link).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals price tag"),"deal_price_label",array("class"=>"tTip","title"=>"Enter Deals Price Tag, Which is hold price of the deals")).'</h4><br>'.form_input($deal_price).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals face tag"),"deal_face_value_label",array("class"=>"tTip","title"=>"Enter Deals Face Tag, Which is hold Face value of the deals")).'</h4><br>'.form_input($deal_face_value).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals percendage of saving tag"),"deal_save_percent_label",array("class"=>"tTip","title"=>ucwords("Enter percendage of saving Tag, Which is hold percendage of saving of the deals "))).'</h4><br>'.form_input($deal_save_percent).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals deal save value"),"deal_save_percent_label",array("class"=>"tTip","title"=>ucwords("Enter save value Tag, Which is hold Deals saving value"))).'</h4><br>'.form_input($deal_save_value).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals time zone tag"),"deal_time_zone_label",array("class"=>"tTip","title"=>ucwords("Enter time zone Tag, Which is hold deals time zone"))).'</h4><br>'.form_input($deal_time_zone).'</div><br>';
					
					
				?>
                </div>
                <div style="float:left">
                <?php
					echo '<div><h4>'.form_label(ucwords("deals start date tag"),"deal_start_date_label",array("class"=>"tTip","title"=>ucwords("Enter start date Tag, Which is hold deals start date"))).'</h4><br>'.form_input($deal_start_date).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals end tag"),"deal_end_date_label",array("class"=>"tTip","title"=>ucwords("Enter end date Tag, Which is hold deals end date"))).'</h4><br>'.form_input($deal_end_date).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals latitude tag"),"deal_exp_date_label",array("class"=>"tTip","title"=>ucwords("Enter latitude Tag, Which is hold  deals latitude"))).'</h4><br>'.form_input($division_lat).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals longitude tag"),"deal_address_label",array("class"=>"tTip","title"=>ucwords("Enter longitude Tag, Which is hold  deals longitude"))).'</h4><br>'.form_input($division_lng).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals sold out tag"),"deal_sold_out_label",array("class"=>"tTip","title"=>ucwords("Enter longitude Tag, Which is hold  deals longitude"))).'</h4><br>'.form_input($deal_sold_out).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals image url"),"deal_image_label",array("class"=>"tTip","title"=>ucwords("Enter sold out Tag, Which is hold deals sold out"))).'</h4><br>'.form_input($deal_image_url).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals zip code"),"deal_zip_code_name_label",array("class"=>"tTip","title"=>ucwords("Enter zipcode Tag, Which is hold deals zip code"))).'</h4><br>'.form_input($deal_zip_code).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals phone tag"),"deal_phone_label",array("class"=>"tTip","title"=>ucwords("Enter phone Tag, Which is hold deals phone no"))).'</h4><br>'.form_input($deal_phone).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals merchant url tag"),"deal_merchent_url_label",array("class"=>"tTip","title"=>ucwords("Enter merchant url Tag, Which is hold deals merchant url"))).'</h4><br>'.form_input($deal_merchent_url).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals conditions tag"),"deal_conditions_label",array("class"=>"tTip","title"=>ucwords("Enter conditions Tag, Which is hold deals conditions details"))).'</h4><br>'.form_input($deal_conditions).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals division id tag"),"division_id_label",array("class"=>"tTip","title"=>ucwords("Enter Division id Tag, Which is hold deals Division id"))).'</h4><br>'.form_input($division_id).'</div><br>';
				?>
				</div>
                <div class="clear"></div>
                <?php
					
					echo '<div><br>'.form_submit($add_submit).'<div style="width:10px;float:left">&nbsp;</div>'.form_button($cancel_submit).'</div><div class="clear"></div>';
				?>
            <?php
				echo form_close();
			?>
    </div>
  </div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>