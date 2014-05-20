<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	show_tabs('<?php echo $open_tab?>');
	<?php if(isset($country_id)) {?>
		$("#country").val('<?php echo $country_id?>');
	<?php }?>
	
	$("#add_city").validate({errorElement:"div"});
	
	$("#category").val('<?php echo $category_id?>');
	
	$("#sub_category_name").alphanumeric({allow:".,-,_, ,&"});
	
	$("#add_sub_category").validate({errorElement:"div"});
})
	
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
			
			$add_city_form=array("name"=>"add_sub_category","id"=>"add_sub_category");
			
			$sub_category_input=array("name"=>"sub_category_name","id"=>"sub_category_name","class"=>"required forminput");
			
			$tag_input=array("name"=>"sub_cat_tags","id"=>"sub_cat_tags","rows"=>5,"cols"=>30);
			
			$add_submit=array("name"=>"add_sub_cat_submit","id"=>"add_sub_cat_submit","class"=>"formbutton","value"=>"Add","style"=>"float:left");
        
        	$cancel_submit=array("name"=>"add_sub_cat_button","id"=>"add_sub_cat_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left","onclick"=>"goto_view_page()", 'content' => 'Cancel');
		
			//set edit values
			if(isset($sub_category_name))
			{
				$sub_category_input["value"]=$sub_category_name;
			}
			if(isset($tags))
				$tag_input["value"]=$tags;
			
			echo form_open('',$add_city_form);
			
			$js = 'id="category" class="select_box required"';
			
			if(isset($city_id))
				$city_input["value"]=$city_name;
				
			if(isset($sub_category_id))
			{
				echo form_hidden("edit_id",$sub_category_id);
				echo form_hidden("mode","edit");
				$add_submit["value"]="Edit";
			}
			echo '<div><h4>'.form_label("Category Name","country_name_label").'</h4><br>'.form_dropdown("category",$category_drop_val,'',$js).'</div><br>';
			
			echo '<div><h4>'.form_label("Sub Category Name","city_name_label").'</h4><br>'.form_input($sub_category_input).'</div><br>';
			
			echo '<div><h4>'.form_label("Tags","tags_label").'</h4><br>'.form_textarea($tag_input).'</div><br>';
			
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