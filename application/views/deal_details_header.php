<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php if(isset($deal_seo_keyword)) echo $deal_seo_keyword." "; echo $this->config->item('meta_tags')?>" />
<meta name="title" content="<?php if(isset($deal_seo_title)) echo $deal_seo_title." "; echo $this->config->item('site_title')?>" />
<meta name="description" content="<?php if(isset($deal_seo_description)) echo $deal_seo_description." "; echo $this->config->item('meta_tags_description')?>" />
<title>
<?php
	if(isset($deal_seo_title)) echo $deal_seo_title." | ";
	
	if($this->config->item('site_title')!="")
		echo $this->config->item('site_title');
	else
		echo "SEPT";
	
?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/common.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.countdown.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/alphanumeric/jquery.alphanumeric.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/common.js"></script>
<script type="text/javascript">
	var site_admin_url='<?php echo admin_url()?>';
	var base_url='<?php echo base_url()?>';
</script>
<script type="text/javascript">
$(document).ready(function(){
	<?php
	if(isset($selected_city))
		echo '$("#city_name").val(\''.$selected_slug.'\');';
	?>
	$("#city_name").change(function(){
		var city_val=$("#city_name").val();
		
		document.location=base_url+"deals/"+city_val;
	})
})
</script>
</head>
<body>
<div id="Container">
	<div id="Header" class="clearfix">
    	<div id="Header_Left" class="clsFloatLeft">
        	<div id="Logo">
            	<p>
                	<a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>css/logo/<?php echo $this->config->item('site_logo')?>" alt="Sept" /></a>
                 </p>
            </div>
            <div id="selSlogan">
            	<p><a href="<?php echo base_url()?>"><?php echo $this->config->item('site_slogan')?></a></p>
            </div>
        </div>
        <div id="Header_Right" class="clsFloatRight">
        	<?php
				$email_sub_con='on';
				
				if(isset($email_sub_container) && $email_sub_container=='no')
					$email_sub_con='off';
				else
					$email_sub_con='on';
					
				//var_dump($email_sub_con);
				
				if($email_sub_con=='on')
				{
				if(!isLoggedIn())
				{
			?>
					<p class="clsHead_left_Titt">Get daily deals alerts:</p>
					<?php
							$sign_up_option=array("name"=>"mail_subscription","id"=>"mail_subscription","method"=>"post");
							echo form_open('',$sign_up_option);
					?>
					<p class="clearfix" id="Input_Blk">
						<span class="Input_Bg1">
							<input type="text" value="Enter your Email Address" name="email" id="email" />
						</span>
						<span class="Input_Bg2">
							<select name="city_name" id="city_name">
								<option>Select City</option>
								<?php echo $city_drop_down?>
							</select>
						</span>
					</p>
					<div style="clear:both"></div>
					<div id="selHead_Butts" class="clearfix">
							<div class="HeadSubmit"><input type="submit" class="Butt_Bg" value="SUBMIT" /></div>
							<div class="HeadSign_in"><a class="clsLinks_Bg" href="<?php echo base_url()?>login"><span>Sign In</span></a></div>
							<div class="HeadSign_up"><a class="clsLinks_Bg" href="<?php echo base_url()?>signup"><span>Sign Up</span></a></div>
					</div>
					 <div style="clear:both"></div>
			<?php echo form_close();
				}
				else
				{?>
                	<p class="clsHead_left_Titt">Welcome <?php if(get_users_detail("first_name")!="") echo get_users_detail("first_name"); else echo  get_users_detail("user_name");?></p>
                	<p class="clearfix" id="Input_Blk">
                    	<span class="Input_Bg2">
							<select name="city_name" id="city_name">
								<option>Select City</option>
								<?php echo $city_drop_down?>
							</select>
                         </span>   
                    </p>
                    <div style="clear:both"></div>
                   <div id="selHead_Butts" class="clearfix">
                    	<div class="HeadSign_in"><a class="clsLinks_Bg" href="<?php echo base_url()?>logout"><span>Logout</span></a></div>
                        <div class="HeadSign_in"><a class="clsLinks_Bg" href="<?php echo base_url()?>my_account"><span>Account</span></a></div>
                    </div>
			<?php
            }	
			$facebook_url=get_single_row("social_site_settings",array("name"=>"facebook_url"));
			$face_book_link='';
			if(count($facebook_url)!=0)
				$face_book_link=$facebook_url[0]->value;
			else
				$face_book_link='#';
				
			$twiter_url=get_single_row("social_site_settings",array("name"=>"twiter_page_url"));
			
			$twitter_link='';
			
			if(count($twiter_url)!=0)
				$twitter_link=$twiter_url[0]->value;
			else
				$twitter_link='#';
			?>
            
            <p class="Social_links clsFloatRight clearfix">
            	<span>
                	<a href="<?php echo $face_book_link?>" target="_blank"><img src="<?php echo base_url()?>images/fb.png" alt="FaceBook" /></a>
                 </span>
                <span><a href="<?php echo $twitter_link?>" target="_blank"><img src="<?php echo base_url()?>images/twitt.png" alt="Twitter" /></a></span>
                <?php /*?><span><a href="#"><img src="<?php echo base_url()?>images/rss.png" alt="rss" /></a></span><?php */?>
            </p>
            <?php }?>
           <div style="clear:both"></div>
        </div>
    </div>
    <div id="Main_Blk">
    	<div class="clsSin_Top">
        	<div class="clsSin_Bttm">
            	<div class="clsSin_Mid">
