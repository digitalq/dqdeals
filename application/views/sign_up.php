<?php
	$this->load->view("header");
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#sign_up").validate({errorElement:"p",errorClass:"Frm_Error_Msg",focusInvalid: false})
}) 
</script>
<div class="clsFloatLeft clearfix clsSignUp_Blk" id="Main_left">
    <div class="clsSignUp_Form clsFloatLeft">
    <h1 class="Main_Tittle"><span><?php echo $title?> or </span> <a href="<?php echo site_url("home/login")?>"><span>Sign In</span></a></h1>
 
        <div class="login_container">
            <?php
                echo "<ul>".validation_errors('<li class="Frm_Error_Msg">', '</li>')."</ul>";
                //Show Flash Message
				if($msg = $this->session->flashdata('flash_message'))
                {
					echo "<div>".$msg."</div><br>";
                }
                
                $form_attributes = array('name' => 'sign_up', 'id' => 'sign_up');
                
                if(isset($facebook_connect) && $facebook_connect=="yes")
                    echo form_open(base_url().'index.php/f_connect/signup',$form_attributes);
				elseif(isset($twitter_connect) && $twitter_connect=="yes")
					echo form_open(base_url().'t_connect/signup',$form_attributes);
                else
                    echo form_open('',$form_attributes);
                
                $first_name=array("name"=>"first_name","id"=>"first_name","class"=>"forminput required");
                
                $user_mail = array('name'=> 'email','id'=> 'email','class'=>'forminput required email');
                
                $password = array('name'=>'password','id'=> 'password','class'=>'forminput required');
                
                $cpassword = array('name'=>'cpassword','id'=> 'cpassword','class'=>'forminput required');
                
                $submit_button=array('name'=> 'sign_upuser','id'=> 'sign_upuser','value'=> 'Signup','class'=>'Butt_Bg');
                
                if($this->input->post("sign_upuser"))
                {
                    $first_name["value"]=set_value("first_name");
                    
                    $user_mail["value"]=set_value("email");
                    
                    $password["value"]=set_value("password");
                    
                    $cpassword["value"]=set_value("cpassword");
                }
                if(isset($facebook_connect) && $facebook_connect=="yes")
                {	
                    $first_name["value"]=$facebook_name;
                    
                    $user_mail["value"]=$facebook_email_id;
                    
                    echo form_hidden("facebook_user_id",$facebook_user_id);
                    
                    echo form_hidden("face_book_sign_up_form","yes");
                }
				if(isset($twitter_connect) && $twitter_connect=="yes")
                {	
                     $first_name["value"]=$twitter_name;
                    
                    echo form_hidden("twitter_user_id",$twitter_user_id);
                    
                    echo form_hidden("twitter_sign_up_form","yes");
                }
                
                echo "<div><h4>".form_label("Full Name","username_label")."&nbsp;<span class='required_fields'>*</span></h4><br><span class='Input_Bg_log'>".form_input($first_name)."</span></div><br>";
                
                echo "<div><h4>".form_label("Email","username_label")."&nbsp;<span class='required_fields'>*</span></h4><br><span class='Input_Bg_log'>".form_input($user_mail)."</span></div><br>";
                
                echo "<div><h4>".form_label("Password","password_label")."&nbsp;<span class='required_fields'>*</span></h4><br><span class='Input_Bg_log'>".form_password($password)."</span></div><br>";
                
                 echo "<div><h4>".form_label("Confirm","Confirm_label")."&nbsp;<span class='required_fields'>*</span></h4><br><span class='Input_Bg_log'>".form_password($cpassword)."</span></div><br>";
				 
				 echo '<div><label><input type="checkbox" name="agree" id="agree" class="required">&nbsp;<a href="'.site_url("page/trems-of-service").'">I accept Terms of Service</a></label></div><br>';
                
                echo form_hidden("form_name","user_login");
                
                echo "<br><p>".form_submit($submit_button)."&nbsp; &nbsp;<a href='".base_url()."home/login"."' class='fancyboxForm'>Already a member ?</a></p><br>";
                 
                echo form_close();
            ?>
        </div>

</div>
	 <div class="clsLog_Or_Blk clsFloatLeft" style="width:160px; text-align:center; margin:110px 0 0 0;">
        	<h1>OR</h1>
        </div>
	<div class="login_ad_container clsFloatLeft">
	
  
   		 <?php
         	if(isset($facebook_loginUrl))
				echo '<a href="'.$facebook_loginUrl.'"><img src="'.base_url().'images/face_butt.png" alt="image" /></a>';
		?>
  
</div>
     </div>

<?php
$this->load->view("right_side_bar");
?>    
<?php
	$this->load->view("footer");
?>
