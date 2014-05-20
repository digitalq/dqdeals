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
		if(isset($faqs) and $faqs->num_rows()>0)
		{
			$faq = $faqs->row();
	  ?>
	 	<h3><?php echo $this->lang->line('edit_group'); ?></h3>
        <form method="post" action="<?php echo admin_url('faq/editfaq')?>/<?php echo $faq->id;  ?>"  id="static_page_form" name="static_page_form">	
         <table class="table" cellpadding="2" cellspacing="0" width="100%">
		  <tr><td class="clsName">Question ?<span class="clsRed">*</span></td><td>
		  <input class="forminput" type="text" name="question" value="<?php echo $faq->question; ?>" id="question"></td></tr>
		  
	      <tr><td class="clsName"><?php echo $this->lang->line('page_content'); ?><span class="clsRed">*</span></td><td class="clsNoborder">
			<textarea id="faq_content" name="faq_content" rows="15" cols="80" style="width: 100%"><?php echo $faq->faq_content;?></textarea>
			<?php echo form_error('faq_content');?>
       	 </td></tr>
	  
        <tr><td></td><td>
		 <input type="hidden" name="faq_operation" value="edit" />
		  <input type="hidden" name="id"  value="<?php echo $faq->id; ?>"/>
          <input type="submit" class="formbutton" value="<?php echo $this->lang->line('submit'); ?>"  name="editfaq"/></td>
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