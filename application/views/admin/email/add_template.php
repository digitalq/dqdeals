<style type="text/css">
td
{
	padding:10px;
}
</style>
<form method="post" action="<?php echo admin_url('email/addemailTemplate')?>">					
<table class="table">
		
<tr>
		<td><label><?php echo translate_admin('Email Type'); ?></td>
		<td>
						<input class="clsTextBox" size="70" type="text" name="email_type" value="<?php echo set_value('email_type'); ?>"/>
						<?php echo form_error('email_type'); ?>
		</td>
</tr>
<tr>
  <td><label><?php echo translate_admin('Email Title'); ?><span class="clsRed">*</span></label></td>
		<td>
				<input class="clsTextBox" size="70" type="text" name="email_title" value="<?php echo set_value('email_title'); ?>"/>
				<?php echo form_error('email_title'); ?>
	 </td>
</tr>

<tr>
  <td><label><?php echo translate_admin('Email Subject'); ?><span class="clsRed">*</span></label></td>
		<td>
				<input class="clsTextBox" size="70" type="text" name="email_subject" value="<?php echo set_value('email_subject'); ?>"/>
				<?php echo form_error('email_subject'); ?>
		</td>
</tr>

<tr>
   <td><br /><label><?php echo translate_admin("Plain Text Body"); ?><span class="clsRed">*</span></label></td>
			<td>
            	<br />
				<textarea style="width:448px; height:200px" rows="10" cols="60" class="mceNoEditor" name="email_body_text"><?php echo set_value('email_body_text'); ?></textarea>
				<?php echo form_error('email_body_text'); ?>
			 </td>
</tr>

<tr>
   <td><br /><label><?php echo translate_admin("Html Body"); ?><span class="clsRed">*</span></label></td>
			<td>
            	<br />
				<textarea class="" name="email_body_html"><?php echo set_value('email_body_html'); ?></textarea>
				<?php echo form_error('email_body_html'); ?>
			 </td>
</tr>

<tr>
	<td></td>
	<td>
	<input class="formbutton" value="<?php echo translate_admin('Submit'); ?>" name="addemailTemplate" type="submit">
	</td>
</tr>
		
</table>
</form>	
<!-- TinyMCE inclusion -->
<script type="text/javascript" src="<?php echo base_url()?>js/tiny_mce/tiny_mce.js" ></script>

<script language="Javascript">
tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
								editor_deselector : "mceNoEditor",
        plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true
});

</script>
<!-- End of inclusion of files -->