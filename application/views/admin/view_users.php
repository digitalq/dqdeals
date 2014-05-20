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
		
		$email_fre_type=array("No","Yes")
			
    ?>
    	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table_view">
         <tr class="table_header">
          <th>Email</th>
          <th>City</th>
          <th>Email Frequency</th>
          <th>Status</th>
          <th>Edit</th>
          <th>Delete</th>
         </tr>
         <tr>
		  <td valign="middle" align="left" class="seperator" colspan="6"></td>
		</tr>
        <?php
			
			if(count($users)!=0)
			{
				$status_image='';
				$mail_freq='';	
				$where=array();
				$city_name='';
				$user_city='';
				foreach($users as $user)
				{
					if($user->status)
						$status_image="enable";
					else
						$status_image="disable";
					if(isset($email_fre_type[$user->email_frequency]))
						$mail_freq=$email_fre_type[$user->email_frequency];
					else
						$mail_freq="Nil";
					
					if($user->city!="")
					{
						$where=array("id"=>$user->city);
						$city_name=get_single_row("city",$where);
						if(count($city_name)!=0)
							$user_city=$city_name[0]->name;
						else
							$user_city='Nil';
					}
					else
						$user_city='';
					
					
					echo '<tr id="row_id_'.$user->id.'">
							<td>'.$user->email.'</td>
							<td>'.ucfirst($user_city).'</td>
							<td>'.ucfirst($mail_freq).'</td>';
					echo '  <td>
						     <a href="javascript:void(0)"  onclick="change_status('.$user->id.')">
							 <img src="'.base_url().'css/img/'.$status_image.'.png" id="status_change_'.$user->id.'" />
							</a>
							</td>
							<td>
								<a href="'.admin_url("users/edit_user/".$user->id).'">
								<img src="'.base_url().'css/img/edit_img.jpg"/></a>
							</td>
							<td><a href="javascript:void(0)" onclick="delete_record('.$user->id.')"><img src="'.base_url().'css/img/Delete.png"/></a></td>
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