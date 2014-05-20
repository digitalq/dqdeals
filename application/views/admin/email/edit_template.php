<div class="clsSettings">
		<div class="clsMainSettings">
				<div class="clsTitle">
				<h3><?php echo translate_admin('Edit E-mail Template'); ?></h3>
				</div> 

<?php
//Content of a Email Setting
if(isset($emailSettings) and $emailSettings->num_rows()>0)
{
$emailSetting = $emailSettings->row();
?>

<form method="post" action="<?php echo admin_url('email/edit/'.$emailSetting->id)?>">
<table width="700" class="table">
<tr>
<td width="20%">
<label><?php echo translate_admin('Email Title'); ?><span class="clsRed">*</span></label>
</td>
<td width="50%">
<input class="clsTextBox" size="70" type="text" name="email_title" value="<?php echo $emailSetting->title; ?>" />
<?php echo form_error('email_title'); ?>
</td>
<td width="20%"></td>
</tr>
					
<tr>
<td><label><?php echo translate_admin('Email Subject'); ?><span class="clsRed">*</span></label></td>
<td>
<input class="clsTextBox" size="70" type="text" name="email_subject" value="<?php echo $emailSetting->mail_subject ; ?>"/>
<?php echo form_error('email_subject'); ?>
</td>
<td></td>
</tr>
					
<tr>
<td><label><?php echo translate_admin("Plain Text Body"); ?><span class="clsRed">*</span></label></td>
<td>
<textarea style="width:448px; height:200px"  name="email_body_text"  class="mceNoEditor" rows="10" cols="35"><?php echo $emailSetting->email_body_text  ;?></textarea>
<?php $str = array(); $str = explode(' ',$emailSetting->email_body_text) ?>
<?php echo form_error('email_body_text'); ?>
</td>
<td>
<?php
$i=0;
foreach($str as $res)
{
$string = strchr($res,'{');
	
if(isset($string) !='') {  echo $string.'    '; };
}
?>
</td>
</tr>



<tr>
<td><label><?php echo translate_admin("Html Body"); ?><span class="clsRed">*</span></label></td>
<td>
<textarea  name="email_body_html"  class="clsTextArea" rows="10" cols="35"><?php echo $emailSetting->email_body_html; ?></textarea>
<?php $str = array(); $str = explode(' ',$emailSetting->email_body_html) ?>
<?php echo form_error('email_body_html'); ?>
</td>
<td>
<?php
$i=0;
foreach($str as $res)
{
$string = strchr($res,'{');
	
if(isset($string) !='') {  echo $string.'    '; };
}
?>
</td>
</tr>


<tr>
<td></td>
<td>
<input type="hidden" name="id"  value="<?php echo $emailSetting->id; ?>"/>
<input class="clsSubmitBt1" value="<?php echo translate_admin('Update'); ?>" name="editEmailSetting" type="submit">
</td>
<td></td>
</tr>  
			
</table>
</form>
	  <?php } ?>
		</div>
</div>

<!-- TinyMCE inclusion -->
<script type="text/javascript" src="<?php echo base_url()?>css/tiny_mce/tiny_mce.js" ></script>

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

</script >  
<!-- End of inclusion of files -->