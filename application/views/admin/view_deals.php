<?php 
$this->load->view("admin/header");	
?>
<script type="text/javascript">
$(document).ready(function(){
	show_tabs('<?php echo $open_tab?>');
$("#search_link").click(function(){$("#deals_search").toggle('slow'); })

$("#deals_search_button").click(function(){$("#deals_search").toggle('slow'); })

$("#deal_deach_form").submit(function(){
	$.ajax({ type: "POST",url: "<?php echo admin_url('dealimporter/view_deal_ajax')?>",async: true,data: $("#deal_deach_form").serialize(), success: function(data)
		{
			$("#deals_list_container").html(data);
		}
	})
})

})
function change_status(id)
{
	var change_status=$("#table_name").val();
	
	var status_image='enable';
	
	var ok=confirm("Are you sure to change a status?")
		if(!ok)
			return false;
	$.ajax({ type: "POST",url: "<?php echo admin_url('home/cge_status')?>",async: true,data: "id="+id+"&change_status="+change_status, success: function(data)
			{	
				if(data==1)
					status_image="enable";
				else
					status_image="disable";
					
				$("#status_change_"+id).attr("src","<?php echo base_url().'css/img/'?>"+status_image+".png")
			}
		  });
}

function delete_record(id)
{
	var change_status=$("#table_name").val();
	
	var status_image='enable';
	
	var ok=confirm("Are you sure to Delete this record?");
		if(!ok)
			return false;
			
	$.ajax({ type: "POST",url: "<?php echo admin_url('home/delete_record')?>",async: true,data: "id="+id+"&delete_record="+change_status, success: function(data)
			{	
				if(data!=0)
				{
					$("#row_id_"+id).html('<td colspan="5" style="text-align:center;color:red">Record Deleted</td>');
					
					$("#row_id_"+id).delay(800).fadeOut('slow');
					//$("#row_id_"+id).remove();
				}
				else
					alert("Error");
			}
		  });
}
function deal_page_load(page_id)
{
	$.ajax({ type: "POST",url: "<?php echo admin_url('dealimporter/view_deal_ajax')?>",async: true,data: $("#deal_deach_form").serialize()+"&page="+page_id, success: function(data)
		{
			$("#deals_list_container").html(data);
		}
	})
}
</script>
<style type="text/css">
#wrapper
{
		margin-top: -20px;
}
#search_link
{
	float:right;
}
#dashboard-top h2
{
	float:left;
}
#deals_search
{
	display:none;
}
</style>

