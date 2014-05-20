<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo $this->config->item('meta_tags')?>" />
<meta name="title" content="<?php echo $this->config->item('site_title')?>" />
<meta name="description" content="<?php echo $this->config->item('meta_tags_description')?>" />
<title>
<?php
	if($this->config->item('site_title')!="")
		echo $this->config->item('site_title');
	else
		echo "Cogzidel Sept";
?>
</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/splash.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/alphanumeric/jquery.alphanumeric.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/common.js"></script>
</head>
<body>
<div id="Container">
	<div id="Header">
    	<div id="Logo">
        	<p>
            	<?php /*?><a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>images/logo.png" alt="Logo" /></a> */?>
                <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>css/logo/<?php echo $this->config->item('site_logo')?>" alt="Radical_Deals" /></a>
            </p>
            <p class="Slogan"><a href="<?php echo base_url()?>"><?php echo $this->config->item('site_slogan')?></a></p>
        </div>
        <div class="clear"></div>
    </div>