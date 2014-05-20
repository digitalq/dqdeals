<?php
class Deals extends CI_Controller
{
	var $city_drop_down;
	
	var $time_zone;
	
	function Deals()
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
		
		$this->load->library('form_validation');
		
		$city_val_array=dropdown_box("city","id","name",array("status"=>1),array('name',"ASC"));
		
		$this->time_zone = $this->config->item("site_time_zone");
		
		$this->city_drop_down=$city_val_array;
		
		
		$this->load->library('pagination');
		
		if(!isAdmin())
			redirect_admin("admin");
	}
	function index()
	{
		Deals::view();
	}
	function view()
	{
		$start = $this->uri->segment(4,0);
		
		if($start > 0)
		  $start = $start;
		  
		$page_rows         					 =  10;
		
		$limit[0]			 = $page_rows;
		
		if($start > 0)
		   $limit[1]			 = ($start-1) * $page_rows;
		else
		    $limit[1]			 = $start * $page_rows;  
		
		$order[0]            ='id';
		$order[1]            = 'asc';
		
		$category_query=$this->common_model->getTableData("category",array("status"=>'1'));
		
		$categories=$category_query->result();
		
		$websites_query=$this->common_model->getTableData("merchants",array("status"=>'1'));
		
		$websites=$websites_query->result();
		
		$websites_drop_val['']="Select";
		
		foreach($websites as $website)
		{
			$websites_drop_val[$website->id]=ucfirst($website->company_name);
		}
		$category_options='<option value="">Select</option>';
		
		foreach($categories as $category)
		{
			$category_options.='<optgroup label="'.$category->name.'">';
			
			$sub_category_query=$this->common_model->getTableData("sub_category",array("parent_id"=>$category->id,"status"=>1));
		
			$sub_categories=$sub_category_query->result();
			
			foreach($sub_categories as $sub_category)
			{
				$category_options.='<option value="'.$sub_category->id.'">'.$sub_category->name.'</option>';
			}
			
		}
		
		$city_query=$this->common_model->getTableData("city",array("status"=>'1'));
		
		$cities=$city_query->result();
		
		$cities_drop_val['']="Select";
		
		foreach($cities as $city)
		{
			$cities_drop_val[$city->id]=ucfirst($city->name);
		}
		
		$data["websites_drop_val"]=$websites_drop_val;
		
		$data["category_options"]=$category_options;
		
		$data["cities_drop_val"]=$cities_drop_val;
		
		$data["title"]="Manage Deals";
		
		$data["open_tab"]="deals_box";
		
		$config['base_url'] = admin_url('/deals/view');
		
	    $config['total_rows'] = $this->db->count_all('deals');
		
    	$config['per_page'] = $page_rows;
		
		$config['cur_page']     = $start;
		
		$this->pagination->initialize($config);
		
		$results=$this->common_model->get_all_deals_detail(NULL,NULL,NULL,$limit,$order);
		
		$deals=$results->result();
		
		$data['pagination_outbox']   = $this->pagination->create_links2(false,'view_deals');
		
		
		$limit=0;
		
		$data["deals"]=$deals;
		
		$this->load->view("admin/deals/view_deals",$data);
	}
	function add()
	{
		
		$data=array();
		
		$data["title"]="Add Deals";
		
		$data["open_tab"]='deals_box';
		
		$data["cancel_url"]=admin_url("delas/view");
		
		$data["city_drop_down"]=$this->city_drop_down;
		
		$category_query=$this->common_model->getTableData("category",array("status"=>'1'));
		
		$categories=$category_query->result();
		
		$category_options='<option value="">Select</option>';
		
		foreach($categories as $category)
		{
			$category_options.='<optgroup label="'.$category->name.'">';
			
			$sub_category_query=$this->common_model->getTableData("sub_category",array("parent_id"=>$category->id,"status"=>1));
		
			$sub_categories=$sub_category_query->result();

			


			foreach($sub_categories as $sub_category)
			{
				$category_options.='<option value="'.$sub_category->id.'">'.$sub_category->name.'</option>';
			}
			
		}
		
		$data["category_options"]=$category_options;
		
		if($this->input->post("add_deal_submit_button"))
		{
			extract($this->input->post());
			
			//(num2 - num1) / num1 * 100
			
			$this->form_validation->set_rules("deal_max_purchase_limit",'Customer Min Purchase Limit','trim|required|numeric');
			
			$this->form_validation->set_rules("deal_max_gift_limit",'Customer Min Gift Limit','trim|required|numeric');
			
			$this->form_validation->set_rules("deal_title",'Deals Title','required');
			
			$this->form_validation->set_rules("deal_face_value",'Deal Face Value','required|numeric');
			
			$this->form_validation->set_rules("deal_price",'Deal Price','required|numeric');
			
			$this->form_validation->set_rules("deal_start_date",'Customer Min Purchase Limit','required');
			
			$this->form_validation->set_rules("deal_end_date",'Customer Min Purchase Limit','required');
			
			$this->form_validation->set_rules("deal_voucher_start_date",'Voucher Valid Start Date','required');
			
			$this->form_validation->set_rules("deal_voucher_end_date",'Voucher Valid End Date','required');
			
			if($this->form_validation->run())
			{
			
				$percentage=round((($deal_face_value-$deal_price)/$deal_face_value)*100);
				
				$deal_start_date=date('Y-m-d H:i:s',strtotime($deal_start_date));
				
				$deal_end_date=date('Y-m-d H:i:s',strtotime($deal_end_date));
				
				$deal_voucher_start_date=date('Y-m-d H:i:s',strtotime($deal_voucher_start_date));
				
				$deal_voucher_end_date=date('Y-m-d H:i:s',strtotime($deal_voucher_end_date));
				
				$slug_title=$this->common_model->create_unique_slug($deal_title, "deals","slug");
				
				$insertdata=array(
									  "deal_title"=>$deal_title,
									  
									  "slug"=>$slug_title,
									  
									  "deal_city"=>$deals_city,
									  
									  "deal_description"=>$deal_description,
									  
									  "deals_highlights"=>$deals_highlights,
									  
									  "deals_fine_prints"=>$deals_fine_prints,
									  
									  "deal_category"=>$deals_category,
									  
									  "deal_price"=>(float)$deal_price,
									  
									  "deal_face_value"=>(float)$deal_face_value,
									  
									  "deal_save_percent"=>(int)$percentage,
									  
									  "deal_merchant_percent"=>$deal_merchant_percent,
									  
									  "deal_groupon_percent"=>$deal_groupon_percent,
									  
									  "deal_start_date"=>$deal_start_date,
									  
									  "deal_end_date"=>$deal_end_date,
									  
									  "deal_voucher_start_date"=>$deal_voucher_start_date,
									  
									  "deal_voucher_end_date"=>$deal_voucher_end_date,
									  
									  "deal_min_count"=>$deal_min_count,
									  
									  "deal_max_count"=>$deal_max_count,
									  
									  "deal_max_purchase_limit"=>$deal_max_purchase_limit,
									  
									  "deal_max_gift_limit"=>$deal_max_gift_limit,
									  
									  "seo_keyword"=>$seo_keyword,
									  
									  "seo_description"=>$seo_description,
									  
									  "quantity"=>$deal_max_count,
									  
									  "merchent"=>$merchants
							  );
				if($_FILES["deal_image"]["name"]!="")
				{
					$config['upload_path'] = './uploads/deals/';
			
					$config['allowed_types'] = 'jpg';
					
					$config['file_name']=$slug_title.".jpg";
					
					$this->load->library('upload',$config);
						
					if (!$this->upload->do_upload("deal_image"))
					{
						$error = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',$error["error"]));
						redirect(admin_url("deals/add"));
					}
					else
					{
						$upload_data = $this->upload->data();
						
					}
					if(count($upload_data!=0))
						$insertdata['deal_image_url']=$upload_data["file_name"];
					
				}
			
			  $result=$this->common_model->insertData("deals",$insertdata);
			  
			  if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Deal Inserted Successfully'));
			  else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Deal Not Inserted'));
			  
			  redirect_admin("deals");
			}
						  
		}
		
		$this->load->view("admin/deals/add",$data);
	}
	function edit($deal_id)
	{
		if($this->input->post("add_deal_submit_button")=="Edit")
		{
		
			extract($this->input->post());
			
			if(isset($editable) && $editable==0)
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
				
				redirect_admin("deals");
			}
			
			$this->form_validation->set_rules("deal_max_purchase_limit",'Customer Min Purchase Limit','trim|required|numeric');
			
			$this->form_validation->set_rules("deal_max_gift_limit",'Customer Min Gift Limit','trim|required|numeric');
			
			$this->form_validation->set_rules("deal_title",'Deals Title','required');
			
			$this->form_validation->set_rules("deal_face_value",'Deal Face Value','required|numeric');
			
			$this->form_validation->set_rules("deal_price",'Deal Price','required|numeric');
			
			$this->form_validation->set_rules("deal_start_date",'Customer Min Purchase Limit','required');
			
			$this->form_validation->set_rules("deal_end_date",'Customer Min Purchase Limit','required');
			
			$this->form_validation->set_rules("deal_voucher_start_date",'Voucher Valid Start Date','required');
			
			$this->form_validation->set_rules("deal_voucher_end_date",'Voucher Valid End Date','required');
			
			if($this->form_validation->run())
			{
				
				$percentage=round((($deal_face_value-$deal_price)/$deal_face_value)*100);
				
				$deal_start_date=date('Y-m-d H:i:s',strtotime($deal_start_date));
				
				$deal_end_date=date('Y-m-d H:i:s',strtotime($deal_end_date));
				
				$deal_voucher_start_date=date('Y-m-d H:i:s',strtotime($deal_voucher_start_date));
				
				$deal_voucher_end_date=date('Y-m-d H:i:s',strtotime($deal_voucher_end_date));
						
				if(isset($old_image) && $old_image!="")
					$old_image=$old_image;
				else
					$old_image=$this->common_model->create_unique_slug($deal_title, "deals","slug");
				
				
				$insertdata=array(
									  "deal_title"=>$deal_title,
									  
									  "deal_city"=>$deals_city,
									  
									  "deal_description"=>$deal_description,
									  
									  "deals_highlights"=>$deals_highlights,
									  
									  "deals_fine_prints"=>$deals_fine_prints,
									  
									  "deal_category"=>$deals_category,
									  
									  "deal_price"=>(float)$deal_price,
									  
									  "deal_face_value"=>(float)$deal_face_value,
									  
									  "deal_save_percent"=>(int)$percentage,
									  
									  "deal_merchant_percent"=>$deal_merchant_percent,
									  
									  "deal_groupon_percent"=>$deal_groupon_percent,
									  
									  "deal_start_date"=>$deal_start_date,
									  
									  "deal_end_date"=>$deal_end_date,
									  
									  "deal_voucher_start_date"=>$deal_voucher_start_date,
									  
									  "deal_voucher_end_date"=>$deal_voucher_end_date,
									  
									  "deal_min_count"=>$deal_min_count,
									  
									  "deal_max_count"=>$deal_max_count,
									  
									  "deal_max_purchase_limit"=>$deal_max_purchase_limit,
									  
									  "deal_max_gift_limit"=>$deal_max_gift_limit,
									  
									  "seo_keyword"=>$seo_keyword,
									  
									  "seo_description"=>$seo_description,
									  
									  "quantity"=>$deal_max_count,
									  
									  "merchent"=>$merchants
							  );
							  
				if($_FILES["deal_image"]["name"]!="")
				{
					$config['upload_path'] = './uploads/deals/';
			
					$config['allowed_types'] = 'jpg';
					
					$config['file_name']=$old_image;
					
					$this->load->library('upload',$config);
					
					unlink($config['upload_path'].$old_image);
					
					if (!$this->upload->do_upload("deal_image"))
					{
						$error = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',$error["error"]));
						redirect(admin_url("deals/add"));
					}
					else
					{
						$upload_data = $this->upload->data();
						
					}
					if(count($upload_data!=0))
						$insertdata['deal_image_url']=$upload_data["file_name"];
						
				}
				
			  $result=$this->common_model->updateTableData("deals",$deal_id,$insertdata);
			  
			  if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Deal Updated Successfully'));
			  else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Deal Not Updated'));
			  
			  redirect_admin("deals");
			}
							  
		}
		$data=array();
		
		$data["title"]="Edit Deals";
		
		$data["open_tab"]='deals_box';
		
		$data["cancel_url"]=admin_url("delas/view");
		
		$data["city_drop_down"]=$this->city_drop_down;
		
		$category_query=$this->common_model->getTableData("category",array("status"=>'1'));
		
		$categories=$category_query->result();
		
		$category_options='<option value="">Select</option>';
		
		foreach($categories as $category)
		{
			$category_options.='<optgroup label="'.$category->name.'">';
			
			$sub_category_query=$this->common_model->getTableData("sub_category",array("parent_id"=>$category->id,"status"=>1));
		
			$sub_categories=$sub_category_query->result();
			
			foreach($sub_categories as $sub_category)
			{
				$category_options.='<option value="'.$sub_category->id.'">'.$sub_category->name.'</option>';
			}
			
		}
		
		$data["category_options"]=$category_options;
		
		$data["edit_id"]=$deal_id;
		
		$data["mode"]='edit';
		
		$deals_detail=$this->common_model->getTableData("deals",array("id"=>$deal_id));
		
		$edit_detail=$deals_detail->result();
		
		$data["edit_detail"]=$edit_detail;
		
		$this->load->view("admin/deals/add",$data);
	}
	function view_deal_ajax()
	{
		$conditions=array();
		
		$this->load->library("Ajax_pagination");
		
		if($this->input->post("search_deal_side")!="")
			$conditions["merchent"]=$this->input->post("search_deal_side");
		if($this->input->post("search_deal_city")!="")
			$conditions["deal_city"]=$this->input->post("search_deal_city");
		if($this->input->post("search_deal_category")!="")
			$conditions["deal_category"]=$this->input->post("search_deal_category");
		if($this->input->post("page")!="" && $this->input->post("page")!=0)
			$start=$this->input->post("page");
		else
			$start =0;
		//$start = $this->uri->segment(4,0);
		
		if($start > 0)
		  $start = $start;
		  
		$page_rows=  10;
		
		$limit[0]= $page_rows;
		
		if($start > 0)
		   $limit[1]= ($start-1) * $page_rows;
		else
		    $limit[1]= $start * $page_rows;  
		
		$order[0]='id';
		
		$order[1]= 'asc';
		
		$data=array();
		
		//$config['base_url'] = admin_url('/dealimporter/view_deals');
		
		$total_count=0;
		
		$results=$this->common_model->get_all_deals_detail($conditions,NULL,NULL,$limit,$order);
		
		$total_count_query=$this->common_model->get_all_deals_detail($conditions,NULL,NULL,NULL,NULL);
		
		$total_count=$total_count_query->result();
		
		$deals=$results->result();
		
		$config['base_url'] = admin_url('load_ajax_page');
		
	   	$config['per_page'] = $page_rows;
		
		$config['cur_page']     = $start;
		
		$config['total_rows'] = count($total_count);
		 
		$this->ajax_pagination->initialize($config);
		
		$data['pagination_outbox']   = $this->ajax_pagination->create_links2(false,'view_deals');
		
		$data['totaltransactions'] =  count($deals);
		
		$data["deals"]=$deals;
		
		$this->load->view("admin/deals/view_deals_ajax",$data);
	}
	function delete_deal_ajax()
	{
		$del_values=array();
		
		$del_value=$this->input->post("check_box_value");
		
		$del_values=explode(",",$del_value);
		
		$deleted_values=array();
		
		foreach($del_values as $del_value)
		{
			if($this->common_model->delete_deal($del_value))
			{
				$deleted_values[]=$del_value;
			}
		}
		
		if(!$this->config->item("product_mode"))
		{
			exit(0);
		}
		
		if(count($deleted_values)!=0)
		{
			echo implode(",",$deleted_values);
		}
		else
			echo 0;
	}
}
?>
