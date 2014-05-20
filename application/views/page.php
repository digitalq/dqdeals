<?php
	$this->load->view("header");
	$time_zone=$this->config->item("site_time_zone");
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
    	<h1 class="Main_Tittle"><span>
				<?php
					if(isset($page_content) and $page_content->num_rows()>0) 
					{ 
					 $pages = $page_content->row();
					?>
    		         <?php echo $pages->page_title; ?>
					 <?php 
	            	  }
				?>
                </span></h1>
         <div class="clsInput_Bg1">
            <div class="inner_content">
            	<?php
					if($msg = $this->session->flashdata('flash_message'))
					{
						echo "<div>".$msg."</div>";
					}
            	?>
            </div>
        </div>
        <!-- End of Main Top -->
        <!-- Main Body -->
        <div id="selMain_Cont">
        <br />
        <div>
						      
          <!-- page content -->
            <?php //pr($page_content->result());
            if(isset($page_content) and $page_content->num_rows()>0)
            { 
                foreach($page_content->result() as $page)
                {
                
                    echo $page->content;
                }
            }
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