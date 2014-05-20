<?php 
$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	show_tabs('<?php echo $open_tab?>');
})
function delete_record(id)
{
	var change_status=$("#table_name").val();
	
	var status_image='enable';
	
	var ok=confirm("Are you sure to Delete this record?");
		if(!ok)
			return false;
			
	$.ajax({ type: "POST",url: "<?php echo admin_url('home/delete_record')?>",async: true,data: "id="+id+"&delete_record="+change_status, success: function(data)
			{	
				if(data!=0)
				{
					$("#row_id_"+id).html('<td colspan="7" style="text-align:center;color:red">Record Deleted</td>');
					
					$("#row_id_"+id).delay(800).fadeOut('slow');
					//$("#row_id_"+id).remove();
				}
				else
					alert("Error");
			}
		  });
}

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
    <form action="" name="managepage" method="post">
    <table class="page_table" cellpadding="2" cellspacing="0" width="100%">
    	<tr>
        <th></th>
        <th><?php echo $this->lang->line('Sl.No'); ?></th>
        <th><?php echo $this->lang->line('page_title'); ?></th>
        <th><?php echo $this->lang->line('page_url'); ?></th>
        <th><?php echo $this->lang->line('page_name'); ?></th>
        <th><?php echo $this->lang->line('Created'); ?></th>
        <th><?php echo $this->lang->line('action'); ?></th>
        </tr>
        <tr>
		  <td valign="middle" align="left" class="seperator" colspan="7"></td>
		</tr>
		<?php $i=1;
			if(isset($pages) and $pages->num_rows()>0)
			{  
				foreach($pages->result() as $page)
				{
		?>
		
			 <tr id="row_id_<?php echo $page->id?>">
			  <td><input type="checkbox" class="clsNoborder" name="pagelist[]" id="pagelist[]" value="<?php echo $page->id; ?>"  /> </td>
			  <td><?php echo $i++; ?></td>
			  <td><?php echo $page->page_title; ?></td>
			  <td><a href="<?php echo site_url('page').'/'.$page->url; ?>"><li class="clsMailId">/<?php echo $page->url; ?></li></a></td>
			  <td><?php echo $page->name; ?></td>
			  <td><?php echo date('Y-m-d',$page->created); ?></td>
			  <td>
			      <a href="<?php echo admin_url('page/editpage/'.$page->id)?>">
                  	<img src="<?php echo base_url()?>css/img/edit_img.jpg"/>
                  </a>&nbsp;
                  <a href="javascript:void(0)" onclick="delete_record('<?php echo $page->id?>')">
              		<img src="<?php echo base_url()?>css/img/Delete.png"/>
                  </a>
			  </td>
        	</tr>
			
        <?php
				}//Foreach End
			}//If End
			else
			{
			echo '<tr><td colspan="5">'.$this->lang->line('No Pages Found').'</td></tr>'; 
			}
		?>
		</table>
        </form>
    
	</div>
    <input type="hidden" name="table_name" id="table_name" value="page" />
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>