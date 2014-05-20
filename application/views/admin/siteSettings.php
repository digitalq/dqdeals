<?php 
$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	show_tabs('<?php echo $open_tab?>');
})
</script>
<style type="text/css">
.select_box
{
	width:437px;
}
textarea
{
	line-height:20px!important;
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
    	<form action="<?php echo admin_url('siteSettings'); ?>" method="post" enctype="multipart/form-data" id="setting_form" name="setting_form">
		 <table class="table1" cellpadding="2" cellspacing="0">
		<tbody>
        <tr>
          <td class="clsName">Time Zone<span class="clsRed">*</span></td>
          <td class="clsMailIds">
          <?php 
		  		if(isset($settings['SITE_TIME_ZONE']))
					$default = $settings['SITE_TIME_ZONE'];
				else
					$default = 'UTC';
					
				echo timezone_menu($default, $class = "select_box",'timezones');
				echo form_error('site_title'); 
			?></td>
            
            
        </tr>
       <tr>
          <td class="clsName"><?php echo $this->lang->line('website_title'); ?><span class="clsRed">*</span></td>
          <td class="clsMailIds"><input class="forminput" type="text" name="site_title" value="<?php if(isset($settings['SITE_TITLE'])) echo $settings['SITE_TITLE']; ?>"   />
          <?php echo form_error('site_title'); ?></td></tr>
       <tr>
         <td><?php echo $this->lang->line('website_slogan'); ?><span class="clsRed">*</span></td>
          <td><input class="forminput" type="text" name="site_slogan" value="<?php if(isset($settings['SITE_SLOGAN'])) echo $settings['SITE_SLOGAN']; ?>" />
          <?php echo form_error('site_slogan'); ?></td></tr>
		  <tr>
         <td><?php echo $this->lang->line('site_url'); ?><span class="clsRed">*</span></td>
          <td><input class="forminput" type="text" name="base_url" value="<?php if(isset($settings['BASE_URL'])) echo $settings['BASE_URL']; ?>"  />
          <?php echo form_error('base_url'); ?> </td></tr>
		<tr>
          <td><?php echo $this->lang->line('website_admin_mail'); ?><span class="clsRed">*</span></td>
           <td><input class="forminput" type="text" name="site_admin_mail" value="<?php if(isset($settings['SITE_ADMIN_MAIL'])) echo $settings['SITE_ADMIN_MAIL']; ?>"  />
          <?php echo form_error('site_admin_mail'); ?></td></tr>  
        <tr>
		<!-- <INPUT TYPE="hidden" NAME="site_language" value='<?php //if(isset($settings['LANGUAGE_CODE'])) echo $settings['LANGUAGE_CODE']; ?>'> -->
		<tr>
          <td><?php echo $this->lang->line('language code'); ?><span class="clsRed">*</span></td>
           <td><input class="forminput" type="text" name="site_language" value="<?php if(isset($settings['LANGUAGE_CODE'])) echo $settings['LANGUAGE_CODE']; ?>"  />
          <?php echo form_error('language_code'); ?></td></tr>  
        <tr> 
		
          <td><?php echo $this->lang->line('website_closed'); ?><span class="clsRed">*</span></td>
           <td><input type="radio"  class="clsRadioBut" name="site_status"  value="1"  <?php if(isset($settings['SITE_STATUS']) and $settings['SITE_STATUS']==1)  echo 'checked="checked"'; ?>  />
          <?php echo $this->lang->line('On');?>
          <input type="radio" name="site_status" class="clsRadioBut" value="0"<?php if(isset($settings['SITE_STATUS']) and $settings['SITE_STATUS']==0)  echo 'checked="checked"';   ?>  />
          <?php echo $this->lang->line('Off');?></td></tr>
        <tr>
          <td><?php echo $this->lang->line('closed_message'); ?><span class="clsRed">*</span></td>
          <td><textarea class="forminput" name="offline_message" style="height:130px;"><?php if(isset($settings['OFFLINE_MESSAGE'])) echo $settings['OFFLINE_MESSAGE']; ?> 
</textarea>
          <?php echo form_error('offline_message'); ?> </td></tr>
         <tr>
          <td>HTML Meta Tag Keywords<span class="clsRed">*</span></td>
          <td><textarea class="forminput" name="site_meta_tag" style="height:130px;"><?php if(isset($settings['META_TAGS'])) echo $settings['META_TAGS']; ?></textarea>
          <?php echo form_error('site_meta_tag'); ?> </td></tr>
          <tr>
          <td>HTML Meta description<span class="clsRed">*</span></td>
          <td><textarea class="forminput" name="site_meta_description" id="site_meta_description" style="height:130px;"><?php if(isset($settings['META_TAGS_DESCRIPTION'])) echo $settings['META_TAGS_DESCRIPTION']; ?></textarea>
          <?php echo form_error('site_meta_description'); ?> </td></tr>
          
        <tr>
          <td>Welcome Message</td>
          <td>
          		<input class="forminput" type="text" name="google_adsense_id" value="<?php if(isset($settings['GOOGLE_AD_SENSE'])) echo $settings['GOOGLE_AD_SENSE']; ?>"  />
          </td>
        </tr>
       <tr>
          <td>Site Logo</td>
          <td>
                <input class="forminput" type="file" name="site_logo" value="<?php if(isset($settings['SITE_LOGO'])) echo $settings['SITE_LOGO']; ?>"  />
            <br />
            <br />
            <?php
				$logo="";
            	if(isset($settings['SITE_LOGO']) && $settings['SITE_LOGO']!='')
					$logo=$settings['SITE_LOGO'];
				else
					$logo="logo.png";				
				echo '<img src="'.base_url().'css/logo/'.$logo.'" style="width:205px">';
			?>
          </td>
        </tr> 
		<tr>  
        <td></td>
        <td><input class="formbutton" value="<?php echo $this->lang->line('Submit');?>" name="siteSettings" type="submit">
        </td>
      <!--</form>-->
	  </tr>
	  </tbody></table>
	  </form>
   </div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>