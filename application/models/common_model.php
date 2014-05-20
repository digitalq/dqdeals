<?php
/**
 * Reverse bidding system Common_model Class
 *
 * helps to achieve common tasks related to the site like flash message formats,pagination variables.
 *
 * @package		Reverse bidding system
 * @subpackage	Models
 * @category	Common_model 
 * @author		Cogzidel Dev Team
 * @version		Version 1.0
 * @link		http://www.cogzidel.com
 
  <Reverse bidding system> 
    Copyright (C) <2009>  <Cogzidel Technologies>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>
    If you want more information, please email me at bala.k@cogzidel.com or 
    contact us from http://www.cogzidel.com/contact 
  
 */ 
	 class Common_model extends CI_Model {
	 
	/**
	 * Constructor 
	 *
	 */
	  function Common_model() 
	  {
		parent::__construct();
		
		//Load Neccessary Model
		$this->load->model('user_model');
		// load model
	   $this->load->model('page_model');
	    $this->load->model('auth_model');
				
      }//Controller End
	  
	// --------------------------------------------------------------------
	
	/**
	 * Set Style for the flash messages
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message 
	 * @return	string	flash message with proper style
	 */
	 function flash_message($type,$message)
	 {
	 	switch($type)
		{
			case 'success':
					$data = '<div class="message"><div class="success">'.$message.'</div></div>';
					break;
			case 'error':
					$data = '<div class="message"><div class="error">'.$message.'</div></div>';
					break;		
		}
		return $data;
	 }//End of flash_message Function
	 
	 	 
 	// --------------------------------------------------------------------
	
	/**
	 * Set Style for the flash messages in admin section
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message 
	 * @return	string	flash message with proper style
	 */
	 function admin_flash_message($type,$message)
	 {
	 	switch($type)
		{
			case 'success':
					$data = '<div class="message"><div class="success">'.$message.'</div></div>';
					break;
			case 'error':
					$data = '<div class="message"><div class="error">'.$message.'</div></div>';
					break;		
		}
		return $data;
	 }//End of flash_message Function
	 
	// --------------------------------------------------------------------
	
	/**
	 * Set page Title And Meta Tags For The Entire Site
	 *
	 * @access	public
	 * @param	nil
	 * @return	array	page title and meta tags content
	 */
	 function getPageTitleAndMetaData()
	 {
	 	$data['page_title'] 			= $this->config->item('site_title');
		$data['meta_keywords']			= 'Outsource your projects to freelance programmers and designers at cheap prices. ';
		$data['meta_description']		= 'Outsource your projects to freelance programmers and designers at cheap prices. Freelancers will compete for your business. Get programming done for your site in php, mysql, xml, perl/cgi, javascript, asp, plus web design, search engine optimization, marketing, writing, job listings and so much more.';	
		
		return $data;
	 }//End of getPageTitleAndMetaData Function
	 
	// --------------------------------------------------------------------
	
	
	/**
	 * Set page Title And Meta Tags For The Entire Site
	 *
	 * @access	public
	 * @param	nil
	 * @return	array	page title and meta tags content
	 */
	 function getPageTitle($condition)
	 {
	 			
		if(count($condition) > 0)		
	 		$this->db->where($condition);
		
		$this->db->from('categories');
	 	$this->db->select('categories.page_title,categories.meta_keywords,categories.meta_description');
		$result = $this->db->get();
		
		return $result;
	 }//End of getPageTitleAndMetaData Function
	 
	// --------------------------------------------------------------------
	
		
	/**
	 * Get Countries
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getCountries($conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
		
		$this->db->from('country');
	 	$this->db->select('country.id,country.country_symbol,country.country_name');
		$result = $this->db->get();
		return $result;
	 }//End of getCountries Function
	 
	// --------------------------------------------------------------------
	
	
		
	/**
	 * Get getEncryptedString
	 *
	 * @access	private
	 * @param	string 
	 * @return	object	object with result set
	 */
	 function getEncryptedString($string='')
	 {
		
		if($string!='')
			$string_hash = $this->encrypt->encode($string);	
				
		else 
			$string_hash = '';	
			
		return $string_hash;
	 }//End of getEncryptedString Function	
	 
	// --------------------------------------------------------------------
		
	/**
	 * Get DecryptedString
	 *
	 * @access	private
	 * @param	string	conditions to fetch data
	 * @return	object	object with result set
	 */
	  function getDecryptedString($string='')
	 {
		
		
		if($string!='')
		{
			$string_hash = $this->encrypt->decode($string);	
			//echo $string_hash;exit;
		}	
		else 
			$string_hash = '';	
		return $string_hash;
	 }//End of getDecryptedString Function
	 
	// --------------------------------------------------------------------
		
	/**
	 * Get getLoggedInUser
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	  function getLoggedInUser()
	 {

	 	$user = '';

		if($this->session->userdata('id'))
		{
			$condition = array('id'=>$this->session->userdata('id'));
			
			$query = $this->user_model->getUsers($condition);
			
			if($query->num_rows()>0)
			{
				$user = $query->row();				
			}			
		} //Switch End
		
		return $user;
	 }//End of getDecryptedString Function
	 // --------------------------------------------------------------------
	
		
	/**
	 * Get getPages
	 *
	 * @access	public
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getPages()
	 {
	   $conditions = array('page.is_active'=> 1);
	   $pages                      = array();
       $pages['staticPages']       =$this->page_model->getPages($conditions);
	   return $pages['staticPages'];
	   
	 }
	 
	 /**
	 * Get getPages
	 *
	 * @access	public
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getSitelogo()
	 {
	   $conditions = array('settings.code'=>'SITE_LOGO');
	   $data                      = array();
	   $this->db->where($conditions);
	   $this->db->from('settings');
	   $this->db->select('settings.string_value');
	   $result = $this->db->get();
       $data['site_logo']         =	$result->result();
	   return $data;
	   
	 }
	 	 
	 
	  function getTableData($table='',$conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array(),$like1=array(),$order = array(),$conditions1=array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		
		//Check For Conditions
	 	if(is_array($conditions1) and count($conditions1)>0)		
	 		$this->db->or_where($conditions1);	
			
		//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);	
		
		if(is_array($like1) and count($like1)>0)

			$this->db->or_like($like1);	
			
		//Check For Limit	
		if(is_array($limit))		
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}	
		
		
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
		{
			$this->db->order_by('id', 'desc');
		}
		//Check for Order by
		if(is_array($order) and count($order)>0)
			$this->db->order_by($order[0], $order[1]);	
			
		$this->db->from($table);
		
		//Check For Fields	 
		if($fields!='')
		 
				$this->db->select($fields);
		
		else 		
	 		$this->db->select();
			
		$result = $this->db->get();
		
	//pr($result->result());
		return $result;
		
	 }	 
	 
	 	 function deleteTableData($table='',$conditions=array())
	 {
	    //Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$this->db->delete($table);
		return $this->db->affected_rows(); 
		 
 	 }//End of deleteTableData Function
	 
	 
	 function insertData($table='',$insertData=array())
	 {
	 	//return $this->db->insert($table,$insertData);
		
		$result=$this->db->insert($table,$insertData);
		if($result)
			return $this->db->insert_id();
		else
			return 0;
	 }//End of insertData Function
	 
	 
	  function updateTableData($table='',$id=0,$updateData=array(),$conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);
		
		$this->db->update($table, $updateData);
			
		return $this->db->affected_rows();
		 
	 }//End of updateTableData Function
	 
	 function get_social_data($field_value)
	 {
	 	$where=array("name"=>$field_value);
		
	 	$social_site_settings=$this->getTableData("social_site_settings",$where)->result_array();
		
		if(isset($social_site_settings[0]["value"]))
			return $social_site_settings[0]["value"];
		else
			return '';
	 }
	function create_unique_slug($string, $table,$filed_name)
	{
		$slug = url_title($string);
		$slug = strtolower($slug);
		$i = 0;
		$params = array ();
		$params[$filed_name] = $slug;
		if ($this->input->post('id')) {
			$params['id !='] = $this->input->post('id');
		}
		
		while ($this->db->where($params)->get($table)->num_rows()) {
			if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
				$slug .= '-' . ++$i;
			} else {
				$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
			}
			$params [$filed_name] = $slug;
			}
		return $slug;
	} 	 
	function get_one_value_by_id($id,$table_name)
	{
		if($id==0 or $id=="")
			return false;
			
		$this->db->where('id =', $id);
				
		$names=$this->db->get($table_name,"1");
		
		return $names; 
	}
	function change_status($table_name,$id,$update_data)
	{
		if($id=="" or $id==0)
			return false;
		if($table_name=="")
			return false;
			
		$this->db->where('id', $id);
		
		$this->db->update($table_name,$update_data);
		
		return true;
	}
	function edit_one_value($id,$table_name,$insertData=array())
	{
		if($id=="" or $id==0)
			return false;
		if($table_name=="")
			return false;
			
		$this->db->where('id', $id);
		
		$this->db->update($table_name,$insertData);
		
		return true;
	}
	 function get_all_deals_detail($conditions=array(),$fields='',$like=array(),$limit=array(),$order=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
		
		if(is_array($like) and count($like)>0)
			$this->db->like($like);	
		
		//Check For Limit	
		if(is_array($limit))		
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}
		if(is_array($order) and count($order)>0)			
		   $this->db->order_by($order[0],$order[1]);
		else   
		   $this->db->order_by('id','desc');	
		
		
		//Check For Fields	 
		if($fields!='')
				$this->db->select($fields);
				
		$result = $this->db->get('deals');
		
		return $result;
	 }//End of getTransactions Function
	 function get_dealsite_details($id='')
	{
		if($id!=0 or $id!="")
			$this->db->where("id =",$id);
		
		$websites=$this->db->get("merchants");		
		
		return $websites->result();
	}
	
	function delete_deal($id)
	{
		return $this->db->delete('deals', array('id' => $id)); 
	}
}


// End Common_model Class
   
/* End of file Common_model.php */ 
/* Location: ./app/models/Common_model.php */
?>