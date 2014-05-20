 </div>
 </div>
            </div>
        </div>
    </div>
    <div id="Footer">
    	<p><a href="#">Recent Plans</a>|<a href="#">How it works</a>|<a href="<?php echo base_url()."home/faq"?>">FAQ</a>|<a href="#">Promote your business</a>|<a href="#">Press</a></p>
        <p><a href="#">Contact</a>|<a href="#">Terms of Use</a>|<a href="#">Privacy Policy</a></p>
    </div>
</div>
<?php
	if($this->config->item("google_analytics")!="" )
		echo $this->config->item("google_analytics");
?>
</body>
</html>