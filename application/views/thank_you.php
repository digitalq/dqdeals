<?php
	$this->load->view("header");
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#change_password_form").validate({errorElement:"p",errorClass:"Frm_Error_Msg",focusInvalid: false})
}) 
</script>
<style type="text/css">
.clsLoging_Form
{
	margin-left:20px;
}
</style>
<div class="clsFloatLeft" id="Main_left">
	<div class="inner_pages">
    	<h1 class="Main_Tittle"><span><?php echo $title?></span></h1>
         <div class="clsInput_Bg1">
            <div class="inner_content">
            	<?php
					echo $message;
				?>
            </div>
        </div>
   </div>
</div>
<?php
$this->load->view("right_side_bar");
?>    
<?php
	$this->load->view("footer");
?>
