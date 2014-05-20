<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	show_tabs('<?php echo $open_tab?>');
	<?php
		if(isset($side_id))
			echo '$("#side_id").val('.$side_id.')';
	?>
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
			if($msg = $this->session->flashdata('flash_message'))
            {
            	echo "<div>".$msg."</div>";
            }
			
			$not_text_box_cols=array("id","site_id","deal_id","deal_image_url");
			
			$deal_id="";
			
			$deals_detail_form=array("name"=>"deal_form_manage","id"=>"deal_form_manage","enctype"=>"multipart/form-data");
			
			$deal_title=array("name"=>"deal_title","id"=>"deal_title","class"=>"required forminput");
			
			$deal_city=array("name"=>"deal_city","id"=>"deal_city","class"=>"required forminput");
			
			$deal_description=array("name"=>"deal_description","id"=>"deal_description","class"=>"forminput","style"=>"height:105px");
			
			$deal_price=array("name"=>"deal_price","id"=>"deal_price","class"=>"required forminput");
			
			$deal_face_value=array("name"=>"deal_face_value","id"=>"deal_face_value","class"=>"forminput");
			
			$deal_save_value=array("name"=>"deal_save_value","id"=>"deal_save_value","class"=>"forminput");
			
			$deal_save_percent=array("name"=>"deal_save_percent","id"=>"deal_save_percent","class"=>"forminput");
			
			$deal_sold_out=array("name"=>"deal_sold_out","id"=>"deal_sold_out","class"=>"forminput");
			
			$deal_time_zone=array("name"=>"deal_time_zone","id"=>"deal_time_zone","class"=>"forminput");
			
			$deal_start_date=array("name"=>"deal_start_date","id"=>"deal_start_date","class"=>"forminput");
			
			$deal_end_date=array("name"=>"deal_end_date","id"=>"deal_end_date","class"=>"forminput");
			
			$division_lat=array("name"=>"division_lat","id"=>"division_lat","class"=>"forminput");
			
			$division_lng=array("name"=>"division_lng","id"=>"division_lng","class"=>"forminput");
			
			$deal_zip_code=array("name"=>"deal_zip_code","id"=>"deal_zip_code","class"=>"forminput");
			
			$deal_phone=array("name"=>"deal_phone","id"=>"deal_phone","class"=>"forminput");
			
			$deal_merchent_name=array("name"=>"deal_merchent_name","id"=>"deal_merchent_name","class"=>"forminput");
			
			$deal_merchent_url=array("name"=>"deal_merchent_url","id"=>"deal_merchent_url","class"=>"forminput");
			
			$deal_conditions=array("name"=>"deal_conditions","id"=>"deal_conditions","class"=>"forminput");
			
			$deal_zip_code=array("name"=>"deal_zip_code","id"=>"deal_zip_code","class"=>"forminput");
			
			$division_id=array("name"=>"division_id","id"=>"division_id","class"=>"forminput");
			
			$delas_image=array("name"=>"delas_image","id"=>"delas_image");
			
			$add_submit=array("name"=>"deal_form_submit","id"=>"deal_form_submit","class"=>"formbutton","value"=>"Add","style"=>"float:left");
			
			$cancel_submit=array("name"=>"deal_form_button","id"=>"deal_form_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left","onclick"=>"goto_view_page()", 'content' => 'Cancel');
			
			echo form_open('',$deals_detail_form);
			
			if(isset($edit_detail))
			{
				$deal_id=$edit_detail[0]->deal_id;
				
				echo form_hidden("edit_id",$edit_id);
				echo form_hidden("mode","edit");
				
				echo form_hidden("deals_id",$edit_detail[0]->deal_id);
				
				$add_submit["value"]="Edit";
				
				foreach($edit_detail[0] as $key=>$edit_data)
				{
					if(!in_array($key,$not_text_box_cols))	
					{
						if($edit_data!="")
						{
							//$edit_data=mysql_escape_string($edit_data);
							
							$arr="['value'] ="."\"".$edit_data."\"";
							
							//echo "$".$key.$arr.";";
							
							eval("$".$key.$arr.";");
						}
					}
				}
			}
		?>
        
        <div style="float:left; width:365px; margin-left:15px">
        	<?php
				echo '<div><h4>'.form_label(ucwords("deals Title"),"deal_title_label",array("class"=>"tTip","title"=>ucfirst("Enter Title of Deals"))).'</h4><br>'.form_input($deal_title).'</div><br>';
				echo '<div><h4>'.form_label(ucwords("deals city"),"deal_city_label",array("class"=>"tTip","title"=>ucfirst("Enter Deals city"))).'</h4><br>'.form_input($deal_city).'</div><br>';
				echo '<div><h4>'.form_label(ucwords("deals description"),"deal_description_label",array("class"=>"tTip","title"=>ucfirst("Enter Deals description"))).'</h4><br>'.form_textarea($deal_description).'</div><br>';
				
				if(isset($websites_drop_val))
				{
					$js='id="side_id" class="select_box required"';
					
					echo '<div><h4>'.form_label("Site ","side_id_label",array("class"=>"tTip","title"=>ucfirst("Enter Site"))).'</h4><br>'.form_dropdown("side_id",$websites_drop_val,'',$js).'</div><br>';
				}
				
				
				echo '<div><h4>'.form_label(ucwords("deals price"),"deal_price_label",array("class"=>"tTip","title"=>ucfirst("Enter Deals Price"))).'</h4><br>'.form_input($deal_price).'</div><br>';
				
				echo '<div><h4>'.form_label(ucwords("deals face value"),"deal_face_value_label",array("class"=>"tTip","title"=>ucfirst("Enter Deals Face Value"))).'</h4><br>'.form_input($deal_face_value).'</div><br>';
				
				echo '<div><h4>'.form_label(ucwords("deals percendage of saving"),"deal_save_percent_label",array("class"=>"tTip","title"=>ucwords("Enter percendage of saving Value"))).'</h4><br>'.form_input($deal_save_percent).'</div><br>';
				
				echo '<div><h4>'.form_label(ucwords("deals deal save value"),"deal_save_percent_label",array("class"=>"tTip","title"=>ucwords("Enter save value"))).'</h4><br>'.form_input($deal_save_value).'</div><br>';
				
				echo '<div><h4>'.form_label(ucwords("deals time zone"),"deal_time_zone_label",array("class"=>"tTip","title"=>ucwords("Enter time zone"))).'</h4><br>'.form_input($deal_time_zone).'</div><br>';
			?>
        </div>
        
        <div style="float:left;">
        	<?php
					echo '<div><h4>'.form_label(ucwords("deals start date"),"deal_start_date_label",array("class"=>"tTip","title"=>ucwords("Enter deals start date"))).'</h4><br>'.form_input($deal_start_date).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals end date"),"deal_end_date_label",array("class"=>"tTip","title"=>ucwords("Enter deals end date"))).'</h4><br>'.form_input($deal_end_date).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals latitude"),"deal_exp_date_label",array("class"=>"tTip","title"=>ucwords("Enter deals latitude "))).'</h4><br>'.form_input($division_lat).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals longitude"),"deal_address_label",array("class"=>"tTip","title"=>ucwords("Enter deals longitude"))).'</h4><br>'.form_input($division_lng).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals zip code"),"deal_zip_code_name_label",array("class"=>"tTip","title"=>ucwords("Enter deals zipcode"))).'</h4><br>'.form_input($deal_zip_code).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals phone"),"deal_phone_label",array("class"=>"tTip","title"=>ucwords("Enter Deals phone No"))).'</h4><br>'.form_input($deal_phone).'</div><br>';
					
					echo '<div><h4>'.form_label(ucwords("deals merchant url"),"deal_merchent_url_label",array("class"=>"tTip","title"=>ucwords("Enter merchant url "))).'</h4><br>'.form_input($deal_merchent_url).'</div><br>';
					
					echo '<div><h4>'.form_label("deals Image","logo_label",array("class"=>"tTip","title"=>ucwords("Deals Image"))).'</h4><br>';
					
					if(file_exists("uploads/deals/".$deal_id.".jpg"))
					{
						echo '<img src="'.base_url().'uploads/deals/'.$deal_id.'.jpg" style="width:250px;"/><br><br>';
					}
					
					echo form_upload($delas_image).'</div><br>';
			?>
        </div>
        <div class="clear"></div>
        <?php
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