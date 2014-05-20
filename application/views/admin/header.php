<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo base_url()?>css/admin_common.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url()?>css/tipsy.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url()?>js/jquery-ui-1.css" type="text/css" rel="stylesheet"/>
   
    <script type="text/javascript">
		var site_admin_url='<?php echo admin_url()?>';
		var base_url='<?php echo base_url()?>';
	</script>
    <script type="text/javascript" src="<?php echo base_url()?>js/jquery-1.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url()?>js/jquery.tipsy.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url()?>js/common.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-1.js"></script>
    
	<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-timepicker-addon.js"></script>

	<?php /*?><script type="text/javascript" src="<?php echo base_url()?>js/jquery.easing.1.3.js"></script>
	
    <script type="text/javascript" src="<?php echo base_url()?>js/common.js"></script><?php */?>
    
    <script type="text/javascript" src="<?php echo base_url()?>js/alphanumeric/jquery.alphanumeric.pack.js"></script>
    <?php
	/*if($this->config->item('site_logo')!="")
	{
		$logo_image_size=getimagesize(base_url().'css/logo/'.$this->config->item('site_logo'));
		
		$logo_width=$logo_image_size[0].'px';
		
		$logo_height=$logo_image_size[1].'px';
		
		
		echo '<style type="text/css"> 
				#header > #logo > a {
									background: url("'.base_url().'css/logo/'.$this->config->item('site_logo').'") no-repeat scroll center top transparent;
									height:'.$logo_height.';
									width:'.$logo_width.';
									margin-top: 35px;
								   }
			  </style>';
	}*/
	?>
<title>
<?php
	if($this->config->item('site_title')!="")
		echo $this->config->item('site_title');
	else
		echo "Shop Deal";
?>
</title>

</head>
<body>
<div id="wrapper">
	<div class="wrap">
    	
        <div class="clearfix" id="header">
            <div id="Logo"><a href="<?php echo base_url();?>"><img src="<?php echo base_url()?>css/logo/<?php echo $this->config->item('site_logo')?>" alt="Logo" /></a>
            <div class="Slogan">
            	<p><a href="<?php echo base_url()?>"><?php echo $this->config->item('site_slogan')?></a></p>
            </div></div>
            <div class="login">
              <a href="<?php echo admin_url('home')?>">Admin Home</a>
              <a href="<?php echo base_url()?>">Site Home</a>
              <?php
			  	if(isAdmin())
				{?>
					<a href="<?php echo admin_url('home/logout');?>">Logout</a>
                 <?php 
				 }
				 
			  ?> <div id="show_date_time"></div>   
            </div>  
            <div class="clear"></div>
        </div>
<div class="clear"></div> 