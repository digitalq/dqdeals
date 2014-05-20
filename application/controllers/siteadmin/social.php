<?php
class Social extends CI_Controller
{
	function Social()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('config_data');
		
		$this->config_data->db_config_fetch();
		
		$language_code = $this->config->item('language_code');
		
		//loads language
		
		
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
        
	}
	function index()
	{
		if(!isAdmin())
			redirect_admin('admin');
	}
	function addsocial()
	{
		if(!isAdmin())
			redirect_admin('admin');
		
		if($this->input->post("add_social_submit")=="Add")
		{
			extract($this->input->post());
			
			$insert_data=array("name"=>$social_name,"value"=>$social_url);
			
			$result=$this->common_model->insertData("social_site_settings",$insert_data);
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',$this->lang->line('added_success')));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',"Failed"));
				
			redirect_admin('social/viewsocial');
			
		}	
		
		$output=array();
		
		$output["title"]="Add social Link";
		
		$output["open_tab"]="social_link_box";
		
		$this->load->view('admin/social/addsocial',$output);
	}
	function viewsocial()
	{
		$output["title"]="social Links";
		
		$output["open_tab"]="social_link_box";
		
		$social_site_settings=$this->common_model->getTableData('social_site_settings');
		
		$output["social_datas"]=$social_site_settings->result();
		
		$this->load->view('admin/social/viewsocial',$output);
	}
	function edidsocial($id)
	{
		if($id=='' or $id==0)
			redirect("social/viewsocial");
			
		if($this->input->post("add_social_submit")=="Edit")
		{
			extract($this->input->post());
			
			$update_data=array("name"=>$social_name,"value"=>$social_url);
			
			$result=$this->common_model->updateTableData("social_site_settings",$edit_id,$update_data);
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',$this->lang->line('Update Succesfully Completed')));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',"Failed"));
				
			redirect_admin('social/viewsocial');
		}
			
		$output["title"]="social Links";
		
		$output["open_tab"]="social_link_box";
				
		$social_site_settings=$this->common_model->getTableData('social_site_settings',array("id"=>$id));
		
		$output["mode"]="edit";
		
		$social_datas=$social_site_settings->result();
		
		$output["social_datas"]=$social_datas;
		
		$output["edit_id"]=$social_datas[0]->id;
		
		$output["social_name"]=$social_datas[0]->name;
		
		$output["social_url"]=$social_datas[0]->value;
		
		$output["cancel_url"]=admin_url("social/viewsocial");
		
		$this->load->view('admin/social/addsocial',$output);
		
	}
	function managesocial()
	{
		if($this->input->post("manage_social_submit")=="Update")
		{
			if(!$this->config->item("product_mode"))
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
				redirect_admin("social/managesocial");
			}
			
			$this->form_validation->set_rules('fanbox_page_height','fanbox height numeric value','numeric');
			$this->form_validation->set_rules('fanbox_show_weight','fanbox width numeric value','numeric');
			if($this->form_validation->run())
			{	
				extract($this->input->post());
				
				$result==false;
				
				foreach($this->input->post() as $key=>$posts)
				{
					if($key!="manage_social_submit")
					{
						$updateArray=array("value"=>$posts);
						
						$result=$this->common_model->updateTableData("social_site_settings",'',$updateArray,array("name"=>$key));
					}
					//var_dump($key,$posts);
				}
				//if($result)
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Succesfully Updated'));
				/*else
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',"Failed"));*/
				
				redirect(admin_url("social/managesocial"));
			}
		}
		$output["title"]="Social Networking Setting";
		
		$output["open_tab"]="social_link_box";
		
		$social_site_settings=$this->common_model->getTableData("social_site_settings");
		
		$output["social_site_settings"]=$social_site_settings->result();
		
		$this->load->view('admin/social/managesocial',$output);
		
	}
}
?>