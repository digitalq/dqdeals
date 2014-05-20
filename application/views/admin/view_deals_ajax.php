<div>
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