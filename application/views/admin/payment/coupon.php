<?php 
	$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	show_tabs('<?php echo $open_tab?>');
})
</script>
<style type="text/css">
textarea.form_input
{
	height:150px;
	width:100%;
}
th
{
	text-align:left;
}
</style>
<?php $this->load->view("admin/thesidebar");
	$time_zone=$this->config->item("site_time_zone");
?>
<div id="dashboardwrap">
	<div id="dashboard" class="box new">
	<div id="dashboard-top">
    	<h2><?php if(isset($title)) echo ucfirst($title)?></h2><br />
    </div>
    <div id="dashboard-body">
         <table cellpadding="0" cellspacing="0" border="0" width="100%" class="table_view">
        <tbody><tr>
        <?php
        /*<th width="120">
          <div class="td_pad">
            <span>Image</span>
          </div>
        </th>*/
		?>
        <th>
          <div class="td_pad">
            Name
          </div>
        </th>
        <th>
        	  Purchase Date
        </th>
        <th>
          <div class="desc td_pad">
        	  Purchased User
          </div>
        </th>
        <th>
          <div class="td_pad">
                Expiration Date
          </div>
        </th>
        <th>
        	Used
        </th>
        <th>
        	Delete
        </th>
        </tr>
        <tr>
		  <td valign="middle" align="left" class="seperator" colspan="8"></td>
		</tr>
        <?php
        
        if(count($coupon_details)!=0)
        {
            $deal_detail=array();
            
            $order_detail=array();
            $output='';
            foreach($coupon_details as $coupon_detail)
            {
				if($coupon_detail->status)
						$status_image="enable";
					else
						$status_image="disable";
						
                $deal_detail=get_single_row("deals",array("id"=>$coupon_detail->deals_id));
                
                $order_detail=get_single_row("orders",array("id"=>$coupon_detail->order_id));
				
				$user_detail=get_single_row("users",array("id"=>$coupon_detail->user_id));
                
                /*$output.='<tr><td>';
                
                if(isset($deal_detail[0]->deal_image_url))
                    $output.='<img src="'.base_url().'uploads/deals/'.$deal_detail[0]->deal_image_url.'" style="width:100px;">';
				*/
                
                $output.='<td>';
                
                if(isset($deal_detail[0]->deal_title))
                    $output.=anchor("deal/".$deal_detail[0]->slug,$deal_detail[0]->deal_title,array("target"=>"_blank"));
                    
                $output.='</td><td>';
                
                if(isset($coupon_detail->create_time))
                    $output.=date('Y/m/d', gmt_to_local($coupon_detail->create_time,$time_zone,TRUE));
                    
                $output.='</td><td>';
                
				if(count($user_detail)!=0)
					$output.=$user_detail[0]->user_name;
				
				$output.='</td><td>';
				
				if(isset($coupon_detail->expire_time))
                    $output.=date('Y/m/d', gmt_to_local($coupon_detail->expire_time,$time_zone,TRUE));
                    
                $output.='</td>
							<td><a href="javascript:void(0)"  onclick="change_status('.$coupon_detail->id.')"><img src="'.base_url().'css/img/'.$status_image.'.png" id="status_change_'.$coupon_detail->id.'" /></a></td>
							<td><a href="javascript:void(0)" onclick="delete_record('.$coupon_detail->id.')"><img src="'.base_url().'css/img/Delete.png"/></a></td>
						</tr>';
                
            }
            echo $output;
        }
        ?>
        </tbody></table>
          <input type="hidden" name="table_name" id="table_name" value="coupon" />
</div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>