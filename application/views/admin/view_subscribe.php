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
		if($msg = $this->session->flashdata('flash_message'))
		{
			echo "<div>".$msg."</div>";
		}
		
		$email_fre_type=array("","Daily"," Twice a Week","Once a week","Never")
			
    ?>
    	 <div class="clsAdmin_Down clearfix" style="text-align:left">
        	<p>
                <span class="clearfix">
                    <img align="bottom" src="<?php echo base_url()?>images/mail_send.png"/>
                    <a href="<?php echo admin_url('mail_setting/daily_deal')?>">Run Daily Deals</a>
                </span>
            </p>
            <div style="clear:both"></div>
        </div>
        <br /> 
    	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table_view">
         <tr class="table_header">
          <th>Email</th>
          <th>City</th>
          <th>Status</th>
          <th>Delete</th>
         </tr>
         <tr>
		  <td valign="middle" align="left" class="seperator" colspan="6"></td>
		</tr>
        <?php
			
			if(count($subscribes)!=0)
			{
				$status_image='';
				$mail_freq='';	
				$where=array();
				$city_name='';
				$user_city='';
				foreach($subscribes as $subscribe)
				{
					if($subscribe->status)
						$status_image="enable";
					else
						$status_image="disable";
						
					/*if(isset($email_fre_type[$user->email_frequency]))
						$mail_freq=$email_fre_type[$user->email_frequency];
					else
						$mail_freq="Nil";*/
					
					if($subscribe->city_id!="")
					{
						$where=array("id"=>$subscribe->city_id);
						$city_name=get_single_row("city",$where);
						if(count($city_name)!=0)
							$user_city=$city_name[0]->name;
						else
							$user_city='Nil';
					}
					else
						$user_city='';
					
					
					echo '<tr id="row_id_'.$subscribe->id.'">
							<td>'.$subscribe->email.'</td>
							<td>'.ucfirst($user_city).'</td>';
					echo '  <td>
						     <a href="javascript:void(0)"  onclick="change_status('.$subscribe->id.')">
							 <img src="'.base_url().'css/img/'.$status_image.'.png" id="status_change_'.$subscribe->id.'" />
							</a>
							</td>
							<td><a href="javascript:void(0)" onclick="delete_record('.$subscribe->id.')"><img src="'.base_url().'css/img/Delete.png"/></a></td>
				 		 </tr>';
				}
			}
			else
			{
				echo '<tr><td colspan="6"> No Record found</td></tr>';
			}
		?>
        </table>
        <input type="hidden" name="table_name" id="table_name" value="subscribe" />
   </div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>