<?php
class Sitemap extends CI_Controller
{
	function Sitemap()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('config_data');
		
		$this->config_data->db_config_fetch();
		
		$language_code = $this->config->item('language_code');
		
		$this->lang->load('admin/common',$language_code);
	    
		$this->lang->load('admin/validation',$language_code);
		
		
		//Load Models Common to all the functions in this controller
		$this->load->model('common_model');
		$this->load->helper('url');
		//$this->load->model('skills_model');
		$this->load->helper('auth_helper');
		$this->load->helper('date_helper');
		$this->load->helper('date_helper');
		$this->load->helper('simple_html_dom_helper');
		$this->load->library('form_validation');
		$this->load->model('settings_model');
		$this->load->library('session');
		
		
		//load model
		$this->load->model('page_model');
		
		//Check For Admin Logged in
		if(!isAdmin())
			redirect_admin('home');
           //Get Config Details From Db
	}
	function upload()
	{
		$xml_data='';
		$base_url=base_url();
		
		$len=strlen($base_url);
		
		$site_url= substr($base_url,0,($len-1));
		
		$html = file_get_html("http://www.xml-sitemaps.com/crawlproc.html?&initurl=".urlencode($site_url)."&freq=&lastmod=1&lastmodtime=".urlencode(date("Y-m-d H:i:s"))."&priority=none&submit=Start");
		
		$final_url=str_replace("http://","details-",$site_url);
		
		$final_url=str_replace("/","-",$final_url);
		
		//echo "http://www.xml-sitemaps.com/".$final_url.".html";
		
		$html_file=file_get_html("http://www.xml-sitemaps.com/".$final_url.".html");
		
		foreach($html_file->find('textarea') as $element)
		{
		   $xml_data=html_entity_decode($element->innertext);
		}
		
		$site_map_file="./sitemap.xml";
		
		if($xml_data!="")
		{
			if(file_exists($site_map_file))
			{
				//chmod($site_map_file,0777);
				
				$file=fopen($site_map_file,"w+");
				
				fwrite($file,$xml_data);
				
				//chmod($site_map_file,0664);
				
				fclose($file);
			}
		}
		
		$file=fopen($site_map_file,"r");
		
		$contents ='';
		if(filesize($site_map_file))
			$contents = fread($file, filesize($site_map_file));
		
		$data["xml_file"]=str_replace("<!-- created with Free Online Sitemap Generator www.xml-sitemaps.com -->","",$contents);
		
		$data['title']="Upload Xml File";
		
		$data['open_tab']="site_map_box";
		
		$data['cancel_url']=admin_url("home");
		
		$this->load->view("admin/site_map/upload",$data);
	}
}
?>