<?php 
$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	show_tabs('<?php echo $open_tab?>');
})
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
		//var_dump($this->session->flashdata('flash_message'));
		if($msg = $this->session->flashdata('flash_message'))
		{
			echo "<div>".$msg."</div>";
		}
		
		$email_fre_type=array("No","Yes")
			
    ?>
    	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table_view">
         <tr class="table_header">
          <th>Company name</th>
          <th>Email</th>
          <th>Site Url</th>
          <th>Status</th>
          <th>Edit</th>
          <th>Delete</th>
         </tr>
         <tr>
		  <td valign="middle" align="left" class="seperator" colspan="6"></td>
		</tr>
        <?php
			
			if(count($merchants)!=0)
			{
				$status_image='';
				$mail_freq='';	
				$where=array();
				$city_name='';
				$user_city='';
				foreach($merchants as $merchant)
				{
					if($merchant->status)
						$status_image="enable";
					else
						$status_image="disable";
					
					echo '<tr id="row_id_'.$merchant->id.'">
							<td>'.$merchant->company_name.'</td>
							<td>'.$merchant->email.'</td>
							<td><a href="'.$merchant->site_url.'" target="_new">'.$merchant->company_name.'</a></td>';
					echo '  <td>
						     <a href="javascript:void(0)"  onclick="change_status('.$merchant->id.')">
							 <img src="'.base_url().'css/img/'.$status_image.'.png" id="status_change_'.$merchant->id.'" />
							</a>
							</td>
							<td>
								<a href="'.admin_url("merchant/edit/".$merchant->id).'">
								<img src="'.base_url().'css/img/edit_img.jpg"/></a>
							</td>
							<td><a href="javascript:void(0)" onclick="delete_record('.$merchant->id.')"><img src="'.base_url().'css/img/Delete.png"/></a></td>
				 		 </tr>';
				}
			}
			else
			{
				echo '<tr><td colspan="6"> No Record found</td></tr>';
			}
		?>
        </table>
        <input type="hidden" name="table_name" id="table_name" value="users" />
   </div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>