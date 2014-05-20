<?php 
$this->load->view("admin/header");	
?>
<script type="text/javascript" src="<?php echo base_url() ?>js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<script type="text/javascript">
$(document).ready(function(){
	show_tabs('<?php echo $open_tab?>');
})
</script>

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
    <form method="post" action="<?php echo admin_url('page/addPage')?>" id="static_page_form" name="static_page_form">	
     <table class="table" cellpadding="2" cellspacing="0" width="100%">
		  <tr>
		     <td class="clsName"><?php echo $this->lang->line('page_name'); ?><span class="clsRed">*</span></td>
		     <td class="clsMailID"><input class="forminput" class="forminput" type="text" name="page_name" value="<?php echo set_value('page_name'); ?>"><?php echo form_error('page_name'); ?></td>
		  </tr>
          <tr>
		     <td class="clsName"><?php echo $this->lang->line('page_title'); ?><span class="clsRed">*</span></td>
		     <td><input class="forminput" type="text" name="page_title" value="<?php echo set_value('page_title'); ?>"> <?php echo form_error('page_title'); ?> </td>
		  </tr>
          <tr>
		     <td class="clsName"><?php echo $this->lang->line('page_url'); ?><span class="clsRed">*</span></td>
		     <td><input class="forminput" type="text" name="page_url" value="<?php echo set_value('page_url'); ?>"><?php echo form_error('page_url'); ?></td>
		  </tr>	 
         <tr><td class="clsName"> 
		   
         <?php echo $this->lang->line('page_content'); ?><span class="clsRed">*</span></td><td>
		 <textarea id="elm1" name="page_content" rows="15" cols="150" style="width: 100%"></textarea>
		
      <?php //if(isset($this->validation->page_content_error))echo $this->validation->content_error; 
	  echo form_error('page_content');?></td></tr>
	     <tr><td></td>    
          <td><input type="hidden" name="page_operation" value="add"  />
		  <input class="formbutton" value="<?php echo $this->lang->line('Submit');?>" name="addPage" type="submit">
          </td></tr>
      </table>
      </form>
	</div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>