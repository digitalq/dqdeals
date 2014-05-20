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
          <th>Gateway</th>
          <th>Order</th>
          <th>User</th>
          <th>Created</th>
          <th>View</th>
          <th>Delete</th>
         </tr>
         <tr>
		  <td valign="middle" align="left" class="seperator" colspan="6"></td>
		</tr>
        <?php
			$group_datas=array();
			
			if(isset($payment_logs) && count($payment_logs)!=0)
			{
				$status_image='';
				
				$rotating='';
				
				$user_name=array();
				
				foreach($payment_logs as $payment_log)
				{
				
						
					$gateway_type=$this->common_model->getTableData("gateway_type",array("id"=>1))->result();
					
					$user_name=$this->common_model->getTableData("users",array("id"=>$payment_log->user_id))->result();
					
					echo '<tr id="row_id_'.$payment_log->id.'">
							<td>'.ucfirst($gateway_type[0]->name).'</td>
							<td>#'.$payment_log->order_id.'</td>
							<td>'.ucfirst($user_name[0]->user_name).'</td>
							<td>'.date("m/d/Y",strtotime($payment_log->date_of_insert)).'</td>';
					echo '<!--<td>
						<a href="javascript:void(0)"  onclick="change_status('.$payment_log->id.')">
							<img src="'.base_url().'css/img/'.$status_image.'.png" id="status_change_'.$payment_log->id.'" />
						</a>
					</td>-->
					<td>
						<a href="'.admin_url('payment/view_pay_log/'.$payment_log->id).'">
							View
						</a>
					</td>
					<td><a href="javascript:void(0)" onclick="delete_record('.$payment_log->id.')"><img src="'.base_url().'css/img/Delete.png"/></a></td>
				 </tr>';
				}
			}
			else
			{
				echo '<tr><td valign="middle" align="left" colspan="6">No gateway logs found.</td></tr>';
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