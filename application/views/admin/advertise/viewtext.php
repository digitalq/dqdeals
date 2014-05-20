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
					$("#row_id_"+id).html('<td colspan="8" style="text-align:center;color:red">Record Deleted</td>');
					
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
          <!--<th>Description</th>-->
          <th>Url</th>
          <th>Views</th>
          <th>Clicks</th>
          <th>Status</th>
          <th>Edit</th>
          <th>Delete</th>
         </tr>
         <tr>
		  <td valign="middle" align="left" class="seperator" colspan="8"></td>
		</tr>
        <?php
			$group_datas=array();
			
			if(isset($text_ads) && count($text_ads)!=0)
			{
				$status_image='';
				$rotating='';
				
				foreach($text_ads as $text_ad)
				{
					if($text_ad->status)
						$status_image="enable";
					else
						$status_image="disable";
					
					echo '<tr id="row_id_'.$text_ad->id.'">
							<td>'.ucfirst($text_ad->text_ad_name).'</td>
							<!--<td>'.$text_ad->description.'</td>-->
							<td><div style="width:200px;"><a href="'.$text_ad->text_ad_url.'" target="_new">'.$text_ad->text_ad_url.'</a><div></td>
							<td>'.$text_ad->views.'</td>
							<td>'.$text_ad->clicks.'</td>';
					echo '<td>
						<a href="javascript:void(0)"  onclick="change_status('.$text_ad->id.')">
							<img src="'.base_url().'css/img/'.$status_image.'.png" id="status_change_'.$text_ad->id.'" />
						</a>
					</td>
					<td>
						<a href="'.admin_url('advertise/edit_text/'.$text_ad->id).'">
						<img src="'.base_url().'css/img/edit_img.jpg"/></a>
					</td>
					<td><a href="javascript:void(0)" onclick="delete_record('.$text_ad->id.')"><img src="'.base_url().'css/img/Delete.png"/></a></td>
				 </tr>';
				}
			}
			else
			{
				echo '<tr><td valign="middle" align="left" colspan="8">No Records</td></tr>';
			}
		?>	
   </table>
   	<input type="hidden" name="table_name" id="table_name" value="text_ad" />
	</div>
</div>
</div>
<div class="clear"></div>
<div>
</div>
<?php
$this->load->view("admin/footer");
?>