<?php
	$this->load->view("header");
	$time_zone=$this->config->item("site_time_zone");
?>
<script type="text/javascript">
$(document).ready(function(){
	
}) 
</script>
<style type="text/css">
.clsLoging_Form
{
	margin-left:20px;
}
.answer
{
	line-height:22px;
}
</style>
<div class="clsFloatLeft" id="Main_left">
	<div class="inner_pages">
    	<h1 class="Main_Tittle"><span><?php echo $title?></span></h1>
         <div class="clsInput_Bg1">
            <div class="inner_content">
            	<?php
					if($msg = $this->session->flashdata('flash_message'))
					{
						echo "<div>".$msg."</div>";
					}
			
				if(isset($faq_lists) && count($faq_lists))
				{
            		foreach($faq_lists as $faq_list)
					{
						echo '<div id="faq_list_'.$faq_list->id.'"><h4>'.$faq_list->question.'</h4><br>';
						
						echo '<div id="faq_list_ans_'.$faq_list->id.'" class="answer">'.$faq_list->faq_content.'</div></div>';
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
