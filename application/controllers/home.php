<?php
class Home extends CI_Controller
{
	var $city_drop_down;
	
	var $facebook;
	
	var $time_zone;
	
	var $facebook_app_id,$facebook_scret_id,$facebook_user,$user_profile;
	
	function Home()
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
		//$this->load->model('skills_model');
		$this->load->helper('auth_helper');
		
		$this->load->helper('date_helper');
		
		$this->load->library('form_validation');
		
		$this->load->library('Paypal');
		
		$this->load->helper('facebook_helper');
		
		$this->load->model('settings_model');
		
		$this->load->library('session');
		
		$city_where=array("status"=>1);
		
		$city_orderby=array("name","asc");
		
		$this->city_drop_down=dropdown_box("city","slug","name",$city_where,$city_orderby);
		
		$this->facebook_app_id=$this->common_model->get_social_data("facebook_api_key");
		
		//var_dump($this->facebook_app_id);
		
		$this->facebook_scret_id=$this->common_model->get_social_data("facebook_secret_key");
		
		$this->facebook = new Facebook(array('appId'  => $this->facebook_app_id,'secret' => $this->facebook_scret_id));
		
		$this->facebook_user = $this->facebook->getUser();
		
		$this->time_zone = $this->config->item("site_time_zone");
		
		//var_dump($this->facebook_user);
		
