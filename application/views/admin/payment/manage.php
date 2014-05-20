<?php 
$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#add_social_form").validate({errorElement:"div"});
	
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
          <th>Name</th>
          <th>Gateway</th>
          <th>Created</th>
          <th>Status</th>
          <th>Edit</th>
          <th>Delete</th>
         </tr>
         <tr>
		  <td valign="middle" align="left" class="seperator" colspan="6"></td>
		</tr>
        <?php
			$group_datas=array();
			
			if(isset($payment_gateways) && count($payment_gateways)!=0)
			{
				$status_image='';
				$rotating='';
				
				foreach($payment_gateways as $payment_gateway)
				{
					if($payment_gateway->status)
						$status_image="enable";
					else
						$status_image="disable";
						
					$gateway_type=$this->common_model->getTableData("gateway_type",array("id"=>$payment_gateway->gateway_type))->result();
					
					echo '<tr id="row_id_'.$payment_gateway->id.'">
							<td>'.ucfirst($payment_gateway->name).'</td>
							<td>'.ucfirst($gateway_type[0]->name).'</td>
							<td>'.date("m/d/Y",strtotime($payment_gateway->postes_date)).'</td>';
					echo '<td>
						<a href="javascript:void(0)"  onclick="change_status('.$payment_gateway->id.')">
							<img src="'.base_url().'css/img/'.$status_image.'.png" id="status_change_'.$payment_gateway->id.'" />
						</a>
					</td>
					<td>
						<a href="'.admin_url('payment/pay_gateway_edit/'.$payment_gateway->id).'">
						<img src="'.base_url().'css/img/edit_img.jpg"/></a>
					</td>
					<td><a href="javascript:void(0)" onclick="delete_record('.$payment_gateway->id.')"><img src="'.base_url().'css/img/Delete.png"/></a></td>
				 </tr>';
				}
			}
			else
			{
				echo '<tr><td valign="middle" align="left" colspan="6">No Bannrs</td></tr>';
			}
		?>	
   </table>
   	<input type="hidden" name="table_name" id="table_name" value="payment_gateways" />
	</div>
</div>
</div>
<div class="clear"></div>
<div>
</div>
<?php
$this->load->view("admin/footer");
?>