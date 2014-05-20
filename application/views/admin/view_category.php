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
          <th>Name</th>
          <th>Sub Category</th>
          <th>Status</th>
          <th>Edit</th>
          <th>Delete</th>
         </tr>
         <tr>
		  <td valign="middle" align="left" class="seperator" colspan="6"></td>
		</tr>
        <?php
			if(count($categories)!=0)
			{
				$status_image='';
				
				foreach($categories as $categorie)
				{
					if($categorie->status)
						$status_image="enable";
					else
						$status_image="disable";
					
					echo '<tr id="row_id_'.$categorie->id.'">
							<td>'.ucfirst($categorie->name).'</td>
							<td>
							  <a href="'.admin_url('home/view_sub_category/'.$categorie->id).'">
							   <img src="'.base_url().'css/img/subcategory.png"/></a>
							</td>
							<td>
								<a href="javascript:void(0)" onclick="change_status('.$categorie->id.')">
									<img src="'.base_url().'css/img/'.$status_image.'.png" id="status_change_'.$categorie->id.'"/>
								</a>
							</td>
							<td>
								<a href="'.admin_url('home/edit_category/'.$categorie->id).'">
								<img src="'.base_url().'css/img/edit_img.jpg"/></a>
							</td>
							<td><a href="javascript:void(0)" onclick="delete_record('.$categorie->id.')"><img src="'.base_url().'css/img/Delete.png"/></a></td>
					     </tr>';
				}
			}
			else
			{
				echo '<tr><td colspan="6"> No Record found</td></tr>';
			}			
		?>
        </table>
        <div class="pagination">
        	<?php echo $this->pagination->create_links();?>
        </div>
        <input type="hidden" name="table_name" id="table_name" value="category" />
   </div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>