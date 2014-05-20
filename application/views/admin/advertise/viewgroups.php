<?php 
$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#add_social_form").validate({errorElement:"div"});
	
	show_tabs('<?php echo $open_tab?>');
})
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
					$("#row_id_"+id).html('<td colspan="9" style="text-align:center;color:red">Record Deleted</td>');
					
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
    <table cellpadding="0" cellspacing="0" border="0" width="100%" class="table_view">
         <tr class="table_header">
          <th>Name</th>
          <th>Size</th>
          <th>Rotate</th>
          <th>Edit</th>
          <th>Status</th>
          <th>Delete</th>
         </tr>
         <tr>
		  <td valign="middle" align="left" class="seperator" colspan="9"></td>
		</tr>
        <?php
			if(isset($groups) && count($groups)!=0)
			{
				$status_image='';
				$rotating='';
				foreach($groups as $group)
				{
					if($group->status)
						$status_image="enable";
					else
						$group="disable";
						
					if($group->rotating)
						$rotating='yes';
					else
						$rotating='no';
					
					echo '<tr id="row_id_'.$group->id.'">
							<td>'.ucfirst($group->group_name).'</td>
							<td>'.$group->width." x ".$group->height.'</td>
							<td>'.ucfirst($rotating).'</td>';
					echo '<td>
						<a href="javascript:void(0)"  onclick="change_status('.$group->id.')">
							<img src="'.base_url().'css/img/'.$status_image.'.png" id="status_change_'.$group->id.'" />
						</a>
					</td>
					<td>
						<a href="'.admin_url('advertise/editgroup/'.$group->id).'">
						<img src="'.base_url().'css/img/edit_img.jpg"/></a>
					</td>
					<td><a href="javascript:void(0)" onclick="delete_record('.$group->id.')"><img src="'.base_url().'css/img/Delete.png"/></a></td>
				 </tr>';
				}
			}
		?>	
   </table>
   	<input type="hidden" name="table_name" id="table_name" value="ad_group" />
	</div>
</div>
</div>
<div class="clear"></div>
<div>
</div>
<?php
$this->load->view("admin/footer");
?>