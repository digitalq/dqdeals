<?php
	$pay_to_email=array("name"=>"pay_to_email","id"=>"pay_to_email","class"=>"required forminput email");
	
	$secret_word=array("name"=>"secret_word","id"=>"secret_word","class"=>"required forminput");
	
	$recipient_description=array("name"=>"recipient_description","id"=>"recipient_description","class"=>"forminput");
	
	$confirmation_note=array("name"=>"confirmation_note","id"=>"confirmation_note","class"=>"forminput");
	
	$logo_url=array("name"=>"logo_url","id"=>"logo_url","class"=>"forminput");
	
	$selected='';
	
	if(isset($edit_details) && count($edit_details)!=0)
	{
		$pay_to_email["value"]=$edit_details[0]->pay_to_email;
		
		$secret_word["value"]=$edit_details[0]->secret_word;
		
		$recipient_description["value"]=$edit_details[0]->recipient_description;
		
		$confirmation_note["value"]=$edit_details[0]->confirmation_note;
		
		$logo_url["value"]=$edit_details[0]->logo_url;
		
		echo form_hidden("table","moneybookers");
		
		echo form_hidden("edit_id",$edit_details[0]->id);
	}
	?>
	<div style="float:left; margin-right:15px;">
	<?php
		echo '<div><h4>'.form_label("Pay to E-mail","pay_to_email_label",array("class"=>"tTip","title"=>"Enter your Moneybookers pay to URL.")).'</h4><br>'.form_input($pay_to_email).'</div><br>';
		
		echo '<div><h4>'.form_label("Secret Word","secret_word_label",array("class"=>"tTip","title"=>"Please enter your secret word here.nnIn order to use this you must request this functionality via email to merchantservices@moneybookers.com.")).'</h4><br>'.form_input($secret_word).'</div><br>';
		
		echo '<div><h4>'.form_label("Company Name","recipient_description_label",array("class"=>"tTip","title"=>"A description of the Merchant, which will be shown on the gateway. If no value is submitted, the pay_to_email value will be shown as the recipient of the payment. (Max 30 characters)")).'</h4><br>'.form_input($recipient_description).'</div><br>';
		
	?>
	</div>
	<div style="float:left">
	<?php
		echo '<div><h4>'.form_label("Confirmation Note","confirmation_note_label",array("class"=>"tTip","title"=>"Merchant may show to the customer on the confirmation screen - the end step of the process - a note, confirmation number, PIN or any other message. HTML line breaks may be used for longer messages.")).'</h4><br>'.form_input($confirmation_note).'</div><br>';
		
		echo '<div><h4>'.form_label("Logo URL","logo_url_label",array("class"=>"tTip","title"=>"The URL of the logo which you would like to appear at the top of the gateway. The logo must be accessible via HTTPS otherwise it will not be shown. For best integration results we recommend that Merchants use logos with dimensions up to 200px in width and 50px in height.")).'</h4><br>'.form_input($logo_url).'</div><br>';
	?>
	</div>
	<div class="clear"></div>