<?php $this->load->view("admin/thesidebar");?>
<div id="dashboardwrap">
	<div id="dashboard" class="box new">
	<div id="dashboard-top">
    	<h2><?php if(isset($title)) echo ucfirst($title)?></h2><br />
        <div id="search_link"><a href="javascript:void(0)">Search</a></div>
        <div class="clear"></div>
        <div>&nbsp;</div>
    </div>
    <div id="dashboard-body">
    <?php 
            if($msg = $this->session->flashdata('flash_message'))
                {
                    echo "<div>".$msg."</div>";
                }
    ?>
    	<div id="deals_search">
        	<h3>Deals Search</h3>
            <br />
            <form id="deal_deach_form" name="deal_deach_form" action="javascript:void(0)">
            <table width="100%">
                <tr class="table_header">
                    <th>City name</th><th>Resource</th><th>Category</th><th>&nbsp;</th><th>&nbsp;</th>
                </tr>
                 <tr>
                    <td valign="middle" align="left" colspan="5" style="padding:0px;">&nbsp;</td>
                </tr>
                <td valign="middle" align="left" class="seperator" colspan="5"></td>
                 <tr>
                    <td valign="middle" align="left" colspan="5" style="padding:0px;">&nbsp;</td>
                </tr>
                <tr>
                    <td>
	                    <?php 
							$search_deal_city_id=' id="search_deal_city"';
							if(isset($cities_drop_val))
								echo form_dropdown("search_deal_city",$cities_drop_val,'',$search_deal_city_id);
						?>
                    </td>
                    <td>
						<?php 
							$search_deal_side_id=' id="search_deal_side"';
							if(isset($websites_drop_val))
								echo form_dropdown("search_deal_side",$websites_drop_val,'',$search_deal_side_id);
						?>
                    </td>
                    <td><select id="search_deal_category" name="search_deal_category"><?php echo $category_options?></select></td>
                    <td><input type="submit" name="deals_search_submit" id="deals_search_submit" value="Search" class="formbutton"/></td>
                    <td><input type="button" name="deals_search_button" id="deals_search_button" value="cancel" class="formbutton"/></td>
                </tr>
            </table>
            </form>
            <br />
        </div>
        <div id="deals_list_container">
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table_view">
             <tr class="table_header">
              <th>&nbsp;<input type="checkbox" name="select_all" id="select_all" /></th>
              <th style="width:300px">Title</th>
              <th>Image</th>
              <th>Resource</th>
              <th>Edit</th>
              <th>Status</th>
             </tr>
            <tr>
              <td valign="middle" align="left" colspan="6" style="padding:0px;">&nbsp;</td>
            </tr>
             <tr>
              <td valign="middle" align="left" class="seperator" colspan="6"></td>
            </tr>
            <tr>
              <td valign="middle" align="left" colspan="5" style="padding:0px;">&nbsp;</td>
            </tr>
            <?php
                if(count($deals)!=0)
                {
                    $status_image='';
                    $web_site_details=array();
                    
                    foreach($deals as $deals_data)
                    {
                        if($deals_data->status)
                            $status_image="enable";
                        else
                            $status_image="disable";
                            
                        $web_site_details=$this->DealImport_model->get_dealsite_details($deals_data->site_id);
                        
                        echo '<tr id="row_id_'.$deals_data->id.'">
                                <td><input type="checkbox" id="deals_id_'.$deals_data->id.'" name="deal_ids[]" value="'.$deals_data->id.'"/></td>
                                <td style="width:300px"><a href="'.$deals_data->deal_link.'" target="_new">'.ucfirst($deals_data->deal_title).'</a></td>
                                <td>
                                    <a href="javascript:void(0)">
                                        <img src="'.base_url().'uploads/deals/'.$deals_data->deal_id.'.jpg" alt="'.$deals_data->deal_id.'" style="width:100px;height:100px"/>
                                    </a>
                                </td>
                                <td>'.$web_site_details[0]->name.'</td>
                                <td>
                                    <a href="'.admin_url("dealimporter/edit_deal/".$deals_data->id).'">
                                        <img src="'.base_url().'css/img/edit_img.jpg"/>
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"  onclick="change_status('.$deals_data->id.')">
                                        <img src="'.base_url().'css/img/'.$status_image.'.png" id="status_change_'.$deals_data->id.'"/>
                                    </a>
                                </td>
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
        	<?php if(isset($pagination_outbox)) echo $pagination_outbox;?>
        </div>	
        	<input type="hidden" name="table_name" id="table_name" value="deals" />
        <div id="control_option">
            <br />
            <div style="float:left">
                <select id="delete_status_opt" name="delete_status_opt">
                    <option value="1">Delete</option>
                </select>
            </div>
            <div style="float:left; margin-left:10px;">
                <input type="button" value="submit" class="formbutton" id="option_submit_btn" onclick="delet_all()"/>
            </div>
        	<div class="clear"></div>
		</div>
       </div>
   </div>
</div>
</div>
<script type="text/javascript">
function delet_all()
{
	var checed_val=new Array();
	$('input[name="deal_ids[]"]:checked').each(function() {
		checed_val.push($(this).val());
	});
	$.ajax({ type: "POST",url: "<?php echo admin_url('dealimporter/delete_deal_ajax')?>",async: true,data: "check_box_value="+checed_val, success: function(data)
		{
			var del_values=new Array();
			
			del_values=data.split(",");
			
			for(var i=0;i<del_values.length;i++)
			{
				$("#row_id_"+del_values[i]).remove();
			}
			
		}
	})
}
</script>
<div class="clear"></div>
<?php
$this->load->view("admin/footer");
?>