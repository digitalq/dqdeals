<?php
class Merchant extends CI_Controller
{
	function Merchant()
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
		
		$config['upload_path'] = './uploads/web_site_logo/';
		
		$config['allowed_types'] = 'gif|jpg|png';
		
		$config['max_width'] = '150';
		
		$config['max_height'] = '75';
		
		$this->load->library('upload', $config);
		
		if(!isAdmin())
			redirect_admin("admin");
	}
	function index()
	{
		$data['title']='Manage Merchant';
		
		$data['open_tab']='ventor_box';
		
		$data['merchants']=$this->common_model->getTabledata("merchants",array('status'=>1))->result();
		
		$this->load->view("admin/merchant/view",$data);
	}
	function view()
	{
		$data['title']='Manage Merchant';
		
		$data['open_tab']='ventor_box';
		
		$data['merchants']=$this->common_model->getTabledata("merchants",array('status'=>1))->result();
		
		$this->load->view("admin/merchant/view",$data);
	}
	function add()
	{
		if($this->input->post("add_merchant")=="yes")
		{
			if(!$this->config->item("product_mode"))
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
				redirect_admin("merchant");
			}
			
			extract($this->input->post());
			
			$insertData=array("company_name"=>$company_name,
							  "first_name"=>$first_name,
							  "last_name"=>$last_name,
							  "email"=>$email,
							  "site_url"=>$site_url,
							  "phone_no"=>$contact_no,
							  "zipcode"=>$zip_code,
							  "address"=>$address,
							  "company_detail"=>$comapny_detail);
			
			if($_FILES["website_image"]["name"]!="")
			{
					
				if (!$this->upload->do_upload("website_image"))
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',$error["error"]));
					redirect(admin_url("merchant/add"));
				}
				else
				{
					$upload_data = $this->upload->data();
					
				}
				if(count($upload_data!=0))
					$insertData['logo']=$upload_data["file_name"];
					
			}
			$result=$this->common_model->insertData("merchants",$insertData);
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',ucwords("merchant inserted successfully")));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',ucwords("merchant not inserted")));
				
			redirect_admin("merchant");
			
		}
		$data['title']='Add Merchant';
		
		$data['open_tab']='ventor_box';
		
		$data['cancel_url']=admin_url("merchant");
		
		$this->load->view("admin/merchant/add",$data);
	}
	function edit($id)
	{
		
		if($this->input->post("edit_merchant")=="yes")
		{
			
			if(!$this->config->item("product_mode"))
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
				redirect_admin("merchant");
			}
			
			extract($this->input->post());
			
			$insertData=array("company_name"=>$company_name,"first_name"=>$first_name,"last_name"=>$last_name,"email"=>$email,"site_url"=>$site_url,"phone_no"=>$contact_no,"zipcode"=>$zip_code,"address"=>$address,"company_detail"=>$comapny_detail,"email"=>$email);
			
			if($_FILES["website_image"]["name"]!="")
			{
				if (!$this->upload->do_upload("website_image"))
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',$error["error"]));
					redirect_admin("merchant/edit/".$id);
				}
				else
				{
					unlink("uploads/web_site_logo/".$exsits_image);
					
					$upload_data = $this->upload->data();
					
				}
				if(count($upload_data!=0))
				{
					$insertData['logo']=$upload_data["file_name"];
				}
					
			}
			
			$result=$this->common_model->updateTableData("merchants",$id,$insertData);
			
			//var_dump($result);
			
			//exit;
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',ucwords("merchant Updated successfully")));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',ucwords("No Changes")));
				
			redirect_admin("merchant");
			
		}
		
		$data['title']='Edit Merchant';
		
		$data['open_tab']='ventor_box';
		
		$data['cancel_url']=admin_url("merchant");
		
		$conditions=array("id"=>$id);
		
		$mergent_details=$this->common_model->getTableData("merchants",$conditions)->result();
		
		if(count($mergent_details)!=0)
			$data["mergent_details"]=$mergent_details;
		else
			$data["mergent_details"]="not_found";	
			
		$data["mergent_id"]=$id;	
		
		$this->load->view("admin/merchant/add",$data);
	}
}
?>