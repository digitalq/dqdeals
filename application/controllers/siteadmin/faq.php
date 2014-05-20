<?php
/**
 * Reverse bidding system page Class
 *
 * Permits admin to handle the static pages of the site
 *
 * @package		Reverse bidding system
 * @subpackage	Controllers
 * @category	Skills 
 * @author		Cogzidel Dev Team
 * @version		Version 1.0
 * @created		December 22 2008
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
class Faq extends CI_Controller {

	//Global variable  
    public $outputData;		//Holds the output data for each view
	   
	/**
	* Constructor 
	*
	* Loads language files and models needed for this controller
	*/
	function Faq()
	{
	   parent::__construct();
	   
	   
	   //$this->config->db_config_fetch();
	   
	    //Debug Tool
	   	//$this->output->enable_profiler=true;
		
		//Loading the lang files
		$this->load->database();
		
		$this->load->library('config_data');
		
		$this->config_data->db_config_fetch();
		
		$language_code = $this->config->item('language_code');
		
		$this->lang->load('admin/common',$language_code);
	    
		$this->lang->load('admin/validation',$language_code);
		
		
		//Load Models Common to all the functions in this controller
		$this->load->model('common_model');
		$this->load->helper('url');
		//$this->load->model('skills_model');
		$this->load->helper('auth_helper');
		$this->load->helper('date_helper');
		$this->load->library('form_validation');
		$this->load->library('session');
		
		//load model
		$this->load->model('faq_model');
		
		//Check For Admin Logged in
		if(!isAdmin())
			redirect_admin('admin');
           //Get Config Details From Db
		

	}//Controller End 
	
		// --------------------------------------------------------------------
	
	/**
	 * Loads Faqs settings page.
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function index()
	{
	
	}
	function addFaq()
	{
		//load language
		$this->lang->load('admin/page');
		
		
		
		//load validation library
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		
		if($this->input->post('addFaq'))
		{	
			if(!$this->config->item("product_mode"))
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
				redirect_admin('faq/viewFaqs');
			}
		
			//Set rules
			$this->form_validation->set_rules('question','lang:page_title_validation','required|trim|xss_clean');
			
			$this->form_validation->set_rules('faq_content','lang:page_content_validation','required|trim|xss_clean');
			
			if($this->form_validation->run())
			{	
				  //prepare insert data
				  $insertData                  	  	= array();
				  
				  $insertData['question'] 		= $this->input->post('question');
				  
				  $insertData['faq_content']  	= $this->input->post('faq_content');
				

				  //Add Groups
				  $this->faq_model->addfaq($insertData);
				  
				  //Notification message
				  $this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',$this->lang->line('added_success')));
				   redirect_admin('faq/viewFaqs');
		 	} 
		} //If - Form Submission End
	
		$this->outputData["open_tab"]="faq_manage_box";
		
		$this->outputData["title"]="Add Faq";
		
		
		//Load View
	   	$this->load->view('admin/faq/addFaq',$this->outputData);
	
	}//Function addPage End 
	
	// --------------------------------------------------------------------
	
	/**
	 * Loads Manage Static Pages View.
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function viewFaqs()
	{	
        
		//load language
		$this->lang->load('admin/page');
		
		//Get Groups
		$this->outputData['faqs']	=	$this->faq_model->getFaqs();
			
		//Load View
		$this->outputData["open_tab"]="faq_manage_box";
		
	   	$this->load->view('admin/faq/viewFaq',$this->outputData);
		
		
	   
	}//End of 	// --------------------------------------------------------------------
	
	// --------------------------------------------------------------------
	
	/**
	 * delete Faq.
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function deletePage()
	{	
		$id = $this->uri->segment(4,0);
		
	if($id==0)	
	{
		$getpages	=	$this->page_model->getPages();
		$pagelist  =   $this->input->post('pagelist');
		if(!empty($pagelist))
		{	
				foreach($pagelist as $res)
				 {
					
					$condition = array('page.id'=>$res);
					$this->page_model->deletePage(NULL,$condition);
				 }
			} 
		else
		{
		$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',$this->lang->line('Please select Page')));
	    redirect_admin('page/viewPages');
		}
	}
	else
	{
	$condition = array('page.id'=>$id);
	$this->page_model->deletePage(NULL,$condition);
	}		
		//Notification message
	    $this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',$this->lang->line('delete_success')));
	    redirect_admin('page/viewPages');
	}
	//Function end
	
	/**
	 * Loads Manage Static Pages View.
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function editFaq($id)
	{	
        
		//load language
		$this->lang->load('admin/page');
		
				//Get id of the category	
	   $id = is_numeric($id)?$id:0;
		
		
		//load validation library
		$this->load->library('form_validation');
		
		//Load Form Helper
		$this->load->helper('form');
		
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		
		if($this->input->post('editfaq'))
		{	
			if(!$this->config->item("product_mode"))
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Forbidden'));
				redirect_admin('faq/viewFaqs');
			}
           	//Set rules
			$this->form_validation->set_rules('question','lang:page_title_validation','required|trim|xss_clean');
			
			$this->form_validation->set_rules('faq_content','lang:page_content_validation','required|trim|xss_clean');
			
			if($this->form_validation->run())
			{	
				  //prepare update data
				  $updateData                  	= array();	
				  
			      $updateData['question'] 		= $this->input->post('question');
				  
				  $updateData['faq_content']  	= $this->input->post('faq_content');
				  
				  //Edit Faq Category
				  $updateKey 					= array('id'=>$id);
				  
				  $this->faq_model->updateFaq($updateKey,$updateData);
				  
				  //Notification message
				  
				  $this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',$this->lang->line('updated_success')));
				  
				  redirect_admin('faq/viewFaqs');
		 	}
			
		} //If - Form Submission End
		
		//Set Condition To Fetch The Faq Category

		$condition = array('id'=>$id);
			
	   //Get Groups
		$this->outputData['faqs']	=	$this->faq_model->getfaqs($condition);
		
		$this->outputData["open_tab"]="faq_manage_box";
		//Load View
	   	$this->load->view('admin/faq/editFaq',$this->outputData);
   
	}//End of editPage
	
}
//End  Page Class

/* End of file Page.php */ 
/* Location: ./app/controllers/admin/Page.php */