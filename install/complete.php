<?php
	session_start();
	
	if($_SESSION['baseurl'] == '')
		$url	= '../../';
	else
		$url	= $_SESSION['baseurl']; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/common.css" rel="stylesheet" type="text/css" /> 
<link href="css/style.css" rel="stylesheet" type="text/css" /> 
<title>RBS Step-4</title>
</head>

<body>
<div id="header">
  <!--RC for Logo-->
  <!--RC-->
  <div id="header_inner">
    <div class="clsclearfix">
      <div id="selLeftHeader">
        <h1><a href="http://products.cogzidel.com/groupon-clone/">groupon</a></h1>
        <p><a href="#">Best Groupon Software</a></p>
      </div>
      <div id="selRightHeader">
        <ul>
          <li><a href="http://products.cogzidel.com/groupon-clone/" target="_blank"><span>SEPT</span></a></li>
          <li><a href="http://cogzidel.com" target="_blank"><span>Cogzidel</span></a></li>
          <li class="clsNoBg"><a href="http://cogzideltemplates.com" target="_blank"><span>Cogzidel Templates</span></a></li>
        </ul>
      </div>
    </div>
  </div>
  <!--RC-->
</div>
<div id="container">
    <!--end of RC-->
	<!--Rc -->
	                <div id="banner">
	                        <!--RC-->
						<div id="selBanner">
                        							<h2>SEPT Installation Steps</h2>
												<img src="images/step4.png" alt="Step-1" />
							</div>
                        <!--RC-->
                 
                    </div>	
		<!--End Rc -->
	 <!--RC-->
	               <div id="main">
     <div class="clsSin_Top">
        	<div class="clsSin_Bttm">
            	<div class="clsSin_Mid">
	    
                        <!--RC-->
                        <div id="selMain">
                        <h2>Installation is Completed</h2>
                        <div class="clsMain_Content">
                        
						<p class="clsHead">Installation is Completed Succesfully.</p>
						<p>
						<!--Installation Complete, will be redirected to the home page. If not <a href="<?php echo $url; ?>">click here</a>.-->
	Congratulations!! You have successfully installed RBS script on your server!<br /><br />
	 
	Please choose appropriate  action:<br>
	<br>Good Luck!<br />
	<p class="clsAlign"><input type="button" name="home" value="Site Home" class="clsbtn" onClick="window.location='<?php echo $url; ?>'">&nbsp;&nbsp;&nbsp;<input class="clsbtn" type="button" name="home" value="Site Admin" onClick="window.location='<?php echo $url; ?>index.php/siteadmin'"></p>
	
						</p>
						</div>
						
						
						</div>
                        <!--RC-->
                     
                    
                    </div></div></div></div>
    <!--end of RC-->
	
	<div id="footer">
	<p>Copyright &copy; 2008 - <?php echo date("Y");?> SEPT 0.1 (Copyright Policy, Trademark Policy) </p>
	</div>
	
</div>

</body>
</html>
