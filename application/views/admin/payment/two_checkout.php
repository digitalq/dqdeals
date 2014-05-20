<?php
	$disable_option=$data = array('name'=> 'test_mode','value'=> '0','checked'=> TRUE);
	
	$enable_option=$data = array('name'=> 'test_mode','value'=> '1');
	
	$sid=array("name"=>"sid","id"=>"sid","class"=>"required forminput");
	
	$secret_phrase=array("name"=>"secret_phrase","id"=>"secret_phrase","class"=>"required forminput");
	
	if(isset($edit_details) && count($edit_details)!=0)
	{
		$sid["value"]=$edit_details[0]->sid;
		
		$secret_phrase["value"]=$edit_details[0]->secret_phrase;
		
		echo form_hidden("table","two_checkout");
		
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
		echo '<div><h4>'.form_label("Test Mode","sandbox_label",array("class"=>"tTip","title"=>"Enable or disable test mode.")).'</h4><br><label>'.form_radio($disable_option).'Disable&nbsp;&nbsp;&nbsp;</label><label>'.form_radio($enable_option).'&nbsp;Enable</label></div><br>';
		
		echo '<div><h4>'.form_label("2Checkout Vendor ID","sid_label",array("class"=>"tTip","title"=>"Please enter your 2Checkout Vendor ID.")).'</h4><br>'.form_input($sid).'</div><br>';
		
	?>
	</div>
	<div style="float:left">
	<?php
		echo '<div><h4>'.form_label("Secret Phrase","secret_phrase_label",array("class"=>"tTip","title"=>"Setting Your Secret Phrase:nn1.Login to your accountnn2. Click on <i>Look and Feel</i> found on your account homepage.nn3.  <i>Your Secret Word</i> (16 Character Limit):nnEnter your secret word into this data field. The only limit is that must be 16 characters or less.nn4. When you are finished entering it, click <i>Save Changes</i>")).'</h4><br>'.form_input($secret_phrase).'</div><br>';
	?>
	</div>
	<div class="clear"></div>