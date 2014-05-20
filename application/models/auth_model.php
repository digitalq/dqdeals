<?php
/**
 * Cogzidel Yipit Clone Auth_model Class
 *
 * This Model will take care of handling sessions of the user.
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
class Auth_model extends CI_Model {
	 
	/**
	 * Constructor 
	 *
	 */
	  function Auth_model() 
	  {
		parent::__construct();
				
      }//Controller End
	 
	// --------------------------------------------------------------------
		
	/**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function loginAsAdmin($conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
			 
	 	$this->db->select('users.id');
		$result = $this->db->get('users');
		if($result->num_rows()>0)
			return true;
		else 
			return false;	
	 }//End of loginAsAdmin Function
	 
 	// --------------------------------------------------------------------
		
	/**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function setAdminSession($conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
			 
	 	$this->db->select('users.id,users.user_name,users.level');
		
		$result = $this->db->get('users');
		
		if($result->num_rows()>0)
		{
			$row = $result->row();
			$values = array ('user_id'=>$row->id,'logged_in'=>TRUE,'admin_role'=>'admin'); 
			$this->session->set_userdata($values);
		}
		
	 }//End of setAdminSession Function
	 
	// --------------------------------------------------------------------
		
	/**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function setUserSession($row=NULL)
	 {
	 	$values = array('user_id'=>$row->id,'logged_in'=>TRUE,'email'=>$row->email,"level"=>'3');
		
		//$this->session->set_userdata($values);
		$values =array();
				
	 	switch($row->level)
		{
			case '1':
			  
				$values = array('user_id'=>$row->id,'logged_in'=>TRUE,'admin_role'=>'admin');
				$this->session->set_userdata($values);
				break;
				
			case '3':
			
				$values = array('user_id'=>$row->id,'logged_in'=>TRUE,'level'=>'3');
				$this->session->set_userdata($values);
				break;	
		}
	 	
	 }//End of setUserSession Function
	 
	 
	 
	 // Puhal Changes Start Function added for the Remenber me option  (Sep 17 Issue 3)	
	 
	  function setUserCookie($name='',$value ='',$expire = '',$domain='',$path = '/',$prefix ='')
	 {
	 		 $cookie = array(
                   'name'   =>$name,
                   'value'  => $value,
                   'expire' => $expire,
                   'domain' => $domain,
                   'path'   => $path,
                   'prefix' => $prefix,
               );
			  set_cookie($cookie); 
	 }//End of setUserCookie Function	

		
		
	 function getUserCookie($name='')
	 {
		 $val=get_cookie($name,TRUE); 
		return $val;
	 }//End of getUserCookie Function		
	 
 
	  function clearUserCookie($name=array())
	 {
	 	foreach($name as $val)
		{
			delete_cookie($val);
		}	
	 }//End of clearSession Function*/
	 
	// Puhal Changes End Function added for the Remenber me option  (Sep 17 Issue 3)	
	 
	 
	// --------------------------------------------------------------------
		
	/**
	 * clearSession
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function clearAdminSession()
	 {
	 
	 	$array_items = array ('admin_id' => '','logged_in_admin'=>'','admin_role'=>'');
	    $this->session->unset_userdata($array_items);
		
	 }//End of clearSession Function
	 
	// --------------------------------------------------------------------
		
	/**
	 * clearUserSession
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function clearUserSession()
	 {
	 	$array_items = array('user_id' => '','logged_in'=>'','role'=>'');
		$this->session->unset_userdata($array_items);
	 }//End of clearSession Function
	 
}
// End Auth_model Class
   
/* End of file Auth_model.php */ 
/* Location: ./app/models/Auth_model.php */