		if ($this->facebook_user) 
		{
			try{
			 	$this->user_profile = $this->facebook->api('/me');
				if(!isLoggedIn())
					redirect("f_connect");
			}
			catch(FacebookApiException $e){
				error_log($e);
				$this->facebook_user = null;
			}
		}
	}
	
	function logout()
	{	
		if(isAdmin())
		{
			$this->auth_model->clearAdminSession();	
		}
		
		$this->auth_model->clearUserSession();	
		
		$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',"logged out successfully"));
		
		if ($this->facebook_user)
		{
			$logoutUrl = $this->facebook->getLogoutUrl();
			
			redirect($logoutUrl);
			
			$data["facebook_loginUrl"]=$loginUrl;		
		}
		
		redirect('login');
		
	}
	function subscribe()
	{
		if($this->input->post("subscribesubmit"))
		{
			$this->form_validation->set_rules("email",'Email Id','required|valid_email');
			
			$this->form_validation->set_rules("change_location_select",'City','required');
			
			if($this->form_validation->run())
			{
				var_dump($this->input->post());
				
				extract($this->input->post());
				
				$secret=rand(1,555555);
				
				$subscribe_option=array("email"=>$email);
				
				$subscribe_detail=$this->common_model->getTableData("subscribe",$subscribe_option)->result();
				
				if(count($subscribe_detail)!=0)
				{
					$city_where=array("id"=>$subscribe_detail[0]->city_id);
					
					$city_data=get_single_row("city",$city_where);
					
					if(count($city_data)!=0)
						redirect("deals/".$city_data[0]->slug);
					else
						redirect("deals/");
				}
				else
				{
					
					$city_where=array("slug"=>$change_location_select);
					
					$city_data=get_single_row("city",$city_where);
					
					$insertdata=array("email"=>$email,"city_id"=>$city_data[0]->id,"secret"=>md5($secret));
					/*var_dump($this->input->post(),$insertdata);
					exit;*/
					$result=$this->common_model->insertData('subscribe',$insertdata);
					
					if($result)
					{
						if(count($city_data)!=0)
							redirect("home/deals/".$change_location_select);
						else
							redirect("home/deals/");
					}
				}
			}
		}
		Home::deals();
	}
	function index($city_name='')
	{
		$data=array();
		
		if($this->user_profile)
		{
			$data["facebook_user_profile"]=$this->user_profile;
		}
		
		if(isLoggedIn())
		{
			//var_dump($city_name);
			redirect(base_url()."deals/".$city_name);
		}
		
		$loginUrl = $this->facebook->getLoginUrl(array('scope'=> 'email,publish_stream,user_about_me'));
		
		$data=array();
		
		
		
		$data["facebook_app_id"]=$this->facebook_app_id;
		
		$data["facebook_loginUrl"]=$loginUrl;
		
		$city_drop_down=$this->city_drop_down;
		
		$data["city_drop_down"]=$city_drop_down;
		
		$this->load->view("splash/splash",$data);
	}
	function deals($city_name="")
	{
		$data=array();
		
		$city_where=array("status"=>1);
		
		$city_orderby=array("name","asc");
		
		$city_drop_down=dropdown_box("city","slug","name",$city_where,$city_orderby);
		
		$data["city_drop_down"]=$city_drop_down;
		
		if($city_name!="")
			$city_where=array("slug"=>$city_name);
		else
		{	
			$user_city_id=get_users_detail("city");
			
			//var_dump($user_city_id);
			
			if($user_city_id!='')
				$city_where=array("id"=>$user_city_id);
			else
			{
				$city_where=array("status"=>'1');
			}
		}
		
		
		$city_data=get_single_row("city",$city_where);
		
		
		$data["selected_city"]=$city_data[0]->id;
		
		$data["selected_slug"]=$city_data[0]->slug;
			
		$data["selected_city_name"]=$city_data[0]->name;
		
		$cur_date=get_est_time($this->time_zone);
		
		$cur_date=date("Y-m-d H:i:s",$cur_date);
			
		$array = array('deal_end_date >= ' => $cur_date, 'deal_city' => $data["selected_city"],"status"=>'1',"quantity !="=>0);
		
		$this->db->where($array);
		
		$deals_query=$this->db->get('deals');
		
		//echo $this->db->last_query();
		
		$total_deals=$deals_query->result();
		
		$data["total_deal_count"]=count($total_deals);
		
		$data["deal_datas"]=$total_deals;
		
		$this->load->view("index",$data);
		
	}
	function deal($slug)
	{	
		if($slug=="")
			redirect("deals");
		
		$data=array();
		
		$data["title"]="Deals Detail";
		
		$deal_contision=array("slug"=>$slug);
		
		$deal_detail_query=$this->common_model->getTableData("deals",$deal_contision);
		
		$deal_detail=$deal_detail_query->result();
		
		$mergent_data=array();
		
		if(count($deal_detail)!=0)
		{
			$data["deal_seo_keyword"]=$deal_detail[0]->seo_keyword;
			
			$data["deal_seo_description"]=$deal_detail[0]->seo_description;
			
			$data["deal_title"]=$deal_detail[0]->deal_title;
			
			$data["quantity"]=$deal_detail[0]->quantity;
			
			//$data["deal_link"]=get_links($deal_detail[0]->id);
			
			$data["share_link"]=base_url()."deal/".$deal_detail[0]->slug;
			
			$city_id=$deal_detail[0]->deal_city;
			
			$city_where=array("id"=>$city_id);
			
			$city_data=get_single_row("city",$city_where);
			
			$deal_end_date=gmt_to_local($deal_detail[0]->deal_end_date,$this->time_zone,TRUE);
			
			//$cur_date=get_est_time($this->time_zone);
			$cur_date=get_est_time($this->time_zone);
		
			$cur_date=date("Y-m-d H:i:s",$cur_date);
			
			
			$data["bought"]=$deal_detail[0]->deal_max_count-$deal_detail[0]->quantity;
			
			$data["required_bought"]=$deal_detail[0]->deal_max_count-$data["bought"];
			
			
			if($data["quantity"]==0 or $deal_detail[0]->deal_end_date<$cur_date)
			{
				$data["expired"]="yes";
			}
			
			if(count($city_data)!=0)
			{
				$data["selected_city"]=$city_data[0]->id;
			
				$data["selected_slug"]=$city_data[0]->slug;
				
				$data["selected_city_name"]=$city_data[0]->name;
				
				$data["city_title"]="Get All the Best Daily Deals in ".ucfirst($city_data[0]->name);
			}
			
			if(isset($data["selected_city"]) && $data["selected_city"]!="")
			{
				$cur_date=get_est_time($this->time_zone);
		
				$cur_date=date("Y-m-d H:i:s",$cur_date);
				
				$other_contision=array("deal_end_date >= "=>$cur_date,"deal_city"=>$data["selected_city"],"slug !="=>$slug,"status"=>1,"quantity !="=>0);
				
				$side_deal_query=$this->common_model->getTableData("deals",$other_contision,NULL,NULL,array(4));
				
				$side_deals=$side_deal_query->result();
				
				$data["side_deals"]=$side_deals;
			}
			$city_data=get_single_row("city",$city_where);
			
			$mergent_where=array("id"=>$deal_detail[0]->merchent);
			
			$mergent_data=get_single_row("merchants",$mergent_where);
		}
		else
		{
			redirect("deals");
		}
		if(count($mergent_data))
		{
			$data["mergent_data"]=$mergent_data;
			
			$data["mergent_name"]=$mergent_data[0]->company_name;
			
			$data["mergent_address"]=$mergent_data[0]->	address;
			
			$data["mergent_site_url"]=$mergent_data[0]->site_url;
		}
		
		$city_drop_down=$this->city_drop_down;
		
		$data["city_drop_down"]=$city_drop_down;
		
		$data["deal_detail"]=$deal_detail[0];
		
		//var_dump($data);
		
		$this->load->view("deals_details",$data);
	}
	function login()
	{
		if($this->input->post("form_name")=="user_login")
		{
			extract($this->input->post());
			
			$conditions 		=  array('email'=>trim($email),'password' => md5(trim($password)),'status' => '1');
				
			$query				= $this->user_model->getUsers($conditions);
					
			$row =  $query->row();
			if(count($row)!=0)
			{
				if($row->email==$email && $row->password==md5($password))
				{
					$updateData = array();
						
					$updateData['last_login'] = date('Y-m-d h:i:s');
					
					// update process for users table
					
					
					$this->user_model->updateUser(array('id'=>$row->id),$updateData);
					
					$this->auth_model->setUserSession($row);
					
					redirect("deals");
				}
				else
				{
					$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',"Email and Password Did Not Match"));
					redirect("login");
				}
			}
			else
			{
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',"Email and Password Did Not Match"));
				redirect("login");
			}
		}
		
		$loginUrl = $this->facebook->getLoginUrl(array('scope'=> 'email,publish_stream,user_about_me'));
		
		$data["facebook_app_id"]=$this->facebook_app_id;
		
		$data["facebook_loginUrl"]=$loginUrl;
		
		$data["title"]="Sign In";
		
		$data["city_drop_down"]=$this->city_drop_down;
		
		//$data["email_sub_container"]='no';
		
		$this->load->view("login",$data);
	}
	
	function signup()
	{
		if(isLoggedIn())
			redirect("deals");
			
		if($this->input->post("sign_upuser"))
		{
			$this->form_validation->set_rules("first_name",'Full name is invalid','required');
			
			$this->form_validation->set_rules("email",'Email address is required','required|valid_email');
			
			$this->form_validation->set_rules("password",'Password required','required|matches[cpassword]');
			
			$this->form_validation->set_rules("cpassword",'Confirmation required','required');
			
			if($this->form_validation->run())
			{
			
				extract($this->input->post());
				
				$update_data=array();
				
				$conditions=array("email"=>$email);
			
				$user_details=$this->common_model->getTableData("users",$conditions)->result();
				
				if(count($user_details)!=0)
				{
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Please try other email id.Its already Exsists'));
					
					redirect("signup");	
				}
				else
				{
					$user_name=$this->common_model->create_unique_slug($first_name,"users","user_name");
					
					$insertData=array("user_name"=>$user_name,"first_name"=>$first_name,"email"=>$email,"level"=>3,"password"=>md5($password));
					
					/*$password=rand(0,111111);
					
					if($password!="")
						$insertData["password"]=md5($password);*/
					
					$result=$this->common_model->insertData('users',$insertData);
					
					
					$conditions 		=  array('email'=>$email,'status' => '1');
				
					$query				= $this->user_model->getUsers($conditions);
					
					$row =  $query->row();
			
					$updateData = array();
					
					$updateData['last_login'] = date('Y-m-d h:i:s');
					
					// update process for users table
					
					
					$this->user_model->updateUser(array('id'=>$row->id),$updateData);
					
					$this->auth_model->setUserSession($row);
					
					redirect("deals");
				}
				
				if($result)
				{	
					$site_name=$this->config->item("site_title");
					
					$message="Dear Member<br><br> Pleasure to meet you and welcome to the ".$site_name."! here your <b>Account Details<b><br><br><b>Email_id : </b>".$email."<br><br><b>Password : </b>".$password;
					
					sendMail($this->config->item("site_admin_mail"),$email,"Welcome to ".$site_name,$message);
					
					//$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','User Added Successfully'));
					
					redirect("deals");
				}
				else
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Error : User Not Added'));
					
				redirect("signup");
			}
			
		}
		
		$loginUrl = $this->facebook->getLoginUrl(array('scope'=> 'email,publish_stream,user_about_me'));
		
		$data["city_drop_down"]=$this->city_drop_down;
		
		$data["facebook_app_id"]=$this->facebook_app_id;
		
		$data["facebook_loginUrl"]=$loginUrl;
		
		$data["title"]="Login";
		
		//$data["email_sub_container"]='no';
		
		$data["title"]="Sign Up";
		
		$this->load->view("sign_up",$data);
	}
	function forget_pwd()
	{
		if($this->input->post("forget_pwd_up")=="yes")
		{
			$this->form_validation->set_rules("forget_pwd_email",'Please Enter Valid Email id','required|valid_email');
			
			if($this->form_validation->run())
			{
				extract($this->input->post());
				
				$conditions["email"]=$forget_pwd_email;
				
				$conditions['status']='1';
				
				$members_query=$this->common_model->getTableData("users",$conditions);
				
				$members=$members_query->result();
				
				if(count($members)==0)
				{
					$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',"This email address doesn't exist in our database"));
					
					redirect('forget_pwd');
				}
				else
				{
					$rand_no=rand(1,111111);
					
					$updateData["password"]=md5($rand_no);
					
					$result=$this->user_model->updateUser(array('email'=>$forget_pwd_email),$updateData);
					
					$site_name=$this->config->item("site_title");
					
					if($result)
					{
						
						$message="Dear Member<br><br> Here is your <b>New Account Details<b><br><br><b>Email_id : </b>".$forget_pwd_email."<br><br><b>Password : </b>".$rand_no;
						
						$conditions 		=  array('email'=>$forget_pwd_email,'status' => '1');
					
						$query				= $this->user_model->getUsers($conditions);
						
						$row =  $query->row();
						
						sendMail($this->config->item("site_admin_mail"),$forget_pwd_email,"Welcome to ".$site_name,$message);
						
						$this->session->set_flashdata('flash_message', $this->common_model->flash_message('success',"Please check your mail.New Password Send to your Email"));
						
					}
				}
				redirect('login');
			}
		}
		$data=array();
		
		$data["title"]="Forget password";
		
		$this->load->view("forget_password",$data);
	}
	function my_account()
	{
		$data=array();
		
		$data["title"]="My Account";
		
		if(!isLoggedIn())
		{
			redirect("login");
		}
		$user_id=get_users_detail("id");
		
		if($this->input->post("user_submit_button"))
		{
			extract($this->input->post());
			
			$updateData=array("first_name"=>$first_name,"last_name"=>$last_name,"time_zone"=>$timezones,"email"=>$email,"city"=>$city,"email_frequency"=>$email_frequency);
				
			$result=$this->common_model->updateTableData('users',$user_id,$updateData);
			
			$subscribe_option=array("email"=>$email);
			
			$subscribe_detail=$this->common_model->getTableData("subscribe",$subscribe_option)->result();
			
			$updatesubscribe=array("email"=>$email,"city_id"=>$city,"status"=>$email_frequency);
			
			if(count($subscribe_detail)!=0)
				$result1=$this->common_model->updateTableData('subscribe','',$updatesubscribe,array("email"=>$email));
			else
			{		
				$updatesubscribe["secret"]=md5($secret);
					
				$insertdata=array("email"=>$email,"city_id"=>$city_data[0]->id,"secret"=>md5($secret));
					
				$result1=$this->common_model->insertData('subscribe',$updatesubscribe);
					
			}
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Profile Updated Scessfully'));	
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Profile Not Updated'));	
			
			redirect("my_account");
		}
		
		$data['user_id']=$user_id;
		
		if($user_id!="" && $user_id!=0)
		{
			$user_option=array("id"=>$user_id);
		
			$user_detail=$this->common_model->getTableData("users",$user_option)->result();
			
			$data["user_detail"]=$user_detail;
		}
		
		//$data["email_sub_container"]='no';
		
		$city_drop_down=$this->city_drop_down;
		
		$data["city_drop_down"]=$city_drop_down;
		
		$city_contion=array("status"=>1);
		
		$results=$this->common_model->getTableData("city",$city_contion);
		
		$cities=$results->result();
		
		$city_drop_val['']="Select";
		
		foreach($cities as $city)
		{
			$city_drop_val[$city->id]=ucfirst($city->name);
		}
		
		$data["city_drop_val"]=$city_drop_val;
		
		$this->load->view("my_account",$data);
	}
	function my_coupon()
	{
		$data["title"]="My coupons";
		
		if(!isLoggedIn())
		{
			redirect("login");
		}
		
		$user_id=get_users_detail("id");
		
		$coupon_contision=array("user_id"=>$user_id);
		
		$coupon_details=$this->common_model->getTableData("coupon",$coupon_contision)->result();
		
		$data["coupon_details"]=$coupon_details;
		
		//$data["email_sub_container"]='no';
		
		$city_drop_down=$this->city_drop_down;
		
		$data["city_drop_down"]=$city_drop_down;
		
		$this->load->view("my_coupons",$data);
	}
	function change_password()
	{
		if(!isLoggedIn())
		{
			redirect("login");
		}
		$user_id=get_users_detail("id");
		
		if($this->input->post("change_password_button"))
		{
			extract($this->input->post());
			
			$this->form_validation->set_rules("old_password",'Old Password','required');
			
			$this->form_validation->set_rules("password",'Password','required');
			
			$this->form_validation->set_rules("confirm_password",'Confirmation Password','required');
			
			$this->form_validation->set_rules("password",'','matches[confirm_password]');
			
			if($this->form_validation->run())
			{
				$updateData=array("password"=>md5($password));
				
				$result=$this->common_model->updateTableData('users',$user_id,$updateData,array("password"=>md5($old_password)));
			
				if($result)
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Password Changed Scessfully'));	
				else
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Old Password Did Not Match'));	
			
				redirect("home/change_password");
			}	
		}
		
		//$data["email_sub_container"]='no';
		
		$city_drop_down=$this->city_drop_down;
		
		$data["city_drop_down"]=$city_drop_down;
		
		$data['user_id']=$user_id;
		
		if($user_id!="" && $user_id!=0)
		{
			$user_option=array("id"=>$user_id);
		
			$user_detail=$this->common_model->getTableData("users",$user_option)->result();
			
			$data["user_detail"]=$user_detail;
		}
		
		$data["title"]="Change Password";
		
		$this->load->view("change_password",$data);
	}
	function puchase($slug)
	{
		if(!isLoggedIn())
		{
			$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','You Must Login to Purachase the deals'));	
			
			redirect("login");
		}
		if($slug=="")
			redirect("deals");
		
		$data=array();
		
		$city_where=array("status"=>1);
		
		$city_orderby=array("name","asc");
		
		$city_drop_down=dropdown_box("city","slug","name",$city_where,$city_orderby);
		
		$data["city_drop_down"]=$city_drop_down;
		
		//$data["email_sub_container"]='no';
		
		$data["title"]="Your Purchase";
		
		$deal_contision=array("slug"=>$slug);
		
		$deal_detail_query=$this->common_model->getTableData("deals",$deal_contision);
		
		$deal_detail=$deal_detail_query->result();
		
		$mergent_data=array();
		
		if(count($deal_detail)!=0)
		{
			if($deal_detail[0]->quantity==0)
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','You Must Login to Purachase the deals'));
				
				redirect("deals");
			}
			$data["deal_title"]=$deal_detail[0]->deal_title;
			
			$data["deal_price"]=$deal_detail[0]->deal_price;
			
			$data["deal_id"]=$deal_detail[0]->id;
			
			$data["deal_max_purchase"]=$deal_detail[0]->deal_max_purchase_limit;
			
			$data["deal_quantity"]=$deal_detail[0]->quantity;
			
		}
		else
		{
			redirect("deals");
		}
		$this->load->view("purchase",$data);
	}
	function paypal_checkout()
	{
		
		$paypal_detail=$this->common_model->getTableData("paypal",array("gateways"=>1))->result();
		
		if($this->input->post("complete_order"))
		{
			if(!isLoggedIn())
			{
				redirect("login");
			}
			extract($this->input->post());
			
			if(count($paypal_detail)!=0)
			{
				
				$user_id=get_users_detail("id");
				
				$deal_contision=array("id"=>$deal_id);
		
				$deal_detail_query=$this->common_model->getTableData("deals",$deal_contision);
		
				$deal_detail=$deal_detail_query->result();
				
				$myPaypal = new Paypal();
		
				// Specify your paypal email
				$myPaypal->addField('business', $paypal_detail[0]->account_email);
				
				// Specify the currency
				$myPaypal->addField('currency_code', 'USD');
				
				// Specify the url where paypal will send the user on success/failure
				$myPaypal->addField('return', base_url()."home/payment_success");
				
				$myPaypal->addField('cancel_return', base_url());
				
				// Specify the url where paypal will send the IPN
				$myPaypal->addField('notify_url', base_url()."home/payment_success");
				
				if(count($deal_detail)!=0)
				{
					$amount=$order_amount*$deal_detail[0]->deal_price;
					
					$insertData=array("deal_id"=>$deal_detail[0]->id,"user_id"=>$user_id,"amount"=>$amount,"quantity"=>$order_amount);
				
					$order_id=$this->common_model->insertData('orders',$insertData);
				
					$myPaypal->addField('item_name', $deal_detail[0]->deal_title);	
					
					$myPaypal->addField('amount', $deal_detail[0]->deal_price);
					
					$myPaypal->addField('item_number', $deal_detail[0]->id);
					
					$myPaypal->addField('quantity', $order_amount);
					
					$custom=array($user_id,$order_id);
					
					$myPaypal->addField('custom', implode(",",$custom));
					
				}
				
				// Specify any custom value
				
				if(!$paypal_detail[0]->paypal_mode)
					$myPaypal->enableTestMode();
				
				ob_start();	
					$myPaypal->submitPayment();
				$paypal_form = ob_get_contents();
				$this->common_model->updateTableData("orders",$order_id,array("form_debug"=>$paypal_form));
				ob_end_clean();
				
				echo $paypal_form;
			}
		}

	}
	function payment_success()
	{
		$custom=$this->input->post("custom");
		
		$custom=explode(",",$custom);
		
		$str=serialize($this->input->post());
		
		$payment_log_detail=get_single_row("payment_log",array("order_id"=>$custom[1]));	
		
		if($this->input->post("payment_status")=="Completed")
		{
			$updateData=array("paid"=>1);
			
			$result=$this->common_model->updateTableData('orders',$custom[1],$updateData);
			
			if(count($payment_log_detail)==0)
			{
				$deal_contision=array("id"=>$this->input->post("item_number"));
				
				$deal_detail_query=$this->common_model->getTableData("deals",$deal_contision);
		
				$deal_detail=$deal_detail_query->result();
				
				if(count(deal_detail)!=0)
				{
					$deal_qty_update=array("quantity"=>$deal_detail[0]->quantity-$this->input->post("quantity"));
					
					$this->common_model->updateTableData('deals',$this->input->post("item_number"),$deal_qty_update);
					
					$radom_str=genRandomString();
					
					$coupon_data=array("user_id"=>$custom[0],
										"mergent_id"=>$deal_detail[0]->merchent,
										"deals_id"=>$this->input->post("item_number"),
										"order_id"=>$custom[1],
										"secret"=>$radom_str,
										"expire_time"=>$deal_detail[0]->deal_voucher_end_date,
										"create_time"=>get_est_time($this->time_zone)
										);
					
					$this->common_model->insertData('coupon',$coupon_data);
					
					$insertData=array("deal_id"=>$this->input->post("item_number"),"user_id"=>$custom[0],"order_id"=>$custom[1],"retrun_array"=>$str);
						
					$result=$this->common_model->insertData('payment_log',$insertData);
				}
			}
			
			$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Payment success'));
			
			redirect("home/my_coupon");
		}
		else
			redirect("home/payment_failed");
	}
	function thank_you()
	{
		$data=array();
		
		$data["email_sub_container"]='no';
		
		$data["title"]="Payment Success";

		$data["message"]="Thank you for your intrest, Payment Received";
		
		$this->load->view("thank_you",$data);
	}
	
	function payment_failed()
	{
		$data=array();
		
		$data["email_sub_container"]='no';
		
		$data["title"]="Payment Failed";

		$data["message"]="Sorry we are Not Receving your payment";
		
		$this->load->view("thank_you",$data);
	}
	
	function view_voucher($secret)
	{
		if(!isLoggedIn())
		{
			redirect("login");
		}
		
		$user_id=get_users_detail("id");
		
		$vocher_detail=get_single_row("coupon",array("secret"=>$secret));	
		
		if(count($vocher_detail)!=0)
		{
			if($user_id!=$vocher_detail[0]->user_id)
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Denided'));
				
				redirect("home/my_accout");
			}
		}
		else
		{
			$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Coupon Not Found'));
				
			redirect("home/my_account");
		}
		
		$data["vocher_details"]=$vocher_detail;
		
		$this->load->view("print",$data);
	}
	function unsubscribe($email)
	{
		$subscribe_contision=array("secret"=>$email);
		
		$subscribe_detail=$this->common_model->getTableData("subscribe",$subscribe_contision)->result();
		
		if(count($subscribe_detail)!=0)
		{
			$result=$this->common_model->updateTableData("subscribe",$subscribe_detail[0]->id,array("status"=>0));	
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Your Successfully unsubscribed from our daily deals alerts'));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Sorry Email Id Not Found'));
			
		}
		else
			$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Sorry Email Id Not Found'));
			
		redirect("login");
		
	}
	function faq()
	{
		$data=array();
		
		$conditions['status']='1';
		
		$data["city_drop_down"]=$this->city_drop_down;
			
		$faq_query=$this->common_model->getTableData("faq",$conditions);
		
		$faq_list=$faq_query->result();
		
		$data["faq_lists"]=$faq_list;
		
		$data["title"]="Frequently Asked Questions";
		
		$this->load->view("faq_list",$data);
	}
}