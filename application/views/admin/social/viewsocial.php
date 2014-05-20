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
<style type="text/css">
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
    <table cellpadding="0" cellspacing="0" border="0" width="100%" class="table_view">
         <tr class="table_header">
          <th>Name</th>
          <th>URL</th>
          <th>Status</th>
          <th>Edit</th>
          <th>Delete</th>
         </tr>
         <tr>
		  <td valign="middle" align="left" class="seperator" colspan="9"></td>
		</tr>
        <?php
			if(isset($social_datas) && count($social_datas)!=0)
			{
				$status_image='';
				
				foreach($social_datas as $social_data)
				{
					if($social_data->status)
						$status_image="enable";
					else
						$status_image="disable";
						
					echo '<tr id="row_id_'.$social_data->id.'">
							<td>'.ucfirst($social_data->name).'</td>
							<td>'.ucfirst($social_data->value).'</td>';
					echo '<td>
						<a href="javascript:void(0)"  onclick="change_status('.$social_data->id.')">
							<img src="'.base_url().'css/img/'.$status_image.'.png" id="status_change_'.$social_data->id.'" />
						</a>
					</td>
					<td>
						<a href="'.admin_url('social/edidsocial/'.$social_data->id).'">
						<img src="'.base_url().'css/img/edit_img.jpg"/></a>
					</td>
					<td><a href="javascript:void(0)" onclick="delete_record('.$social_data->id.')"><img src="'.base_url().'css/img/Delete.png"/></a></td>
				 </tr>';
				}
			}
		?>	
   </table>
   	<input type="hidden" name="table_name" id="table_name" value="social_site_settings" />
	</div>
</div>
</div>
<div class="clear"></div>
<div>
</div>
<?php
$this->load->view("admin/footer");
?>