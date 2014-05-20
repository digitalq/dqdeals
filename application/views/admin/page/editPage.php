<?php 
$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	show_tabs('<?php echo $open_tab?>');
})
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
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
     <?php
	  	//Content of a group
		if(isset($pages) and $pages->num_rows()>0)
		{
			$page = $pages->row();
	  ?>
	 	<h3><?php echo $this->lang->line('edit_group'); ?></h3>
        <form method="post" action="<?php echo admin_url('page/editPage')?>/<?php echo $page->id;  ?>"  id="static_page_form" name="static_page_form">	
         <table class="table" cellpadding="2" cellspacing="0" width="100%">
		  <tr><td class="clsName"><?php echo $this->lang->line('page_title'); ?><span class="clsRed">*</span></td><td>
		  <input class="forminput" type="text" name="page_title" value="<?php echo $page->page_title; ?>"></td></tr>
		  <?php echo form_error('page_title'); ?> <br />
          <tr><td class="clsName"><?php echo $this->lang->line('page_name'); ?><span class="clsRed">*</span></td><td>
		  <input class="forminput" type="text" name="page_name" value="<?php echo $page->name; ?>"></td></tr>
		  <?php echo form_error('page_name'); ?> <br />
      
	    <tr><td class="clsName"><?php echo $this->lang->line('page_content'); ?><span class="clsRed">*</span></td><td class="clsNoborder">
		<textarea id="elm1" name="page_content" rows="15" cols="80" style="width: 100%"><?php echo $page->content;?></textarea>
		<?php echo form_error('page_content');?>
       </td></tr>
	  
        <tr><td></td><td>
		 <input type="hidden" name="page_operation" value="edit" />
		  <input type="hidden" name="id"  value="<?php echo $page->id; ?>"/>
          <input type="submit" class="formbutton" value="<?php echo $this->lang->line('submit'); ?>"  name="editPage"/></td>
		</tr>  
      </table>
      </form>
	  <?php
	  }
	  ?>
	</div>    
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>