<?php 
$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
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
          <th>Id</th>
          <th>Name</th>
          <th>URL</th>
          <th>Logo</th>
          <th>Import</th>
          <th>Settings</th>
          <th>Status</th>
          <th>Edit</th>
          <th>Delete</th>
         </tr>
         <tr>
		  <td valign="middle" align="left" class="seperator" colspan="9"></td>
		</tr>
        <?php
			if(count($web_sites)!=0)
			{
				$status_image='';
				
				foreach($web_sites as $web_site)
				{
					if($web_site->status)
						$status_image="enable";
					else
						$status_image="disable";
					
					echo '<tr id="row_id_'.$web_site->id.'">
							<td>'.$web_site->id.'</td>
							<td>'.ucfirst($web_site->name).'</td>
							<td>'.ucfirst($web_site->url).'</td>
							<td>
								<img src="'.base_url().'uploads/web_site_logo/'.$web_site->file_name.'" style="width:205;height:30px;"/>
							</td>
							';
							if($web_site->import_option=='api' or $web_site->import_option=='rss')
							{
								
								echo '<td>
										<a href="'.admin_url("dealimporter/import/".$web_site->id).'">Import</a>
									</td>
									<td>
										<a href="'.admin_url("home/manage_import/".$web_site->id).'">
										  <img src="'.base_url().'css/img/cog.png" id="status_change_'.$web_site->id.'" />	
										</a>
									</td>';
							}
							else
								echo '<td>&nbsp;</td><td>&nbsp;</td>';
							
							echo '<td>
								<a href="javascript:void(0)"  onclick="change_status('.$web_site->id.')">
									<img src="'.base_url().'css/img/'.$status_image.'.png" id="status_change_'.$web_site->id.'" />
								</a>
							</td>
							<td>
								<a href="'.admin_url('home/edit_website/'.$web_site->id).'">
								<img src="'.base_url().'css/img/edit_img.jpg"/></a>
							</td>
							<td><a href="javascript:void(0)" onclick="delete_record('.$web_site->id.')"><img src="'.base_url().'css/img/Delete.png"/></a></td>
					     </tr>';
				}
			}
			else
			{
				echo '<tr><td colspan="6"> No Record found</td></tr>';
			}
		?>
        </table>
        <div class="pagination">
        	<?php echo $this->pagination->create_links();?>
        </div>	
        <input type="hidden" name="table_name" id="table_name" value="web_sites" />
   </div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>