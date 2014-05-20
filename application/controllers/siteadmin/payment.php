<?php
class Payment extends CI_Controller
{
	function Payment()
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
		
		$this->load->model('common_model');
		
		$this->load->model('auth_model');
		
		$this->load->library('session');
		
		if(!isAdmin())
			redirect_admin("admin");
	}
	function add()
	{
		if($this->input->post("paypent_gateway_submit_button")=="Add")
		{
			extract($this->input->post());
			
			$gateway_table=$this->common_model->getTableData("gateway_type",array("id"=>$gateway_type))->result();
			
			$table_name='';
			
			if(count($gateway_table)!=0)
			{
				
				$table_name=$gateway_table[0]->table;
				
				if($table_name!="")
				{
					//$query = $this->db->query("SELECT * FROM ".$table_name);
					
					//$fields = $query->list_fields();
					
					$gateway_data=array("name"=>$name,"gateway_type"=>$gateway_type,"email_config"=>$email_configuration_id);
					
					$gateway=$this->common_model->insertData("payment_gateways",$gateway_data);
					
					if($gateway!=0)
					{
						$insert_data=array("gateways"=>$gateway);
						
						$result=$this->common_model->insertData($table_name,$insert_data);
						
						if($result)
						{
							$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',"The pay gateway was added successfully!"));
							
							redirect_admin("payment/pay_gateway_edit/".$gateway);
						}
					}
					
					exit;
					
				}
			}
			
			//paypal
		}
		$data["title"]="Add payment Gateway";
		
		$data["open_tab"]='payment_box';
		
		$data["cancel_url"]=admin_url("payment/manage");
		
		$this->load->view("admin/payment/add",$data);
	}
	function pay_gateway_edit($id)
	{
		if($this->input->post("add_submit")=="Save")
		{
			if(!$this->config->item("product_mode"))
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
				redirect_admin("payment/manage");
			}
			
			extract($this->input->post());
			
			$fields=array();
			
			$query = $this->db->query("SELECT * FROM ".$table);
					
			$fields = $query->list_fields();
			
			$update_data=array();
			
			if(count($fields)!=0)
			{
			
				for($i=0;$i<count($fields);$i++)
				{
					if($fields[$i]=="updated_date")
					{
						$update_data["updated_date"]=date('Y-m-d h:i:s');
					}
					elseif($fields[$i]!="id")
					{
						if($this->input->post($fields[$i])!='')
							$update_data[$fields[$i]]=$this->input->post($fields[$i]);
					}
					
				}
				
				$result=$this->common_model->updateTableData($table,'',$update_data,array("gateways"=>$id));
				
				if($result)
				{
					$updatedata=array("name"=>$name);
					
					$this->common_model->updateTableData("payment_gateways",$id,$updatedata);	
					
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','The pay gateway was updated successfully!'));
				}
				else
					$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','The pay gateway Not Updated'));
				
			}
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Record not found'));
				
			redirect_admin("payment/manage");
			
			exit;
			
		}
		$data["title"]="Add payment Gateway";
		
		$data["open_tab"]='payment_box';
		
		$data["cancel_url"]=admin_url("payment/manage");
		
		$pay_gateway_data=$this->common_model->getTableData("payment_gateways",array("id"=>$id))->result();
		
		if(count($pay_gateway_data)!=0)
		{
			$gateway_table=$this->common_model->getTableData("gateway_type",array("id"=>$pay_gateway_data[0]->gateway_type))->result();
			
			$table=$gateway_table[0]->table;
			
			$data["payment_type"]=$gateway_table[0]->name;
			
			$data["title"]="edit payment Gateway ".$pay_gateway_data[0]->name;
			
			$data["gate_way_name"]=$pay_gateway_data[0]->name;
			
			$inner_data=array();
			
			$inner_data["edit_details"]=$this->common_model->getTableData($table,array("gateways"=>$id))->result();
			
			$data["pament_type_form"]=$this->load->view("admin/payment/".$table,$inner_data,TRUE);
			
			$this->load->view("admin/payment/pay_gateway_edit",$data);
		}
		else
		{
			$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Record not found'));
			
			redirect_admin("payment/manage");
		}
	}
	function manage()
	{
		$data["title"]="Manage Pay Gateways";
		
		$data["open_tab"]='payment_box';
		
		$payment_gateways=$this->common_model->getTableData("payment_gateways")->result();
		
		$data["payment_gateways"]=$payment_gateways;
		
		$this->load->view("admin/payment/manage",$data);
	}
	function gate_way_log()
	{
		$data["title"]="Logs for All Gateways";
		
		$data["open_tab"]='payment_box';
		
		$payment_logs=$this->common_model->getTableData("payment_log")->result();
		
		$data["payment_logs"]=$payment_logs;
		
		$this->load->view("admin/payment/gate_way_log",$data);
		
	}
	function view_pay_log($id)
	{
		$data["title"]="Logs for All Gateways";
		
		$data["open_tab"]='payment_box';
		
		$where_class=array("id"=>$id);
		
		$payment_log=$this->common_model->getTableData("payment_log",$where_class)->result();
		
		$data["payment_log_data"]=$payment_log;
		
		$data["cancel_url"]=admin_url("payment/gate_way_log");
		
		$this->load->view("admin/payment/view_pay_log",$data);
	}
	function orders()
	{
		$data["title"]="Orders";
		
		$data["open_tab"]='payment_box';
		
		$payment_logs=$this->common_model->getTableData("payment_log")->result();
		
		$data["payment_logs"]=$payment_logs;
		
		$this->load->view("admin/payment/orders",$data);
	}
	function paypal()
	{
		if($this->input->post("paypal_set_submit")=="Save")
		{
			extract($this->input->post());
			
			$update_array=array("account_name"=>$account_name,"account_email"=>$account_email,"paypal_mode"=>$paypal_option);
			
			$result=$this->common_model->updateTableData("paypal",1,$update_array);
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Paypal Settings Updated Successfully'));
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Paypal Settings Not Updated'));
				
			redirect_admin("payment/paypal");
		}
		
		$paypal_data=$this->common_model->getTableData("paypal")->result();
		
		$data=array();
		
		$data["title"]="Paypal Setting";
		
		$data["paypal_data"]=$paypal_data;
		
		$data["open_tab"]='payment_box';
		
		$data["cancel_url"]=admin_url("home");
		
		$this->load->view("admin/payment/paypal",$data);
	}
	
	function coupon()
	{
		$data["title"]="Coupon Mangement";
		
		$data["open_tab"]='payment_box';
		
		$coupon_details=$this->common_model->getTableData("coupon")->result();
		
		$data["coupon_details"]=$coupon_details;
		
		$this->load->view("admin/payment/coupon",$data);
	}
}
?>