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
    <form method="post" action="<?php echo admin_url('faq/addFaq')?>" id="faq_form" name="faq_form">	
     <table class="table" cellpadding="2" cellspacing="0" width="100%">
		  <tr>
		     <td class="clsName">Question ?&nbsp;<span class="clsRed">*</span></td>
		     <td class="clsMailID">
             	<input class="forminput" id="question" type="text" name="question" value="<?php echo set_value('question'); ?>">
				<?php echo form_error('question'); ?></td>
		  </tr>
         
         <tr>
         <td class="clsName"> 
		   Answer&nbsp;<span class="clsRed">*</span>
         </td>
         <td>
		 	<textarea id="faq_content" name="faq_content" rows="15" cols="150" style="width: 100%"></textarea>
      <?php 
	  	echo form_error('page_content');
	 ?></td></tr>
	     <tr><td></td>    
          <td><input type="hidden" name="faq_operation" value="add"  />
		 	 <input class="formbutton" value="<?php echo $this->lang->line('Submit');?>" name="addFaq" type="submit">
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