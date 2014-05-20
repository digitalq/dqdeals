<?php
	$account_name=array("name"=>"account_name","id"=>"account_name","class"=>"required forminput");
	
	$account_email=array("name"=>"account_email","id"=>"account_email","class"=>"required forminput email");
	
	$site_url=array("name"=>"site_url","id"=>"site_url","class"=>"forminput url");
	
	$paypal_option=$data = array('name'=> 'paypal_mode','value'=> '0','checked'=> TRUE);
	
	$sand_box_option=$data = array('name'=> 'paypal_mode','value'=> '1');
	
	$cus_sub1=array('name'=> 'cus_sub','value'=> '0','checked'=> TRUE);
	
	$cus_sub2=array('name'=> 'cus_sub','value'=> '1');

	$add_submit=array("name"=>"paypal_set_submit","id"=>"paypal_set_submit","class"=>"formbutton","value"=>"Save","style"=>"float:left");
	
	$cancel_submit=array("name"=>"cancel_button","id"=>"cancel_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left", 'content' => 'Cancel');
	
	$selected='';
	
	if(isset($edit_details) && count($edit_details)!=0)
	{
		$account_name["value"]=$edit_details[0]->name;
		
		$account_email["value"]=$edit_details[0]->account_email;
		
		$site_url["value"]=$edit_details[0]->site_url;
		
		echo form_hidden("table","paypal");
		
		echo form_hidden("edit_id",$edit_details[0]->id);
		
		if($edit_details[0]->paypal_mode!="")
		{
			echo '<script type="text/javascript">$(document).ready(function(){
						$("[name=paypal_mode]").filter("[value='.$edit_details[0]->paypal_mode.']").attr("checked","checked");
						$("[name=cus_sub]").filter("[value='.$edit_details[0]->cus_sub.']").attr("checked","checked");
					})
				  </script>';
		}
		
	}
	?>
	<div style="float:left">
	<?php
		echo '<div><h4>'.form_label("Enable Sandbox Testing ?","mode_label",array("class"=>"tTip","title"=>"Learn more about Paypal sandbox at:nnhttps://developer.paypal.com")).'</h4><br><label>'.form_radio($paypal_option).'Disable&nbsp;&nbsp;&nbsp;</label><label>'.form_radio($sand_box_option).'&nbsp;Enable</label></div><br>';
		
		echo '<div><h4>'.form_label("Create Subscriptions at Paypal When Possible?","cus_mode_label",array("class"=>"tTip","title"=>"Choose <b>Enable</b> to create subscriptions at Paypal when possible. <br><br>Choose <b>Disable</b> to always create one time payments at Paypal. <br><br><b>Disabled</b> is the preferred setting for many because SPBAS already sends invoice reminders and has built in suspension logic for unpaid invoices.<br><br>We recommend you choose <b>Disable</b>.")).'</h4><br><label>'.form_radio($cus_sub1).'Disable&nbsp;&nbsp;&nbsp;</label><label>'.form_radio($cus_sub2).'&nbsp;Enable</label></div><br>';
	?>
	</div>
	<div style="float:left">
	<?php
		echo '<div><h4>'.form_label("URL To your logo","logo_label",array("class"=>"tTip","title"=>"Enter the full URL to your logo online. For example:nnhttp://mydomain.com/logo.gif")).'</h4><br>'.form_input($site_url).'</div><br>';
		
		echo '<div><h4>'.form_label("Your paypal Email id","email_label",array("class"=>"tTip","title"=>"Please enter your Paypal ID. nnIf you have more than one ID use comma separated format. nnFor example:nid@dom.com,id1@dom.com,id2@dom.comnnAlso note, the first ID you enter will be displayed to the customer as the payee ID.")).'</h4><br>'.form_input($account_email).'</div><br>';
	?>
	</div>
	<div class="clear"></div>