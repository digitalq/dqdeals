<?php
class Orders extends CI_Controller
{
	function Orders()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('config_data');
		
		$this->config_data->db_config_fetch();
		
		$this->load->helper('url');
		
		$this->load->helper('form');
		
		$this->load->helper('auth_helper');
		
		$this->load->helper('common_helper');
		
		$this->load->model('common_model');
		
		$this->load->model('homepage_model');
		
		$this->load->model('DealImport_model');
		
		$this->load->model('common_model');
		
		$this->load->model('auth_model');
				
		$this->load->library('session');
		
		$this->load->library('pagination');
		
		$this->load->helper('xml_reader_helper');
		
		if(!isAdmin())
			redirect_admin("admin");
	}
	function index()
	{
		$data["title"]="User Management";
		
		$conditions=array("status"=>1);
		
		$data["open_tab"]="manage_user_box";
		
		$data["users"]=$this->common_model->getTableData("users")->result();
		
		$this->load->view("admin/view_users",$data);
	}
}
?>