<script type="text/javascript">
	$(document).ready(function(){
		show_tabs('<?php echo $open_tab?>');
		
		$("#txt_name").alphanumeric({allow:".,-,_, ,&"});
		
		$("#one_value_add_form").validate({errorElement: "div"});
	})
function goto_view_page()
{
	document.location='<?php echo admin_url("home/view_".$table_type);?>'
}
</script>
    <?php
        $form_arribute=array("name"=>"one_value_add_form","id"=>"one_value_add_form");
        
        $add_submit=array("name"=>"one_value_submit","id"=>"one_value_submit","class"=>"formbutton","value"=>"Add","style"=>"float:left");
        
        $cancel_submit=array("name"=>"one_value_submit","id"=>"one_value_submit","class"=>"formbutton","value"=>"Cancel","style"=>"float:left","onclick"=>"goto_view_page()", 'content' => 'Cancel');
        
        echo form_open(admin_url('home/add_one_value/'),$form_arribute);
        
        echo form_hidden(array("form_type"=>$table_type));
        
        $name_input=array("name"=>"txt_name","id"=>"txt_name","class"=>"forminput required");
		
		if(isset($cat_name))
			$name_input["value"]=$cat_name;
		if(isset($cat_id))
		{
			echo form_hidden("edit_id",$cat_id);
			echo form_hidden("mode","edit");
			$add_submit["value"]="Edit";
		}
			
        echo '<div><h4>'.form_label(ucfirst($table_type)." Name",$table_type."_label").'</h4><br>'.form_input($name_input).'</div>';
        echo '<div><br>'.form_submit($add_submit).'<div style="width:10px;float:left">&nbsp;</div>'.form_button($cancel_submit).'</div><div class="clear"></div>';
        echo form_close();
    ?>
