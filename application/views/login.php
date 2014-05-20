<?php
	$this->load->view("header");
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#user_login").validate({errorElement:"p",errorClass:"Frm_Error_Msg",focusInvalid: false})
}) 
</script>
<div class="clsFloatLeft clsLog_Blk" id="Main_left">
    <div class="clsLoging_Form clsFloatLeft">
    <h1 class="Main_Tittle"><span><?php echo $title?> or </span><a href="<?php echo site_url("home/signup")?>"><span>Sign Up</span></a></h1>
     <div class="clsInput_Bg1">
        <div class="login_container">
        	<span>Sign In with your <?php echo $this->config->item("google_ad_sense")?> Account.</span><br /><br />
            <?php
                //Show Flash Message
                if($msg = $this->session->flashdata('flash_message'))
                {
                    echo "<div>".$msg."</div><br>";
                }
            
                $form_attributes = array('name' => 'user_login', 'id' => 'user_login');
                
                echo form_open('',$form_attributes);
                
                $user_mail = array('name'=> 'email','id'=> 'email','class'=>'forminput required email');
                
                $password = array('name'=>'password','id'=> 'password','class'=>'forminput required');
                
                $submit_button=array('name'=> 'loginuser','id'=> 'submit','value'=> 'Sign In','class'=>'Butt_Bg');
                
                echo "<div><h4>".form_label("Email","username_label")."&nbsp;<span class='required_fields'>*</span></h4><br><span class='Input_Bg_log'>".form_input($user_mail)."</span></div><br>";
                
                echo "<div><h4>".form_label("Password","password_label")."&nbsp;<span class='required_fields'>*</span></h4><br><span class='Input_Bg_log'>".form_password($password)."</span><br><a href='".base_url()."home/forget_pwd"."' class='fancyboxForm'>Forgot your password ?</a></div><br>";
                
                echo form_hidden("form_name","user_login");
                
                echo "<br><p>".form_submit($submit_button)."&nbsp;&nbsp;<a href='".site_url("home/signup")."' class='fancyboxForm'>Not a member yet ?</a></p><br>";
                 
                echo form_close();
            ?>
        </div>
        </div>
        </div>
        <div class="clsLog_Or_Blk clsFloatLeft" style="width:160px; text-align:center; margin:110px 0 0 0;">
        	<h1>OR</h1>
        </div>
    <div class="login_ad_container clsFloatLeft">
  
   		<?php
			//var_dump($facebook_loginUrl);
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
