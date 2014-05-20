<?php
	$this->load->view("header");
	$time_zone=$this->config->item("site_time_zone");
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#change_password_form").validate({errorElement:"p",errorClass:"Frm_Error_Msg",focusInvalid: false})
}) 
</script>
<style type="text/css">
.clsLoging_Form
{
	margin-left:20px;
}
</style>
<div class="clsFloatLeft" id="Main_left">
	<div class="inner_pages">
    	<h1 class="Main_Tittle"><span><?php echo $title?></span></h1>
        <?php
			$this->load->view("user_tabs",array("select_tab"=>"my_coupon"));
		?>
        <br />
         <div class="clsInput_Bg1">
            <div class="inner_content">
            	<?php
					if($msg = $this->session->flashdata('flash_message'))
					{
						echo "<div>".$msg."</div>";
					}
				?>
            	<table cellspacing="0" cellpadding="0" border="0" class="groupon_table">
                  <tbody><tr>
                    <th width="120">
                      <div class="td_pad">
                        <span>Image</span>
                      </div>
                    </th>
                    <th width="300">
                      <div class="td_pad">
                        Name
                      </div>
                    </th>
                    <th width="110">
                      <div class="desc td_pad">
                        Purchase Date
                      </div>
                    </th>
                    <th width="110">
                      <div class="td_pad">
                        	Expiration Date
                      </div>
                    </th>
                    <th>
                      <div class="td_pad">
                        Used
                      </div>
                    </th>
                  </tr>
                  <?php
				  	
				  	if(count($coupon_details)!=0)
					{
						$deal_detail=array();
						
						$order_detail=array();
						$output='';
						
						$used="";
						
				  		foreach($coupon_details as $coupon_detail)
						{
							if($coupon_detail->status)
								$used="No";
							else
								$used="Yes";
							$deal_detail=get_single_row("deals",array("id"=>$coupon_detail->deals_id));
							
							$order_detail=get_single_row("orders",array("id"=>$coupon_detail->order_id));
							
							$output.='<tr><td>';
							
							if(isset($deal_detail[0]->deal_image_url))
								$output.='<img src="'.base_url().'uploads/deals/'.$deal_detail[0]->deal_image_url.'" style="width:100px;">';
							
							$output.='</td><td>';
							
							if(isset($deal_detail[0]->deal_title))
								$output.=anchor("home/view_voucher/".$coupon_detail->secret,$deal_detail[0]->deal_title,array("target"=>"_blank"));
								
							$output.='</td><td>';
							
							if(isset($coupon_detail->create_time))
								$output.=date('Y/m/d', gmt_to_local($coupon_detail->create_time,$time_zone,TRUE));
								
							$output.='</td><td>';
							
							if(isset($coupon_detail->expire_time))
								$output.=date('Y/m/d', gmt_to_local($coupon_detail->expire_time,$time_zone,TRUE));
								
							$output.='</td><td>'.$used;
							
							$output.='</td></tr>';
							
							
							
						}
						echo $output;
					}
					else
					{
						echo "<tr><td colspan='4'><h2>No Coupons</h2></td></tr>";
					}
				  ?>
                </tbody></table>
            </div>
        </div>
   </div>
</div>
<?php
$this->load->view("right_side_bar");
?>    
<?php
	$this->load->view("footer");
?>
