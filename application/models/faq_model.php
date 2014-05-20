<?php
/**
 * Reverse bidding system Faq_model Class
 *
 * Help to handle tables related to static Faqs of the system.
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
 class Faq_model extends CI_Model {
	 
	/**
	 * Constructor 
	 *
	 */
	  function Faq_model() 
	  {
		parent::__construct();
				
      }//Controller End
	 
	// --------------------------------------------------------------------
		
	/**
	 * delete Faq
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function deleteFaq($id=0,$conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);
		 $this->db->delete('faq');
		 
	 }//End of addFaqCategory Function
	 
	// --------------------------------------------------------------------
	


		

	/**
	 * Get Static Faqs
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
		// Puhal changes Start. For the popup Faqs Privacy Policy and the Company & Conditions (Sep 17 Issue 2)	 
	 function getFaqs($conditions=array(),$like=array(),$like_or=array())
	 {
	 	//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);
			
		//Check For like statement
	 	if(is_array($like_or) and count($like_or)>0)		
	 		$this->db->or_like($like_or);
// Puhal changes End. For the popup Faqs Privacy Policy and the Company & Conditions (Sep 17 Issue 2)			
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
		
		$this->db->from('faq');
	 	
		$result = $this->db->get();
		return $result;
		
	 }//End of getFaqs Function

	 
	 // --------------------------------------------------------------------
		
	/**
	 * Add  Static Faq
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function addFaq($insertData=array())
	 {
	 	$this->db->insert('faq', $insertData);
		 
	 }//End of addFaqCategory Function

	 
	// --------------------------------------------------------------------
		
	/**
	 * Update Static Faq
	 *
	 * @access	private
	 * @param	array	an associative array - for update key values
	 * @param	array	an associative array of update data
	 * @return	void
	 */
	 function updateFaq($updateKey=array(),$updateData=array())
	 {
	 	 $this->db->update('faq',$updateData,$updateKey);
		 
	 }//End of updateFaq Function 
	 

}
// End Faq_model Class
   
/* End of file Faq_model.php */ 
/* Location: ./app/models/Faq_model.php */