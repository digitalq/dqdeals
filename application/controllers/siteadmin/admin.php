<?php
class Admin extends CI_Controller 
{
	function Admin()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('config_data');
		
		$this->config_data->db_config_fetch();
		
		$this->load->helper('url');
		
		$this->load->helper('form');
		
		$this->load->helper('common_helper');
		
		$this->load->model('common_model');
		
		$this->load->model('auth_model');
		
		$this->load->model('common_model');
		
		$this->load->helper('auth_helper');
		
		$this->load->database();
		
		$this->load->library('session');  
	}
	public function index()
	{
		//echo 'Hello World!';
		$data['page_title'] = 'Admin Login | Groupon';
		
		if($this->input->post('loginAdmin'))
		{	
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			
			$conditions = array('user_name'=>$username,'password'=>$password,"level"=>1);
			
			if($this->auth_model->loginAsAdmin($conditions))
			{
				//Set Session For Admin
				$this->auth_model->setAdminSession($conditions);
				redirect_admin('home');
			
			} else {
				//Log in attempt failed
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Log Failed.Username and password do not match.'));
				redirect_admin('admin');
			}	
		} //IF End- Check For Form Submission	 
		
		$this->load->view('admin/admin_login',$data);
	}//Function Index End
	function forget_pwd()
	{
		if($this->input->post("forget_pwd_up")=="yes")
		{
			extract($this->input->post());
			
			$admin_email=$this->config->item("site_admin_mail");
			
			if($admin_email!=$forget_pwd_email)
			{
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',"This email address doesn't exist in our database"));
				
				redirect_admin('admin/forget_pwd');
			}
			else
			{
				$rand_no=rand(1,111111);
				
				$updateData["password"]=md5($rand_no);
				
				$result=$this->common_model->updateTableData("admins",1,$updateData);
				
				$site_name=$this->config->item("site_title");
				
				if($result)
				{
					
					$message="Dear Admin<br><br> Here is your <b>New Account Details<b><br><br><b>Password : </b>".$rand_no;
					
					sendMail($admin_email,$admin_email,"Welcome to ".$site_name,$message);
					
					$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',"Please check your mail.New Password Send to your Email"));
					
				}
			}
			redirect_admin('login');
		}
		$data=array();
		
		$this->load->view("admin/forget_password",$data);
	}
}
?>