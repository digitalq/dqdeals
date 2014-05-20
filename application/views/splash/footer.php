<div id="Footer">
    	<p><a href="#">Terms and Conditions</a>|<a href="#">Privacy Policy</a>|<a href="<?php echo base_url()."home/faq"?>">How it Works</a></p>
    </div>
</div>
<?php
	if($this->config->item("google_analytics")!="" )
		echo $this->config->item("google_analytics");
?>
</body>
</html>