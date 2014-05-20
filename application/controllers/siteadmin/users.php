<?php
class Users extends CI_Controller
{
	function Users()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('config_data');
		
		$this->config_data->db_config_fetch();
		
		$this->load->helper('url');
		
		$this->load->helper('form');
		
		$this->load->helper('date_helper');
		
		$this->load->helper('auth_helper');
		
		$this->load->helper('common_helper');
		
		$this->load->model('common_model');
		
		$this->load->model('auth_model');
				
		$this->load->library('session');
		
		$this->load->library('pagination');
		
		if(!isAdmin())
			redirect_admin("admin");
	}
	function index()
	{
		$data["title"]="User Management";
		$conditions=array("status"=>1);
		$data["open_tab"]="manage_user_box";
		$data["users"]=$this->common_model->getTableData("users",array("level !="=>1))->result();
		
		$this->load->view("admin/view_users",$data);
	}
	function add_user()
	{
		if($this->input->post("add_user")=="yes")
		{
			if(!$this->config->item("product_mode"))
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
				redirect_admin("users");
			}
			
			extract($this->input->post());
			
			$update_data=array();
			
			$conditions=array("email"=>$email);
		
			$user_details=$this->common_model->getTableData("users",$conditions)->result();
			
			if(count($user_details)!=0)
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Please try other email id.Its already Exsists'));
				
				redirect(admin_url("users/add_user"));	
			}
			else
			{
				$user_name=$this->common_model->create_unique_slug($first_name,"users","user_name");
				
				$insertData=array("user_name"=>$user_name,"first_name"=>$first_name,"last_name"=>$last_name,"time_zone"=>$timezones,"email"=>$email,"city"=>$city,"email_frequency"=>$email_frequency,"level"=>3);
				
				$password=rand(0,111111);
				
				if($password!="")
					$insertData["password"]=md5($password);
				
				$result=$this->common_model->insertData('users',$insertData);
			}
			if($result)
			{	
				$site_name=$this->config->item("site_title");
				
				$message="Dear Member<br><br> Pleasure to meet you and welcome to the ".$site_name."! here your <b>Account Details<b><br><br><b>Email_id : </b>".$email."<br><br><b>Password : </b>".$password;
				
				sendMail($this->config->item("site_admin_mail"),$email,"Welcome to ".$site_name,$message);
				
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','User Added Successfully'));
			}
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Error : User Not Added'));
				
			redirect(admin_url("users"));
			
		}
		$data["title"]="Add User";
		
		$data["open_tab"]="manage_user_box";
		
		$data["cancel_url"]=admin_url("users");
		
		$city_contion=array("status"=>1);
		
		$results=$this->common_model->getTableData("city",$city_contion);
		
		$cities=$results->result();
		
		$city_drop_val['']="Select";
		
		foreach($cities as $city)
		{
			$city_drop_val[$city->id]=ucfirst($city->name);
		}
		
		$data["city_drop_val"]=$city_drop_val;
		
		$this->load->view("admin/edit_user",$data);
	}
	function edit_user($id)
	{
		if($this->input->post("edit_user")=="yes")
		{
			
			if(!$this->config->item("product_mode"))
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
				redirect_admin("users");
			}
			
			extract($this->input->post());
			
			$update_data=array();
			
			$conditions=array("email"=>$email,"id !="=>$edit_id);
		
			$user_details=$this->common_model->getTableData("users",$conditions)->result();
			
			if(count($user_details)!=0)
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Please try other email id.Its already Exsists'));
				
				redirect(admin_url("users/edit_user/".$edit_id));	
			}
			else
			{
				
				$update_data=array("user_name"=>$user_name,"first_name"=>$first_name,"last_name"=>$last_name,"time_zone"=>$timezones,"email"=>$email,"city"=>$city,"email_frequency"=>$email_frequency,"level"=>3);
					
				$result=$this->common_model->updateTableData('users',$edit_id,$update_data);
			}
			if($result)
			{
				
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','User detail updated successfully'));
			}
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Error : User detail Not updated'));
				
			redirect(admin_url("users"));
			
		}
		$data["title"]="Edit User";
		
		$data["open_tab"]="manage_user_box";
		
		$data["cancel_url"]=admin_url("users");
		
		$conditions=array("id"=>$id);
		
		$user_details=$this->common_model->getTableData("users",$conditions)->result();
		
		if(count($user_details)!=0)
			$data["user_details"]=$user_details;
		else
			$data["user_details"]="not_found";	
		
		$city_contion=array("status"=>1);
		
		$results=$this->common_model->getTableData("city",$city_contion);
		
		$cities=$results->result();
		
		$city_drop_val['']="Select";
		
		foreach($cities as $city)
		{
			$city_drop_val[$city->id]=ucfirst($city->name);
		}
		
		$data["city_drop_val"]=$city_drop_val;
		
		$data["user_id"]=$id;
			
		$this->load->view("admin/edit_user",$data);
	}
	function view_subscribers()
	{
		$data["title"]="Daily Deal Subscribers";
		
		$conditions=array("status"=>1);
		
		$data["open_tab"]="manage_user_box";
		
		$data["subscribes"]=$this->common_model->getTableData("subscribe")->result();
		
		$this->load->view("admin/view_subscribe",$data);
	}
}
?>