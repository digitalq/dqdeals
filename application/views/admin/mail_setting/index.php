<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#site_map_form").validate({errorElement:"div"});
	show_tabs('<?php echo $open_tab?>');
	$(".<?php echo $open_tab?> .boxtitle").removeClass("closed");
	<?php
	if(isset($cancel_url))
		echo '$("#cancel_button").click(function(){ document.location="'.$cancel_url.'"});';
	?>
})

</script>
<style type="text/css">
.forminput
{
	width:300px;
}
.select_box
{
	width:315px;
}
</style>

<?php $this->load->view("admin/thesidebar");?>
<div id="dashboardwrap">
	<div id="dashboard" class="box new">
	<div id="dashboard-top">
    	<h2><?php if(isset($title)) echo ucfirst($title)?></h2><br />
    </div>
    <div id="dashboard-body">
    <?php 
	if($msg = $this->session->flashdata('flash_message'))
		{
			echo "<div>".$msg."</div>";
		}
		
    ?>
    <?php
		$mail_setting_form=array("name"=>"mail_setting_form","id"=>"mail_setting_form","enctype"=>"multipart/form-data");
		
		$mailer=array("name"=>"mailer","id"=>"mailer","class"=>"forminput");
		
		$send_mail_path=array("name"=>"send_mail_path","id"=>"send_mail_path","class"=>"forminput");
		
		$smtp_server=array("name"=>"smtp_server","id"=>"smtp_server","class"=>"forminput");
		
		$smtp_port=array("name"=>"smtp_port","id"=>"smtp_port","class"=>"forminput");
		
		$smtp_prefix=array(""=>"Default","ssl"=>"SSL","tls"=>"TLS");
		
		$smtp_auth=array("1"=>"Yes","0"=>"No");
		
		$smtp_user_name=array("name"=>"smtp_user_name","id"=>"smtp_user_name","class"=>"forminput");
		
		$smtp_user_password=array("name"=>"smtp_password","id"=>"smtp_password","class"=>"forminput");
		
		$mail_setting_submit=array("name"=>"mail_setting_submit","id"=>"mail_setting_submit","class"=>"formbutton","value"=>"Save","style"=>"float:left");
		
		$cancel_submit=array("name"=>"cancel_button","id"=>"cancel_button","class"=>"formbutton","value"=>"Cancel","style"=>"float:left", 'content' => 'Cancel');
		
		echo form_open('',$mail_setting_form);
		
		?>
		<?php
			$mailer_value='';
			
			$smtp_prefix_val='';
			
			$smtp_auth_val='';
			
			if(isset($mail_settings_values))
			{
				$send_mail_path["value"]=$mail_settings_values[0]->sendmail_path;
				
				$smtp_server["value"]=$mail_settings_values[0]->smtp_server;
				
				$smtp_port["value"]=$mail_settings_values[0]->smtp_port;
				
				$smtp_user_name["value"]=$mail_settings_values[0]->smtp_username;
				
				$smtp_user_password["value"]=$mail_settings_values[0]->smtp_password;
				
				$mailer_value=$mail_settings_values[0]->mailer;
			
				$smtp_prefix_val=$mail_settings_values[0]->smtp_prefix;
			
				$smtp_auth_val=$mail_settings_values[0]->smtp_auth;
			}
			$options = array(
                  'mail'  => 'PHP Mail Function',
                  'sendmail'    => 'Sendmail',
                  'smtp'   => 'SMTP Server',
                );
		
		?>
        <div style="float:left; margin-right:10px;">
        <?php
				
        echo '<div><h4>'.form_label("Mailer","mailer_label").'</h4><br>'.form_dropdown("mailer",$options,$mailer_value,'id="mailer" class="select_box"').'<br></div><br>';
		
		echo '<div><h4>'.form_label("Sendmail Path","Sendmail_Path").'</h4><br>'.form_input($send_mail_path).'<br></div><br>';
		
		echo '<div><h4>'.form_label("SMTP Server","SMTP_Server").'</h4><br>'.form_input($smtp_server).'<br></div><br>';
		
		echo '<div><h4>'.form_label("SMTP Port","SMTP_Port").'</h4><br>'.form_input($smtp_port).'<br></div><br>';
		
		?>
        </div>
        <div style="float:left;">
        <?php
		
		echo '<div><h4>'.form_label("SMTP Prefix","SMTP_Prefix").'</h4><br>'.form_dropdown("smtp_prefix",$smtp_prefix,$smtp_prefix_val,'id="smtp_prefix" class="select_box"').'<br></div><br>';
		
		echo '<div><h4>'.form_label("SMTP Authentification","SMTP_Authentification").'</h4><br>'.form_dropdown("smtp_auth",$smtp_auth,$smtp_auth_val,'id="smtp_auth" class="select_box"').'<br></div><br>';
		
		echo '<div><h4>'.form_label("SMTP Username","SMTP Username").'</h4><br>'.form_input($smtp_user_name).'<br></div><br>';
		
		echo '<div><h4>'.form_label("SMTP Password","SMTP Password").'</h4><br>'.form_password($smtp_user_password).'<br></div><br>';
		?>
        </div>
        <div class="clear"></div>
		<?php
		echo '<div><br>'.form_submit($mail_setting_submit).'<div style="width:10px;float:left">&nbsp;</div>'.form_button($cancel_submit).'</div><div class="clear"></div>';
		
		echo form_close();
		
	?>	
	</div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>