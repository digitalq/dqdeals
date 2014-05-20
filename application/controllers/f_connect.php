<?php
class F_connect extends CI_Controller
{
	var $city_drop_down;
	
	var $facebook;
	
	var $facebook_app_id,$facebook_scret_id,$facebook_user,$user_profile;
	
	function F_connect()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('config_data');
		
		$this->config_data->db_config_fetch();
				
		//Load Models Common to all the functions in this controller
		
		$this->load->model('common_model');
		
		$this->load->model('user_model');
		
		$this->load->helper('url');
		
		$this->load->helper('common_helper');
		
		$this->load->helper('auth_helper');
		
		$this->load->helper('date_helper');
		
		$this->load->library('form_validation');
		
		$this->load->helper('facebook_helper');
		
		$this->load->model('settings_model');
		
		$this->load->library('session');
		
		$city_where=array("status"=>1);
		
		$city_orderby=array("name","asc");
		
		$this->city_drop_down=dropdown_box("city","id","name",$city_where,$city_orderby);
		
		$this->facebook_app_id=$this->common_model->get_social_data("facebook_api_key");
		
		$this->facebook_scret_id=$this->common_model->get_social_data("facebook_secret_key");
		
		$this->facebook = new Facebook(array('appId'  => $this->facebook_app_id,'secret' => $this->facebook_scret_id));
		
		$this->facebook_user = $this->facebook->getUser();
		
		if ($this->facebook_user) 
		{
			try{
			 	$this->user_profile = $this->facebook->api('/me');
			}
			catch(FacebookApiException $e){
				error_log($e);
				$this->facebook_user = null;
			}
		}
	}
	
	function index()
	{
		$data=array();
		
		if($this->user_profile)
		{
			$city_drop_down=$this->city_drop_down;
			
			$data["facebook_connect"]="yes";
			
			$data["facebook_app_id"]=$this->facebook_app_id;
			
			$data["facebook_name"]=$this->user_profile["name"];
			
			$data["facebook_email_id"]=$this->user_profile["email"];
			
			$data["facebook_user_id"]=$this->user_profile["id"];
			
			$data["email_sub_container"]='no';
		
			$data["title"]="Signup";
			
			$conditions["email"]=$this->user_profile["email"];
			
			$conditions["status"]=1;
			
			$face_book_contision=array("facebook_id"=>$this->user_profile["id"]);
			
			$face_book_match_query=$this->common_model->getTableData("facebook_match",$face_book_contision);
			
			$facebook_match=$face_book_match_query->result();
			
			$members_query=$this->common_model->getTableData("users",$conditions);
			
			$members=$members_query->result();
			
			if(count($facebook_match)!=0)
			{
				$face_book_contision=array("facebook_id"=>$this->user_profile["id"]);
						
				$face_book_match_query=$this->common_model->getTableData("facebook_match",$face_book_contision);
						
				$facebook_match_data=$face_book_match_query->result();
				
				if(count($facebook_match_data)!=0)
				{
						
					$conditions 		=  array('id'=>$facebook_match_data[0]->user_id,'status' => '1');
			
					$query				= $this->user_model->getUsers($conditions);
				
					$row =  $query->row();
					
					$updateData['last_login'] = date('Y-m-d h:i:s');
					 //Get Activation Key
					$activation_key = $row->id;
					// update process for users table
					$this->user_model->updateUser(array('id'=>$row->id),$updateData);
					
					$this->auth_model->setUserSession($row);
				
					redirect('home/');
				}
			}
			//var_dump($data);
			$this->load->view("sign_up",$data);
		}
	}
	function signup()
	{
		if($this->input->post("face_book_sign_up_form")=="yes")
		{
			
			extract($this->input->post());
			
			$conditions=array();
			
			$insertData=array();
			
			$conditions["email"]=$email;
			
			$members_query=$this->common_model->getTableData("users",$conditions);
			
			$members=$members_query->result();
			
			if(count($members)==0)
			{	
				$user_name=$this->common_model->create_unique_slug($first_name,"users","user_name");
					
				$insertData=array("user_name"=>$user_name,"first_name"=>$first_name,"email"=>$email,"level"=>3,"password"=>md5($password));
				
				$result=$this->common_model->insertData('users',$insertData);
				
				$site_name=$this->config->item("site_title");
				
				if($result)
				{
					$message="Dear Member<br><br> Pleasure to meet you and welcome to the ".$site_name."! here your <b>Account Details<b><br><br><b>Email_id : </b>".$email."<br><br><b>Password : </b>".$password;
					
					$conditions 		=  array('email'=>$insertData["email"],'password' => $insertData["password"],'status' => '1');
				
					$query				= $this->user_model->getUsers($conditions);
					
					$row =  $query->row();
					
					$insert_data["facebook_id"]=$facebook_user_id;	
					
					$insert_data["user_id"]=$row->id;
					
					$result=$this->common_model->insertData("facebook_match",$insert_data);
					
					sendMail($this->config->item("site_admin_mail"),$email,"Welcome to ".$site_name,$message);
					
					$updateData = array();					
					
                    $updateData['last_login'] = date('Y-m-d h:i:s');
					  //Get Activation Key
		            $activation_key = $row->id;
				      // update process for users table
				    $this->user_model->updateUser(array('id'=>$row->id),$updateData);
					
					$this->auth_model->setUserSession($row);
					
					redirect("deals");
				}
				
			}
			else
			{	
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',"This email is already signed up.Pleae login here."));
				redirect('f_connect');
			}
		}
		redirect("home");
	}
}
?>