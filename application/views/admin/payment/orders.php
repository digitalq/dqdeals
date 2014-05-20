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
          <th style="width:250px;">Deal Title</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Paid</th>
          <th>User</th>
          <th>View</th>
          <th>Delete</th>
         </tr>
         <tr>
		  <td valign="middle" align="left" class="seperator" colspan="8"></td>
		</tr>
        <?php
			$group_datas=array();
			
			if(isset($payment_logs) && count($payment_logs)!=0)
			{
				$status_image='';
				
				$rotating='';
				
				$user_name=array();
				
				$paid="";
				
				foreach($payment_logs as $payment_log)
				{
						
					$deal_detail=$this->common_model->getTableData("deals",array("id"=>$payment_log->deal_id))->result();
					
					$order_detail=$this->common_model->getTableData("orders",array("id"=>$payment_log->order_id))->result();
					
					$user_name=$this->common_model->getTableData("users",array("id"=>$payment_log->user_id))->result();
					
					if($order_detail[0]->paid)
						$paid="yes";
					else
						$paid="no";
					
					if(count($order_detail)!=0)
					{
						echo '<tr id="row_id_'.$payment_log->id.'">
								<td style="width:250px;">
									<div style="width:250px;">
										<a href="'.base_url().'deal/'.$deal_detail[0]->slug.'" target="_blank">'.ucfirst($deal_detail[0]->deal_title).'</a>
									</div>
								</td>
								<td>$'.$deal_detail[0]->deal_price.'</td>
								<td>'.$order_detail[0]->quantity.'</td>
								<td>$'.$order_detail[0]->quantity * $deal_detail[0]->deal_price .'</td>
								<td>'.$paid.'</td>
								<td>'.ucfirst($user_name[0]->user_name).'</td>';
						echo '<td>
								<a href="'.admin_url('payment/view_pay_log/'.$payment_log->id).'" target="_blank">
									View
								</a>
							</td>
								<td><a href="javascript:void(0)" onclick="delete_record('.$payment_log->id.')"><img src="'.base_url().'css/img/Delete.png"/></a></td>
						 </tr>';
					}
				}
			}
			else
			{
				echo '<tr><td valign="middle" align="left" colspan="8">No Orders.</td></tr>';
			}
		?>	
   </table>
   	<input type="hidden" name="table_name" id="table_name" value="payment_log" />
	</div>
</div>
</div>
<div class="clear"></div>
<div>
</div>
<?php
$this->load->view("admin/footer");
?>