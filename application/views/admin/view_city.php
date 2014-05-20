<?php 
$this->load->view("admin/header");	
?>
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
    	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table_view">
         <tr class="table_header">
          <th>City</th>
          <th>Country</th>
          <th>Status</th>
          <th>Edit</th>
          <th>Delete</th>
         </tr>
         <tr>
		  <td valign="middle" align="left" class="seperator" colspan="7"></td>
		</tr>
        <?php
			$country_details="";
			
			$country_data=array();
			
			if(count($cities)!=0)
			{
				$status_image='';
				
				foreach($cities as $city)
				{
					if($city->status)
						$status_image="enable";
					else
						$status_image="disable";
					
					$country_details=$this->common_model->get_one_value_by_id($city->country,"country");
					
					$country_data=$country_details->result();
					
					echo '<tr id="row_id_'.$city->id.'">
							<td>'.ucfirst($city->name).'</td>
							<td>'.ucfirst($country_data[0]->name).'</td>
							<td>
								<a href="javascript:void(0)"  onclick="change_status('.$city->id.')">
									<img src="'.base_url().'css/img/'.$status_image.'.png" id="status_change_'.$city->id.'"/>
								</a>
							</td>
							<td>
								<a href="'.admin_url('home/edit_city/'.$city->id).'">
								<img src="'.base_url().'css/img/edit_img.jpg"/></a>
							</td>
							<td><a href="javascript:void(0)" onclick="delete_record('.$city->id.')"><img src="'.base_url().'css/img/Delete.png"/></a></td>
					     </tr>';
				}
			}
			else
			{
				echo '<tr><td colspan="6"> No Records found</td></tr>';
			}			
		?>
        </table>
        <div class="pagination">
        	<?php echo $this->pagination->create_links();?>
        </div>
        <input type="hidden" name="table_name" id="table_name" value="city" />
   </div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>