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
    	<div align="right"><a href="<?php echo admin_url('home/add_sub_category/'.$category_id)?>">New Sub category</a></div><br />
    <?php 
            if($msg = $this->session->flashdata('flash_message'))
                {
                    echo "<div>".$msg."</div>";
                }
    ?>
    	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table_view">
         <tr class="table_header">
          <th>Name</th>
          <th>Parent</th>
          <th>Status</th>
          <th>Edit</th>
          <th>Delete</th>
         </tr>
         <tr>
		  <td valign="middle" align="left" class="seperator" colspan="6"></td>
		</tr>
        <?php
			$category_details="";
			
			$category_data=array();
			
			if(count($sub_categories)!=0)
			{
				$status_image='';
				
				foreach($sub_categories as $sub_category)
				{
					if($sub_category->status)
						$status_image="enable";
					else
						$status_image="disable";
					
					$category_details=$this->common_model->get_one_value_by_id($sub_category->parent_id,"category");
					
					$category_data=$category_details->result();
					
					echo '<tr id="row_id_'.$sub_category->id.'">
							<td>'.ucfirst($sub_category->name).'</td>
							<td>'.ucfirst($category_data[0]->name).'</td>
							<td>
								<a href="javascript:void(0)"  onclick="change_status('.$sub_category->id.')">
									<img src="'.base_url().'css/img/'.$status_image.'.png" id="status_change_'.$sub_category->id.'"/>
								</a>
							</td>
							<td>
								<a href="'.admin_url('home/edit_sub_category/'.$sub_category->id).'">
								<img src="'.base_url().'css/img/edit_img.jpg"/></a>
							</td>
							<td><a href="javascript:void(0)" onclick="delete_record('.$sub_category->id.')"><img src="'.base_url().'css/img/Delete.png"/></a></td>
					     </tr>';
				}
			}
			else
			{
				echo '<tr><td colspan="6"> No Records found</td></tr>';
			}			
		?>
        </table>
        <div class="pagination">
        	<?php //echo $this->pagination->create_links();?>
        </div>
        <input type="hidden" name="table_name" id="table_name" value="sub_category" />
   </div>
</div>
</div>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>