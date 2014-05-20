<script type="text/javascript">
		function startCallback() {
		document.getElementById('message').innerHTML = '<img src="<?php echo base_url().'images/loading.gif' ?>">';
		// make something useful before submit (onStart)
		return true;
	}

	function completeCallback(response)
	{
				document.getElementById('message').innerHTML  = response;
	}
</script>

<div class="clsSettings">
    <div class="clsMainSettings">
		<div class="clsTitle">
	 <h3><?php echo translate_admin('Mass E-Mail Campaigns'); ?></h3>
	 </div>
		
<form action="<?php echo admin_url('email/mass_email'); ?>" method="post" enctype="multipart/form-data" onsubmit="return AIM.submit(this, {'onStart' : startCallback, 'onComplete' : completeCallback})">	

<table class="table" cellpadding="2" cellspacing="0">
	
<tr valign="top">
			<td class="clsName"><?php echo translate_admin('Email To'); ?></td>
			<td> 
			 <input type="radio" checked="checked" name="is_private" onclick="javacript:showhide(this.value);" value="0"> <?php echo translate_admin('All Users'); ?> &nbsp;
			 <input type="radio" name="is_private" onclick="javacript:showhide(this.value);" value="1"> <?php echo translate_admin('Particular Users'); ?>
				
				<div id="emails_private" style="display:none;">
				<br />
					<p><?php echo translate_admin('Enter the email address separated by commas'); ?></p>
					<p> <textarea name="email_to" style="width:300px; height:100px" rows="10" cols="60" class="text_area"> </textarea></p>
				</div>
			 </td>
</tr>

<tr>
			<td class="clsName"><?php echo translate_admin('Subject'); ?></td>
			<td> <input type="text" size="55" name="subject" value=""> </td>
</tr>		

<tr>
			<td class="clsName"><?php echo translate_admin('Message'); ?></td>
<td>
<textarea name="message" style="width:400px; height:100px" rows="10" cols="60" class="text_area"></textarea>
</td>
</tr>

<tr>
		<td></td>
		<td>
		<div class="clearfix">
		<span style="float:left; margin:0 10px 0 0;"><input class="clsSubmitBt1" type="submit" name="submit" value="<?php echo translate_admin('Submit'); ?>" style="width:90px;" /></span>
		<span style="float:left; padding:20px 0 0 0;"><div id="message"></div></span>
		</div>
		</td>
</tr>

</table>

</form>
</div>
</div>

<script language="Javascript">

function showhide(id)
{
	if(id == 0)
	{
	document.getElementById("emails_private").style.display  = "none";
	}
	else
	{ 
	document.getElementById("emails_private").style.display  = "block";	
	}

}
</script>