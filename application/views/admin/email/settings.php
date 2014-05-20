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
	 <h3><?php echo translate_admin('E-Mail Settings'); ?></h3>
	 </div>
		
<form action="<?php echo admin_url('email/settings'); ?>" method="post" enctype="multipart/form-data" onsubmit="return AIM.submit(this, {'onStart' : startCallback, 'onComplete' : completeCallback})">	

<table class="table" cellpadding="2" cellspacing="0">
	
	<tr valign="top">
			<td class="clsName"><?php echo translate_admin('Email Mode'); ?></td>
			<td> 
			 <select name="mailer_mode" id="mailer_mode" >
							<option value="html"> HTML Mode </option>
							<option value="text"> Plain Teax Mode </option>
				</select> 
			 </td>
</tr>
	
	
<tr valign="top">
			<td class="clsName"><?php echo translate_admin('Mailer Type'); ?></td>
			<td> 
			 <select name="mailer_type" id="mailer_type" >
							<option value="1"> PHP Mail Function </option>
							<option value="2"> ISP's SMTP server </option>
							<option value="3"> Google's SMTP Server </option>
				</select> 
			 </td>
</tr>

<tr>
			<td class="clsName"><?php echo translate_admin('SMTP Port'); ?></td>
			<td> <input type="text" size="23" name="smtp_port" value="<?php if(isset($smtp_port)) echo $smtp_port; ?>"> </td>
</tr>		

<tr>
			<td class="clsName"><?php echo translate_admin('SMTP Username'); ?></td>
			<td> <input type="text" size="23" name="smtp_user" value="<?php if(isset($smtp_user)) echo $smtp_user; ?>"> </td>
</tr>	

<tr>
			<td class="clsName"><?php echo translate_admin('SMTP Password'); ?></td>
			<td> <input type="text" size="23" name="smtp_pass" value="<?php if(isset($smtp_pass)) echo $smtp_pass; ?>"> </td>
</tr>	

<tr>
		<td></td>
		<td>
		<div class="clearfix">
		<span style="float:left; margin:0 10px 0 0;"><input class="clsSubmitBt1" type="submit" name="update" value="<?php echo translate_admin('Update'); ?>" style="width:90px;" /></span>
		<span style="float:left; padding:20px 0 0 0;"><div id="message"></div></span>
		</div>
		</td>
</tr>

</table>

</form>
</div>
</div>
<script language="Javascript">
jQuery("#mailer_type").val('<?php echo $mailer_type; ?>');
jQuery("#mailer_mode").val('<?php echo $mailer_mode; ?>');
</script>