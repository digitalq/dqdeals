<?php
class Advertise extends CI_Controller
{
	function Advertise()
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
		$this->load->library('form_validation');
		$this->load->model('settings_model');
		$this->load->library('session');
		
		//load model
		$this->load->model('page_model');
		
		//Check For Admin Logged in
		if(!isAdmin())
			redirect_admin('admin');
           //Get Config Details From Db
	}
	function index(){
		
	}
	function addgroup()
	{
		if($this->input->post("addgroup_submit")=="Add")
		{
			extract($this->input->post());
			
			$insert_array=array("group_name"=>$group_name,"width"=>$width,"height"=>$height,"rotating"=>$rotating);
			
			$result=$this->common_model->insertData("ad_group",$insert_array);
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Record inserted Successfully'));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Record Not inserted Successfully'));	
				
			redirect_admin('advertise/viewgroups');
			
		}
		$data['title']="Add Group";
		
		$data['open_tab']="advertice_box";
		
		$data['cancel_url']=admin_url("advertise/viewgroup");
		
		$this->load->view("admin/advertise/addgroup",$data);
	}
	
	function viewgroups()
	{
		//advertise/addgroup
		$data['title']="Add Group";
		
		$data['open_tab']="advertice_box";
		
		$group_query=$this->common_model->getTableData("ad_group");
		
		$groups=$group_query->result();
		
		$data['groups']=$groups;
		
		$this->load->view("admin/advertise/viewgroups",$data);
	}
	function editgroup($id)
	{
		if($id==0 or $id=='')
			redirect_admin('advertise/viewgroups');
		
		if($this->input->post("addgroup_submit")=="Update")
		{
			extract($this->input->post());
			
			$insert_array=array("group_name"=>$group_name,"width"=>$width,"height"=>$height,"rotating"=>$rotating);
			
			$result=$this->common_model->updateTableData("ad_group",$edit_id,$insert_array);
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Record updated Successfully'));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Record Not inserted Successfully'));	
				
			redirect_admin('advertise/viewgroups');
			
		}
			
		$data['title']="Edit Group";
		
		$data['open_tab']="advertice_box";
		
		$group_query=$this->common_model->getTableData("ad_group",array("id"=>$id));
		
		$groups=$group_query->result();
		
		$data['groups']=$groups;
		
		$this->load->view("admin/advertise/addgroup",$data);
	}
	function addbanner()
	{
		if($this->input->post("addbanner_submit")=="Add")
		{
			extract($this->input->post());
			
			$insert_array=array("group_id"=>$group_id,"bannername"=>$banner_name,"code"=>$code);
			
			$result=$this->common_model->insertData("ad_banner",$insert_array);
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Record inserted Successfully'));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Record Not inserted Successfully'));	
				
			redirect_admin('advertise/viewbanner');
			
		}
		
		$data['title']="View Group";
		
		$data['open_tab']="advertice_box";
		
		$data['cancel_url']=admin_url("advertise/viewbanner");
		
		$group_query=$this->common_model->getTableData("ad_group",array("status"=>1));
		
		$groups=$group_query->result();
		$group_datas=array();
		
		$group_datas['']="Select";
		
		foreach($groups as $group)
			$group_datas[$group->id]=$group->group_name;
		
		$data['group_datas']=$group_datas;
		
		
		$this->load->view("admin/advertise/addbanner",$data);
	}
	
	function viewbanner()
	{
		$data['title']="Banners";
		
		$data['open_tab']="advertice_box";
		
		$banner_query=$this->common_model->getTableData("ad_banner");
		
		$banners=$banner_query->result();
		
		$data['banners']=$banners;
		
		$this->load->view("admin/advertise/viewbanner",$data);
	}
	function editbanner($id)
	{
		if($id==0 or $id=='')
			redirect_admin('advertise/viewbanner');
		
		if($this->input->post("addbanner_submit")=="Update")
		{
			extract($this->input->post());
			
			$update_array=array("group_id"=>$group_id,"bannername"=>$banner_name,"code"=>$code);
			
			$result=$this->common_model->updateTableData("ad_banner",$edit_id,$update_array);
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Record updated Successfully'));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Record Not inserted Successfully'));	
				
			redirect_admin('advertise/viewbanner');
			
		}
			
		$data['title']="Edit Banner";
		
		$data['open_tab']="advertice_box";
		
		$banner_query=$this->common_model->getTableData("ad_banner",array("id"=>$id));
		
		$banners=$banner_query->result();
		
		$data['banners']=$banners;
		
		$group_query=$this->common_model->getTableData("ad_group");
		
		$groups=$group_query->result();
		$group_datas=array();
		
		$group_datas['']="Select";
		
		foreach($groups as $group)
			$group_datas[$group->id]=$group->group_name;
		
		$data['group_datas']=$group_datas;
		
		$this->load->view("admin/advertise/addbanner",$data);
	}
	function addtext()
	{
		if($this->input->post("addtext_submit")=="Add")
		{
			extract($this->input->post());
			
			$insert_array=array("text_ad_name"=>$text_ad_name,"description"=>$description,"text_ad_url"=>$text_ad_url);
			
			$result=$this->common_model->insertData("text_ad",$insert_array);
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Record inserted Successfully'));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Record Not inserted Successfully'));	
				
			redirect_admin('advertise/viewtext');
			
		}
		
		$data['title']="Add Text Advertise";
		
		$data['open_tab']="advertice_box";
		
		$data['cancel_url']=admin_url("advertise/viewgroup");
		
		$this->load->view("admin/advertise/addtext",$data);
	}
	function edit_text($id)
	{
		if($this->input->post("addtext_submit")=="Update")
		{
			extract($this->input->post());
			
			$update_array=array("text_ad_name"=>$text_ad_name,"description"=>$description,"text_ad_url"=>$text_ad_url);
			
			$result=$this->common_model->updateTableData("text_ad",$edit_id,$update_array);
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Record inserted Successfully'));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Record Not inserted Successfully'));	
				
			redirect_admin('advertise/viewtext');
			
		}
		$text_ad_query=$this->common_model->getTableData("text_ad",array("id"=>$id));
		
		$text_ads=$text_ad_query->result();
		
		$data['text_ads']=$text_ads;
		
		$data['title']="Edit Text Advertise";
		
		$data['open_tab']="advertice_box";
		
		$data['cancel_url']=admin_url("advertise/viewgroup");
		
		$this->load->view("admin/advertise/addtext",$data);
	}
	function viewtext()
	{
		//advertise/addgroup
		$data['title']="Text Advertise";
		
		$data['open_tab']="advertice_box";
		
		$text_ad_query=$this->common_model->getTableData("text_ad");
		
		$text_ads=$text_ad_query->result();
		
		$data['text_ads']=$text_ads;
		
		$this->load->view("admin/advertise/viewtext",$data);
	}
	function viewmedia()
	{
		//advertise/addgroup
		$data['title']="Media Banner";
		
		$data['open_tab']="advertice_box";
		
		$media_ad_query=$this->common_model->getTableData("media_ad");
		
		$media_ads=$media_ad_query->result();
		
		//var_dump($media_ads);
		
		$data['media_ads']=$media_ads;
		
		$this->load->view("admin/advertise/viewmedia",$data);
	}
	
	function addmedia()
	{
		if($this->input->post("ad_media_submit")=="Add")
		{
			extract($this->input->post());
			
			$config['upload_path'] = './uploads/ads/';
			
			$config['allowed_types'] = 'jpg|swf|flv';
			
			$this->load->library('upload', $config);
			
			$insert_array=array();
			
			$file_name="";
			
			if($_FILES["media_file"]["name"]!="")
			{
				if (!$this->upload->do_upload("media_file"))
				{
					$error = array('error' => $this->upload->display_errors());
					
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',$error["error"]));
					
					redirect_admin("advertise/addmedia/");
				}
				else
				{
					$upload_data = array('upload_data' => $this->upload->data());
				}
				
				if(count($upload_data!=0))
					$file_name=$upload_data["upload_data"]["file_name"];
			}
			
			$insert_array=array("media_name"=>$media_name,"description"=>$description,"media_ad_url"=>$media_ad_url,"media_file"=>$file_name,"media_duration"=>$media_duration);
			
			
			$result=$this->common_model->insertData("media_ad",$insert_array);
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Record inserted Successfully'));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Record Not inserted Successfully'));	
				
			redirect_admin('advertise/viewmedia');
			
		}
		
		$data['title']="Add Text Advertise";
		
		$data['open_tab']="advertice_box";
		
		$data['cancel_url']=admin_url("advertise/viewmedia");
		
		$this->load->view("admin/advertise/addmedia",$data);
	}
	
	function edit_media($id)
	{
		if($this->input->post("ad_media_submit")=="Update")
		{
			extract($this->input->post());
			
			$config['upload_path'] = './uploads/ads/';
			
			$config["max_size"] = '200';
			
			$config['allowed_types'] = 'jpg|swf|flv';
			
			$this->load->library('upload', $config);
			
			$insert_array=array();
			
			$file_name="";
			
			if($_FILES["media_file"]["name"]!="")
			{
				if (!$this->upload->do_upload("media_file"))
				{
					$error = array('error' => $this->upload->display_errors());
					
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',$error["error"]));
					
					redirect_admin("advertise/edit_media/".$edit_id);
				}
				else
				{
					unlink($config['upload_path'].$edit_file_name);
					$upload_data = array('upload_data' => $this->upload->data());
				}
				
				if(count($upload_data!=0))
					$file_name=$upload_data["upload_data"]["file_name"];
			}
			
			$update_array=array("media_name"=>$media_name,"description"=>$description,"media_ad_url"=>$media_ad_url,"media_file"=>$file_name,"media_duration"=>$media_duration);
			
			$result=$this->common_model->updateTableData("media_ad",$edit_id,$update_array);
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Record Updated Successfully'));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Record Not Updated Successfully'));	
				
			redirect_admin('advertise/viewmedia');
			
		}
		$media_ad_query=$this->common_model->getTableData("media_ad",array("id"=>$id));
		
		$media_ads=$media_ad_query->result();
		
		$data['media_ads']=$media_ads;
		
		$data['title']="Edit Media Advertise";
		
		$data['open_tab']="advertice_box";
		
		$data['cancel_url']=admin_url("advertise/viewmedia");
		
		$this->load->view("admin/advertise/addmedia",$data);
	}
	
}
?>