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
					$("#row_id_"+id).html('<td colspan="5" style="text-align:center;color:red">Record Deleted</td>');
					
					$("#row_id_"+id).delay(800).fadeOut('slow');
					//$("#row_id_"+id).remove();
				}
				else
					alert("Error");
			}
		  });
}
function change_status(id)
{
	var change_status=$("#table_name").val();
	
	var status_image='enable';
	
	var ok=confirm("Are you sure to change a status?")
		if(!ok)
			return false;
	$.ajax({ type: "POST",url: "<?php echo admin_url('home/cge_status')?>",async: true,data: "id="+id+"&change_status="+change_status, success: function(data)
			{	
				if(data==1)
					status_image="enable";
				else
					status_image="disable";
					
				$("#status_change_"+id).attr("src","<?php echo base_url().'css/img/'?>"+status_image+".png")
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
        	<?php /*?><th></th><?php */?>
            <th>No</th>
            <th>Question</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <tr>
		  <td valign="middle" align="left" class="seperator" colspan="5"></td>
		</tr>
		<?php $i=1;
			if(isset($faqs) and $faqs->num_rows()>0)
			{  
				foreach($faqs->result() as $faq)
				{
		?>
		
			 <tr id="row_id_<?php echo $faq->id?>">
			 <?php /*?> <td><input type="checkbox" class="clsNoborder" name="pagelist[]" id="pagelist[]" value="<?php echo $faq->id; ?>"  /> </td><?php */?>
			  <td><?php echo $i++; ?></td>
			  <td><?php echo $faq->question; ?></td>
              <td>
              	<?php
					if($faq->status)
						$status_image="enable";
					else
						$status_image="disable";
					
					echo '<a href="javascript:void(0)"  onclick="change_status('.$faq->id.')">
							<img src="'.base_url().'css/img/'.$status_image.'.png" id="status_change_'.$faq->id.'" />
						</a>';
				?>
              </td>
			  <td>
			      <a href="<?php echo admin_url('faq/editfaq/'.$faq->id)?>">
                  	<img src="<?php echo base_url()?>css/img/edit_img.jpg"/>
                  </a>
              </td>
              <td>
                  <a href="javascript:void(0)" onclick="delete_record('<?php echo $faq->id?>')">
              		<img src="<?php echo base_url()?>css/img/Delete.png"/>
                  </a>
			  </td>
        	</tr>
			
        <?php
				}//Foreach End
			}//If End
			else
			{
			echo '<tr><td colspan="6">'.$this->lang->line('No Pages Found').'</td></tr>'; 
			}
		?>
		</table>
        </form>
    
	</div>
    <input type="hidden" name="table_name" id="table_name" value="faq" />
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>