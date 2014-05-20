<?php
/**
 * Reverse bidding system Buyer Class
 *
 * Buyer related functions are handled by this controller.
 *
 * @package		Reverse bidding system
 * @subpackage	Controllers
 * @category	Buyer 
 * @author		Cogzidel Dev Team
 * @version		Version 1.0
 * @created		December 31 2008
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
class Page extends CI_Controller {

	//Global variable  
    public $outputData;		//Holds the output data for each view
	public $loggedInUser;
	
	var $city_drop_down;
		
	/**
	 * Constructor 
	 *
	 * Loads language files and models needed for this controller
	 */
	function Page()
	{
		parent::__construct();
		
		//Get Config Details From Db
		$this->load->database();
		
		$this->load->library('config_data');
		
		$this->config_data->db_config_fetch();
		
	   //Manage site Status 
		if($this->config->item('site_status') == 1)
		redirect('offline');
		
		
	   //Debug Tool
	   //$this->output->enable_profiler=true;		
		
		//Load Models Common to all the functions in this controller
    	$this->load->helper('url');
		
		$this->load->helper('form');
		
		$this->load->helper('auth_helper');
		
		$this->load->helper('common_helper');
		
		$this->load->model('common_model');
		
		$this->load->model('common_model');
		
		$this->load->model('auth_model');
		
		$this->load->library('session');
		$this->load->model('skills_model');
		
		
		//Page Title and Meta Tags
		$this->outputData = $this->common_model->getPageTitleAndMetaData();
		
		//Get Logged In user
		$this->loggedInUser					= $this->common_model->getLoggedInUser();
		$this->outputData['loggedInUser'] 	= $this->loggedInUser;
		
		//Get Footer content
		$conditions = array('page.is_active'=> 1);
		$this->outputData['pages']	=	$this->page_model->getPages($conditions);	
		
		//Get Latest Projects
		$limit_latest = $this->config->item('latest_projects_limit');
		
		//language file
		//$this->lang->load('enduser/common', $this->config->item('language_code'));
		
		$city_where=array("status"=>1);
		
		$city_orderby=array("name","asc");
		
		$this->city_drop_down=dropdown_box("city","slug","name",$city_where,$city_orderby);
		
	}//Controller End 
	// --------------------------------------------------------------------
	
	/**
	 * Loads static page.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */ 
	function index($page)
	{	
			
		  // Operation on uri_segment(2)
		
	     	// load lang file
		    
		  	 $conditions = array('page.url'=> $this->uri->segment(2));
			 $this->outputData['page_content']	=	$this->page_model->getPages($conditions);	
				
			 if($this->uri->segment(2)=='')	
			 {
				$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$this->lang->line('error_message')));
				redirect('info');
			 }
			 if($this->uri->segment(2) == 'sitemap'){
			 
			 	//Get Latest Projects
				$limit_latest = $this->config->item('latest_projects_limit');
				$limit3 = array($limit_latest);
				$this->outputData['latestProjects']	= $this->skills_model->getLatestProjects($limit3);
				
				//Get Categories
				$this->outputData['categories']	=	$this->skills_model->getCategories();
				
			    $this->load->view('siteMap',$this->outputData);
			}
			 else	
			    $this->load->view('page',$this->outputData);
		
	}//End of function
//-----------------------------------------------------------------------	
	
	/**
	 * Loads static page.
	 *
	 * @access	public
	 * @param	nil
	 * @return	void
	 */
	function view()
	{
	   // get the page uri name
	   $page_url					= $this->uri->segment(3);
	   $conditions = array('page.url'=>$page_url);
	   $this->outputData['page_content']	=	$this->page_model->getPages($conditions);	
	  //Load View	
	   $this->load->view('page',$this->outputData);
	} //function end 
//-----------------------------------------------------------------------------

}
//End page Class
/* End of file faq.php */ 
/* Location: ./app/controllers/page.php */