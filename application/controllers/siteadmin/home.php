<?php
class Home extends CI_Controller
{
	var $one_value_edit_id;
	
	var $one_edit_table;
	
	function Home()
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
		
		$this->load->model('common_model');
		
		$this->load->model('auth_model');
		
		$this->load->library('session');
		
		$this->load->library('pagination');
		
		$this->load->helper('date_helper');
		
		if(!isAdmin())
			redirect_admin("admin");
		
	}
	public function index()
	{
		if(!isAdmin())
			redirect_admin("admin");
		
		$data["content"]="Hi Admin";
		
		$data["title"]="Welcome Back !";
		
		$data["no_of_active_user"]=count($this->common_model->getTableData("users",array("status"=>1))->result());
		
		$data["no_of_inactive_user"]=count($this->common_model->getTableData("users",array("status"=>0))->result());
		
		$data["no_of_deals"]=count($this->common_model->getTableData("deals")->result());
		
		$data["no_of_orders"]=count($this->common_model->getTableData("payment_log")->result());
		
		$data["no_of_subscribers"]=count($this->common_model->getTableData("subscribe")->result());
				
		$this->load->view("admin/admin_home",$data);
		
	}
	function logout()
	{	
		$this->auth_model->clearAdminSession();	
		
		$this->auth_model->clearUserSession();	
		
		$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',"logged out successfully"));
		
		redirect_admin('admin');
		
	}
	public function add_country()
	{
		if(!isAdmin())
			redirect_admin("admin");
			
		$sub_page_data["table_type"]="country";
		
		$data["title"]="Add Country";
		
		$sub_page_data["open_tab"]="country_box";
		
		$data["content"]=$this->load->view("admin/one_add_value",$sub_page_data,TRUE);
		
		$this->load->view("admin/admin_home",$data);
	}
	public function add_one_value()
	{
		$txt_name='';
		
		if(!isAdmin())
			redirect_admin("admin");
			
		if($this->input->post("form_type")=="")
			redirect_admin("home");
		
		$form_type=$this->input->post("form_type");
		
		
		if($this->input->post('one_value_submit')=="Add")
		{
			if(!$this->config->item("product_mode"))
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
				redirect_admin("home");
			}
			
			$txt_name=$this->input->post("txt_name");
			
			if($txt_name!="")
			{
				$data = array('name' => $txt_name);
				
				$this->db->where('name =', $txt_name);
				
				$name_found=$this->db->get($form_type,"1");
		
				$name_exsits=$name_found->result();
				
				$result="";
				
				if(isset($name_exsits[0]->name) && $name_exsits[0]->name!="")
				 $result="exsists";
				
				if($result=="exsists")
				{
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',ucfirst($form_type).' Already Exists'));
					
					redirect_admin("home/add_".$form_type);
				}
				if($this->common_model->insertData($form_type,$data))
				{
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',ucfirst($form_type).' Added Successfully'));
				}
				else
				{
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',ucfirst($form_type).' Error'));
				}
				
				unset($result);
				
				
			}
			
			redirect_admin("home/view_".$form_type);
		}
		elseif($this->input->post('one_value_submit')=="Edit")
		{
		
			if(!$this->config->item("product_mode"))
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
				redirect_admin("home");
			}
			$txt_name=$this->input->post("txt_name");
			
			$edit_id=$this->input->post("edit_id");
			
			if($txt_name!="")
			{
				$data = array('name' => $txt_name);
				
				$this->db->where('id !=',$edit_id);
				
				$this->db->where('name =',$txt_name);
				
				$name_found=$this->db->get($form_type,"1");
		
				$name_exsits=$name_found->result();
				
				
				$result="";
				
				if(isset($name_exsits[0]->name) && $name_exsits[0]->name!="")
				 $result="exsists";
				
				if($result=="exsists")
				{
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',ucfirst($form_type).' Already Exists. Please try some Other'));
					
					redirect_admin("home/edit_".$form_type."/".$edit_id);
				}
				if($this->common_model->edit_one_value($edit_id,$form_type,$data))
				{
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',ucfirst($form_type).' Edited Successfully'));
				}
				else
				{
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',ucfirst($form_type).' Error'));
				}
				unset($result);
				
				//redirect_admin("home/edit_".$form_type."/".$edit_id);
				
				redirect_admin("home/view_".$form_type);
				
			}	
		}
		if($this->input->post('one_value_submit')=="Cancel")
		{
			redirect_admin("home/view_".$form_type);	
		}
	}
	public function view_country()
	{
		$data=array();
		
		$this->one_edit_table="country";
		
		$data["title"]="Country Management";
		
		$config['base_url'] = admin_url('/home/view_country');
		
	    $config['total_rows'] = $this->db->count_all('category');
		
    	$config['per_page'] = '10';
		
	    $config['full_tag_open'] = '<p>';
		
    	$config['full_tag_close'] = '</p>';
		
		$this->pagination->initialize($config);
		
		$results=$this->common_model->getTabledata("country");
		
		$country=$results->result();
		
		$data["country"]=$country;
		
		$data["open_tab"]="country_box";
		
		$this->load->view("admin/view_country",$data);
	}
	public function add_category()
	{
		if(!isAdmin())
			redirect_admin("admin");
			
		$sub_page_data["table_type"]="category";
		
		$sub_page_data["open_tab"]="category_box";
		
		$data["content"]=$this->load->view("admin/one_add_value",$sub_page_data,TRUE);
		
		$this->load->view("admin/admin_home",$data);
	}
	public function edit_category($id)
	{
		if($id==0 or $id=="")
			redirect(admin_url("home/view_category"));
			
		$sub_page_data["table_type"]="category";
		
		$this->one_edit_table="category";
		
		$sub_page_data["open_tab"]="category_box";
		
		$sub_page_data["mode"]="edit";
		
		$edit_details=$this->common_model->get_one_value_by_id($id,"category");
		
		$edit_detail=$edit_details->result();
		
		$sub_page_data["cat_name"]=$edit_detail[0]->name;
		
		$sub_page_data["cat_id"]=$edit_detail[0]->id;
		
		$data["content"]=$this->load->view("admin/one_add_value",$sub_page_data,TRUE);
		
		$this->load->view("admin/admin_home",$data);
	}
	public function edit_country($id)
	{
		if($id=="" or $id==0)
			redirect(admin_url("home/view_country"));
			
		$sub_page_data["table_type"]="country";
		
		$this->one_edit_table="country";
		
		$sub_page_data["open_tab"]="country_box";
		
		$data["title"]="Edit Country";
		
		$sub_page_data["mode"]="edit";
		
		$edit_details=$this->common_model->get_one_value_by_id($id,"country");
		
		$edit_detail=$edit_details->result();
		
		$sub_page_data["cat_name"]=$edit_detail[0]->name;
		
		$sub_page_data["cat_id"]=$edit_detail[0]->id;
		
		$data["content"]=$this->load->view("admin/one_add_value",$sub_page_data,TRUE);
		
		$this->load->view("admin/admin_home",$data);
	}
	public function view_category()
	{
		$data=array();
		
		$this->one_edit_table="category";
		
		$data["title"]="Category Management";
		
		$config['base_url'] = admin_url('/home/view_category');
		
	    $config['total_rows'] = $this->db->count_all('category');
		
    	$config['per_page'] = '10';
		
	    $config['full_tag_open'] = '<p>';
		
    	$config['full_tag_close'] = '</p>';
		
		$this->pagination->initialize($config);
		
		$results=$this->common_model->getTabledata("category");
		
		$categories=$results->result();
		
		$data["categories"]=$categories;
		
		$data["open_tab"]="category_box";
		
		$this->load->view("admin/view_category",$data);
	}
	function view_sub_category($id)
	{
		if($id=="" or $id==0)
			redirect(admin_url("home/view_category/"));
		
		$data=array();
		
		$data["title"]="Sub Category Management";
		
		$data["category_id"]=$id;
		
		$results=$this->common_model->getTabledata("sub_category",array("parent_id"=>$id));
		
		$sub_category=$results->result();
		
		$data["title"]="Manage Sub Category";
		
		$data["sub_categories"]=$sub_category;
		
		$data["open_tab"]="category_box";
		
		$this->load->view("admin/view_sub_category",$data);
	}
	function view_city()
	{
		$data=array();
		
		$data["title"]="City Management";
		
		$config['base_url'] = admin_url('/home/view_city');
		
	    $config['total_rows'] = $this->db->count_all('city');
		
    	$config['per_page'] = '10';
		
	    $config['full_tag_open'] = '<p>';
		
    	$config['full_tag_close'] = '</p>';
		
		$this->pagination->initialize($config);
		
		$results=$this->common_model->getTabledata("city");
		
		$cities=$results->result();
		
		$data["cities"]=$cities;
		
		$data["open_tab"]="city_box";
		
		$this->load->view("admin/view_city",$data);
	}
	function add_sub_category($id='')
	{
		if($this->input->post("add_sub_cat_submit")=="Add")
		{
			if(!$this->config->item("product_mode"))
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
				redirect_admin("home/view_sub_category/".$id);
			}
			
			$cat_id=$this->input->post("category");
			
			$cat_name=$this->input->post("sub_category_name");
			
			$cat_keyword=$this->input->post("sub_cat_tags");
			
			$category_data=array("name"=>$cat_name,"parent_id"=>$cat_id,"tags"=>$cat_keyword);
			
			$this->db->where('parent_id =',$cat_id);
				
			$this->db->where('name =',$cat_name);
			
			$name_found=$this->db->get("sub_category","1");
		
			$name_exsits=$name_found->result();
			
			$result='';
			
			if(isset($name_exsits) && count($name_exsits)!=0)
			{
				if($name_exsits[0]->name!="")
				{
					$result="exsits";
				}
			}
			if($result=="exsits")
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Sub category Already Exists'));
			}
			elseif($this->common_model->insertData("sub_category",$category_data))
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Sub category Added Successfully'));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Error'));
				
			redirect(admin_url("home/view_sub_category/".$id));
		}	
		
		$data["title"]="Add Sub Category";
		
		if($id!='')
			$data["category_id"]=$id;
		else
			$data["category_id"]='';
		
			$data["open_tab"]="category_box";
		
		$category_drop_val=array();
		
		$results=$this->common_model->getTabledata("category",array("status"=>1));
		
		$categories=$results->result();
		
		$category_drop_val['']="Select";
		
		foreach($categories as $category)
		{
			$category_drop_val[$category->id]=ucfirst($category->name);
		}
		$data["category_drop_val"]=$category_drop_val;
		
		$this->load->view("admin/add_sub_category",$data);
	}
	function edit_sub_category($id)
	{
		$sub_cat_details=$this->common_model->getTabledata("sub_category",array("id"=>$id))->result();
		
		if(count($sub_cat_details)==0)
			redirect(admin_url("home/view_category/"));
		
		if($this->input->post("add_sub_cat_submit")=="Edit")
		{
			if(!$this->config->item("product_mode"))
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
				redirect_admin("home/view_sub_category/".$id);
			}
			
			$cat_id=$this->input->post("category");
			
			$cat_name=$this->input->post("sub_category_name");
			
			$cat_keyword=$this->input->post("sub_cat_tags");
			
			$edit_id=$this->input->post("edit_id");
			
			$category_data=array("name"=>$cat_name,"parent_id"=>$cat_id,"tags"=>$cat_keyword);
			
			$this->db->where('id !=',$edit_id);
			
			$this->db->where('parent_id =',$cat_id);
				
			$this->db->where('name =',$cat_name);
			
			$name_found=$this->db->get("sub_category","1");
		
			$name_exsits=$name_found->result();
			
			$result='';
			
			if(count($name_exsits))
			{
				if($name_exsits[0]->name!="")
				{
					$result="exsits";
				}
			}
			if($result=="exsits")
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Error:Sub category Already Exists'));
				redirect(admin_url("home/edit_sub_category/".$id));	
			}
			elseif($this->common_model->updateTableData("sub_category",$id,$category_data))
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Sub category Updated Successfully'));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Error'));
				
			redirect(admin_url("home/view_sub_category/".$sub_cat_details[0]->parent_id));
		}
		
		if($id==0 && $id=="")
			redirect(admin_url("home/view_category/"));
		
		$data["title"]="Edit Sub Category";
		
		$data["sub_category_id"]=$sub_cat_details[0]->id;
			
		$data["category_id"]=$sub_cat_details[0]->parent_id;
		
		$data["sub_category_name"]=$sub_cat_details[0]->name;
		
		$data["tags"]=$sub_cat_details[0]->tags;
		
		$data["open_tab"]="category_box";
		
		$category_drop_val=array();
		
		$results=$this->common_model->getTabledata('category');
		
		$categories=$results->result();
		
		$category_drop_val['']="Select";
		
		foreach($categories as $category)
		{
			$category_drop_val[$category->id]=ucfirst($category->name);
		}
		$data["category_drop_val"]=$category_drop_val;
		
		$this->load->view("admin/add_sub_category",$data);
	}
	function add_city()
	{
		if($this->input->post("add_city_submit")=="Add")
		{
			if(!$this->config->item("product_mode"))
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
				redirect_admin("home/view_city/");
			}
			$country_id=$this->input->post("country");
			
			$city_name=$this->input->post("city_name");
			
			$city_data=array("name"=>$city_name,"country"=>$country_id,"slug"=>clen_slug($city_name));
			
			$this->db->where('country =',$country_id);
				
			$this->db->where('name =',$city_name);
			
			$name_found=$this->db->get("city","1");
		
			$name_exsits=$name_found->result();
			
			$result='';
			
			if(count($name_exsits)!=0)
			{
				if($name_exsits[0]->name!="")
				{
					$result="exsits";
				}
			}
			if($result=="exsits")
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','City Name Already Exists'));
				redirect(admin_url("home/add_city"));
			}
			elseif($this->common_model->insertData("city",$city_data))
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','City Added Successfully'));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Error'));
				
			redirect(admin_url("home/view_city"));	
		}	
		
		$data["title"]="Add City";
		
		$data["mode"]="new";
		
		$data["open_tab"]="city_box";
		
		$country_drop_val=array();
		
		$data["cancel_url"]=admin_url("home/view_city");
		
		$results=$this->common_model->getTabledata("country");
		
		$countries=$results->result();
		
		$country_drop_val['']="Select";
		
		foreach($countries as $county)
		{
			$country_drop_val[$county->id]=ucfirst($county->name);
		}
		$data["country_drop_val"]=$country_drop_val;
		
		$this->load->view("admin/add_city",$data);
	}
	public function edit_city($id)
	{
		if($this->input->post("add_city_submit")=="Edit")
		{
			if(!$this->config->item("product_mode"))
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
				redirect_admin("home/view_city");
			}
			
			$country_id=$this->input->post("country");
			
			$city_name=$this->input->post("city_name");
			
			$city_id=$this->input->post("edit_id");
			
			$update_data=array("name"=>$city_name,"country"=>$country_id,"slug"=>clen_slug($city_name));
			
			$this->db->where('id !=',$city_id);
			
			$this->db->where('country =',$country_id);
				
			$this->db->where('name =',$city_name);
			
			$name_found=$this->db->get("city","1");
		
			$name_exsits=$name_found->result();

			$result='';
			
			if(isset($name_exsits) && count($name_exsits)!=0)
			{
				if($name_exsits[0]->name!="")
				{
					$result="exsits";
				}
			}
			if($result=="exsits")
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','City Name Already Exists'));
				
				redirect(admin_url("home/edit_city/".$city_id));
			}
			elseif($this->common_model->updateTableData("city",$city_id,$update_data))
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','City Updated Successfully'));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Error'));
				
			redirect(admin_url("home/view_city"));
		}
		
		
		$country_drop_val=array();
		
		$results=$this->common_model->getTabledata("country",array('status'=>1));
		
		$countries=$results->result();
		
		$country_drop_val['']="Select";
		
		foreach($countries as $county)
		{
			$country_drop_val[$county->id]=ucfirst($county->name);
		}
		
		$data["country_drop_val"]=$country_drop_val;
		
		if($id=="" or $id==0)
			redirect(admin_url("home/view_city"));
			
		$data["table_type"]="city";
		
		$data["open_tab"]="city_box";
		
		$data["mode"]="edit";
		
		$data["cancel_url"]=admin_url("home/view_city");
		
		$edit_details=$this->common_model->get_one_value_by_id($id,"city");
		
		$edit_detail=$edit_details->result();
		
		$data["city_id"]=$edit_detail[0]->id;
		
		$data["city_name"]=$edit_detail[0]->name;
		
		$data["country_id"]=$edit_detail[0]->country;
		
		$this->load->view("admin/add_city",$data);
	}
	public function cge_status()
	{
		
		if(!$this->config->item("product_mode"))
		{
			//$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
			echo "af";
			exit(0);
		}
			
		$table_name=$this->input->post("change_status");
		
		$current_id=$this->input->post("id");
		
		$status_check=$this->common_model->get_one_value_by_id($current_id,$table_name);
		
		$status=$status_check->result();
		
		$current_status=$status[0]->status;
		
		$update_data=array();
		
		if($current_status)
			$update_data["status"]=0;
		else
			$update_data["status"]=1;
		
		$this->common_model->change_status($table_name,$current_id,$update_data);
		
		echo $update_data["status"];
		
		exit();
	}
	function delete_record()
	{
		if(!$this->config->item("product_mode"))
		{
			//$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
			echo "af";
			exit;
		}
		$table_name=$this->input->post("delete_record");
		
		$current_id=$this->input->post("id");
		
		$result=$this->db->delete($table_name, array('id' => $current_id)); 
		
		if($result)
			echo $current_id;
		else
			echo 0;
		exit;
	}
	function feed_importer()
	{
		
		
		$url = 'http://livingsocial.com/cities/26.atom';

		$item='item';
		
		if ( $url ) {
			
			$rss = fetch_rss( $url );
			$arrXml=objectsIntoArray($rss);
			
			var_dump($arrXml["items"]);
		}
	}
}
?>