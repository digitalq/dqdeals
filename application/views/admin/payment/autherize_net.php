<?php
	$disable_option=$data = array('name'=> 'test_mode','value'=> '0','checked'=> TRUE);
	
	$enable_option=$data = array('name'=> 'test_mode','value'=> '1');
	
	$x_login=array("name"=>"x_login","id"=>"x_login","class"=>"required forminput");
	
	$x_transaction_key=array("name"=>"x_transaction_key","id"=>"x_transaction_key","class"=>"required forminput");
	
	if(isset($edit_details) && count($edit_details)!=0)
	{
		$x_login["value"]=$edit_details[0]->x_login;
		
		$x_transaction_key["value"]=$edit_details[0]->x_transaction_key;
		
		echo form_hidden("table","autherize_net");
		
		echo form_hidden("edit_id",$edit_details[0]->id);
		
		if($edit_details[0]->test_mode!="")
		{
			echo '<script type="text/javascript">$(document).ready(function(){
						$("[name=test_mode]").filter("[value='.$edit_details[0]->test_mode.']").attr("checked","checked");
					})
				  </script>';
		}
	}
	?>
	<div style="float:left; margin-right:15px;">
	<?php
		echo '<div><h4>'.form_label("Test Mode","enable_option_label",array("class"=>"tTip","title"=>"Enable or disable test mode.")).'</h4><br><label>'.form_radio($disable_option).'Disable&nbsp;&nbsp;&nbsp;</label><label>'.form_radio($enable_option).'&nbsp;Enable</label></div><br>';
		
		echo '<div><h4>'.form_label("API Login ID","x_login_label",array("class"=>"tTip","title"=>"Please enter your API login ID.")).'</h4><br>'.form_input($x_login).'</div><br>';
		
	?>
	</div>
	<div style="float:left">
	<?php
		echo '<div><h4>'.form_label("Transaction Key","x_transaction_key_label",array("class"=>"tTip","title"=>"Enter your API transaction key.")).'</h4><br>'.form_input($x_transaction_key).'</div><br>';
	?>
	</div>
	<div class="clear"></div>