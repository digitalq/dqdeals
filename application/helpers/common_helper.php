<?php
function dropdown_box($table_name,$value_field,$disp_field,$where=array(),$order_by=array())
{
	$ci =& get_instance();
	
	$ci->load->model('common_model');
	
	$table_data_query=$ci->common_model->getTableData($table_name,$where,NULL,NULL,NULL,NULL,NULL,$order_by);
	
	$table_datas=$table_data_query->result();
	
	$output="";
	
	foreach($table_datas as $table_data)
	{
		$output.='<option value="'.$table_data->$value_field.'">'.ucfirst($table_data->$disp_field).'</option>';
	}
	
	return $output;
	
}
function load_footer_city()
{
	$ci =& get_instance();
	
	$ci->load->model('common_model');
	
	$city_where=array("status"=>1);
		
	$city_orderby=array("name","asc");
		
	$table_data_query=$ci->common_model->getTableData("city",$city_where,NULL,NULL,NULL,NULL,NULL,$city_orderby);
	
	$table_datas=$table_data_query->result();
	
	$output='';
	
	foreach($table_datas as $table_data)
	{
		$output.='<a href="'.base_url().'city/'.$table_data->slug.'">'.ucfirst($table_data->name).'</a>&nbsp;';
	}
	
	return $output;
}
function clen_slug($str) {
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
	
	return $clean;
}
function get_single_row($table_name,$where=array())
{
	if($table_name=='' and count($where)==0)
		return '';
		
	$ci =& get_instance();
	
	$ci->load->model('common_model');
	
		
	$table_data_query=$ci->common_model->getTableData($table_name,$where);
	
	$table_datas=$table_data_query->result();
	
	return $table_datas;
		
}

function sendMail($from,$to,$subject,$message)
{
	$ci =& get_instance();
	
	$ci->load->model('common_model');
	
	//$ci->load->config('config_data');
	
	$ci->load->library('email');
	
	$config['mailtype'] = 'html';
	
	$config['wordwrap'] = TRUE;
	
	$where=array("id"=>1);
	
	$mail_settings=$ci->common_model->getTableData("mail_settings",$where)->result();
	
	if(count($mail_settings)!=0)
	{
		if($mail_settings[0]->mailer=="smtp")
		{
			$config['protocol']    = 'smtp';
			$config['smtp_host']    = $mail_settings[0]->smtp_server;//'ssl://smtp.gmail.com';
			$config['smtp_port']    = $mail_settings[0]->smtp_port;
			$config['smtp_timeout'] = '7';
			$config['smtp_user']    = $mail_settings[0]->smtp_username;
			$config['smtp_pass']    = $mail_settings[0]->smtp_password;
			$config['charset']    = 'utf-8';
			$config['newline']    = "\r\n";
			
			if($mail_settings[0]->smtp_auth)
				$config['validation'] = TRUE; // bool whether to validate email or not
			else
				$config['validation'] = FALSE; // bool whether to validate email or not
			
		}
	}
	
	$ci->email->initialize($config);
	
	$ci->email->from($from);
	
	$ci->email->to($to);

	$ci->email->subject($subject);
	
	$ci->email->message($message);
	
	$ci->email->send();
}

function get_users_detail($field)
{
	$ci =& get_instance();
	
	$ci->load->model('user_model');
	
	$user_id=$ci->session->userdata('user_id');
	
	if($user_id!="")
	{
		$conditions=array("id"=>$user_id);
	
		$user_detail_query=$ci->user_model->getUsers($conditions);
		
		$user_detail=$user_detail_query->result();
		
		
		return $user_detail[0]->$field;
	}
}
function get_date_diff($date1, $date2) {
  $holidays = 0;
  for ($day = $date2; $day < $date1; $day += 24 * 3600) {
    $day_of_week = date('N', $day);
    if($day_of_week > 5) {
      $holidays++;
    }
  }
  return $date1 - $date2 - $holidays * 24 * 3600;
} 
function ago( $dt )
{
//$interval = date_parse('now')->diff( $datetime );
//var_dump($dt);
$dt = date_parse($dt);

$now = date_parse(date("Y-m-d h:i:s"));
 
$suffix = " ago";

$day_intreval=$now['day'] - $dt['day'];

$hour_intreval= $now['hour']  - $dt['hour'];

$minute_intreval=$now['minute'] - $dt['minute'];

$second_intreval=$now['second'] - $dt['second'];

//var_dump("(".$day_intreval.")d +".$hour_intreval."h +".$minute_intreval."m +".$second_intreval."s");
return "+(".$day_intreval.")d +".$hour_intreval."h +".$minute_intreval."m +".$second_intreval."s";

}

function ago1( $datetime )
{
    $interval = date_create('now')->diff( date_create($datetime) );

	return "(".$interval->d.")d +".$interval->h."h +".$interval->m."m +".$interval->s."s";
	
    /*if ( $v = $interval->y >= 1 ) return pluralize( $interval->y, 'year' ) . $suffix;
    if ( $v = $interval->m >= 1 ) return pluralize( $interval->m, 'month' ) . $suffix;
    if ( $v = $interval->d >= 1 ) return pluralize( $interval->d, 'day' ) . $suffix;
    if ( $v = $interval->h >= 1 ) return pluralize( $interval->h, 'hour' ) . $suffix;
    if ( $v = $interval->i >= 1 ) return pluralize( $interval->i, 'minute' ) . $suffix;
    return pluralize( $interval->s, 'second' ) . $suffix;*/
}
function get_links($deal_id)
{
	$ci =& get_instance();
	$ci->load->model('common_model');
	
	$where=array("id"=>$deal_id);
		
	$deals_details=$ci->common_model->getTableData("deals",$where)->result();
	
	$return_Url='';
	
	if(count($deals_details)!="")
	{
		$side_id=$deals_details[0]->site_id;
		
		$web_sites_array=array("id"=>$side_id);
		
		$side_detail=get_single_row("web_sites",$web_sites_array);
		
		if($side_detail[0]->affliates_option=="cj")
		{
			$aff_url=$side_detail[0]->affliates_value;
			
			if(stristr($aff_url,"(deal_id)"))
			{
				$return_Url=str_replace("(deal_id)",$deals_details[0]->deal_id,$aff_url);
				
				return $return_Url;
			}
			elseif(stristr($aff_url,"(deal_url)"))
			{
				$return_Url=str_replace("(deal_url)",$deals_details[0]->deal_link,$aff_url);
				
				return $return_Url;
			}
			
		}
	}
	
}
function fan_box()
{
	$ci =& get_instance();
	$ci->load->model('common_model');
	
	$fanbox_detail_fields=array("fanbox_href","fanbox_show_faces","fanbox_height","fanbox_width","fanbox_stream");
	
	$fanbox_details=$ci->common_model->getTableData("social_site_settings")->result();
	
	$src_param=array();
	
	foreach($fanbox_details as $fanbox_detail)
	{
		if(in_array($fanbox_detail->name,$fanbox_detail_fields))
		{
			$src_param[]=str_replace("fanbox_","",$fanbox_detail->name)."=".$fanbox_detail->value;
		}
	}
	
	$parms=implode("&",$src_param);
		//href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FCogzidel-Redical-Deals%2F207826559278176&amp;width=194&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=true&amp;height=290
	
	$fan_box='<iframe src="http://www.facebook.com/plugins/likebox.php?'.urldecode($parms).'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:194px; height:290px;" allowTransparency="true"></iframe>';
	
	return $fan_box;
	
}
function genRandomString() 
{
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = "";    

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }
    return $string;
}
function translate_admin($val)
{
	return $val;
}
?>