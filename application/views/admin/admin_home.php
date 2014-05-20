<?php 
$this->load->view("admin/header");	
?>
<?php $this->load->view("admin/thesidebar");?>
<div id="dashboardwrap">
	<div id="dashboard" class="box new">
	<div id="dashboard-top">
    	<h2><?php if(isset($title)) if(isset($title)) echo ucfirst($title)?></h2><br />
    </div>
    <div id="dashboard-body">
		<?php 
            if($msg = $this->session->flashdata('flash_message'))
            {
                    echo "<div>".$msg."</div>";
            }
        echo $content;
		?>
        <br />
        <br />
        <?php
			if(isset($no_of_active_user))
			{
		?>
        
        <div class="clsAdmin_Down clearfix">
        	<p class="clearfix">
                <span class="clearfix">
                	 <img align="absmiddle" src="<?php echo base_url()?>images/Gears-icon.png"/>
                      <a href="<?php echo admin_url('siteSettings')?>">Settings</a>
                </span>
           	</p>
            <div style="clear:both"></div>
        </div>
        <h2 style="color: #478FB3; margin:10px 0;">Site Statistics</h2>
        
       
        
		<table cellpadding="3" cellspacing="3" width="100%" class="dash_board_tab">
            <tr>
                <th>Active Users</th>
                <th>Inactive users</th>
                <th>Total Deals</th>
                <th>Orders</th>
                <th>Subscribers</th>
                <!--<th>View</th>-->
            </tr>
            <tr>
                <td><?php echo anchor('siteadmin/users',$no_of_active_user)?></td>
                <td><?php echo anchor('siteadmin/users',$no_of_inactive_user)?></td>
                <td><?php echo anchor('siteadmin/deals/view',$no_of_deals)?></td>
                <td><?php echo anchor('siteadmin/payment/orders',$no_of_orders)?></td>
                <td><?php echo anchor('siteadmin/user/view_subscribers',$no_of_subscribers)?></td>
	        </tr>
        </table>
        <?php
		}
		?>
   </div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>