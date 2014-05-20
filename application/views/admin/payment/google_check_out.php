<?php
	$disable_option=$data = array('name'=> 'sandbox','value'=> '0','checked'=> TRUE);
	
	$enable_option=$data = array('name'=> 'sandbox','value'=> '1');
	
	$merchant_id=array("name"=>"merchant_id","id"=>"merchant_id","class"=>"required forminput");
	
	$merchant_key=array("name"=>"merchant_key","id"=>"merchant_key","class"=>"required forminput");
	
	if(isset($edit_details) && count($edit_details)!=0)
	{
		$merchant_id["value"]=$edit_details[0]->merchant_id;
		
		$merchant_key["value"]=$edit_details[0]->merchant_key;
		
		echo form_hidden("table","google_check_out");
		
		echo form_hidden("edit_id",$edit_details[0]->id);
		
		if($edit_details[0]->sandbox!="")
		{
			echo '<script type="text/javascript">$(document).ready(function(){
						$("[name=sandbox]").filter("[value='.$edit_details[0]->sandbox.']").attr("checked","checked");
					})
				  </script>';
		}
	}
	?>
	<div style="float:left; margin-right:15px;">
	<?php
		echo '<div><h4>'.form_label("Enable Sandbox Testing?","sandbox_label",array("class"=>"tTip","title"=>"Enable or disable Google sandbox testing. nn<b>Please note</b>,  you will need to create a sandbox account with Google. This account is not the same as your regular Google checkout account.")).'</h4><br><label>'.form_radio($disable_option).'Disable&nbsp;&nbsp;&nbsp;</label><label>'.form_radio($enable_option).'&nbsp;Enable</label></div><br>';
		
		echo '<div><h4>'.form_label("Merchant ID","x_login_label",array("class"=>"tTip","title"=>"Enter your Google merchant ID. You can find the merchant ID by logging into Google checkout -> Settings -> Integration.")).'</h4><br>'.form_input($merchant_id).'</div><br>';
		
	?>
	</div>
	<div style="float:left">
	<?php
		echo '<div><h4>'.form_label("Merchant Key","merchant_key_label",array("class"=>"tTip","title"=>"Enter the Google merchant key here.  You can find the merchant key by logging into Google checkout -&gt; Settings -&gt; Integration.")).'</h4><br>'.form_input($merchant_key).'</div><br>';
	?>
	</div>
	<div class="clear"></div>