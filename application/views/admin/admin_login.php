<?php 
$this->load->view("admin/header");	
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#username").alphanumeric({allow:"-,_,.,:,/,@"});
		$("#password").alphanumeric({allow:"-,_,."});
		$("#admio_login").validate();
	})
</script>
	<div id="loginbox" class="box">
        <div id="loginbox-top">
            <h4>Login</h4>
            <div class="clear"></div>
        </div>
         
        <div id="loginbox-body">
        <?php
			//Show Flash Message
			if($msg = $this->session->flashdata('flash_message'))
			{
				echo "<div>".$msg."</div>";
			}
	  	?>
		<?php
			$form_attributes = array('name' => 'admio_login', 'id' => 'admio_login');
			
            echo form_open('',$form_attributes);
			 
			 $data = array(
			  'name'        => 'username',
			  'id'          => 'username',
			  'class'=>'forminput required'
			);
			$password = array(
			  'name'        => 'password',
			  'id'          => 'password',
			  'class'=>'forminput required'
			);
			$submit_button=array(
				'name'        => 'loginAdmin',
			  	'id'          => 'submit',
				'value'       => 'Login',
			  	'class'=>'formbutton'
				);
			
			 echo "<div><h4>".form_label("Username","username_label")."</h4>".form_input($data)."</div><br>";
			 
			 echo "<div><h4>".form_label("Password","password_label")."</h4>".form_password($password)."</div>";
			 
			 echo "<div style='float:left'><br>".form_submit($submit_button)."</div><div style='float:right; margin:25px 0 0 0px;text-align:right'><a href='".admin_url("admin/forget_pwd")."'>Forgot password ?</a></div><div class=\"clear\"></div><br>";
			 
             echo form_close();
        ?>
        </div>
   </div>
   <br>
<?php
$this->load->view("admin/footer");
?>