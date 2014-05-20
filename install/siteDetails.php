<?php
	session_start();
	
	include "db.php";
	
	if(	isset($_POST['submit']) && $_POST['submit'] == 'Submit' && trim($_POST['site_title']) != '' && trim($_POST['site_admin_mail']) != '' &&	trim($_POST['admin_password']) != ''&& $_POST["facebook_api_key"]!="" && $_POST["facebook_secret_key"]!="" && $_POST["facebook_fan_page"]!=""){
	
  osc_db_connect($_SESSION['mysql_host'], $_SESSION['mysql_uname'], $_SESSION['mysql_password']);
  osc_db_select_db($_SESSION['mysql_db']);

osc_db_query("CREATE TABLE IF NOT EXISTS `payment_log` (
  `id` int(11) NOT NULL auto_increment,
  `deal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `retrun_array` text NOT NULL,
  `date_of_insert` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
  osc_db_query('update settings set string_value = "' . trim($_POST['site_title']) . '",created = "'.time().'" where code = "SITE_TITLE"');
  osc_db_query('update settings set string_value = "' . trim($_POST['site_admin_mail']) . '",created = "'.time().'" where code = "SITE_ADMIN_MAIL"');
  osc_db_query('update settings set string_value = "' . trim($_SESSION['baseurl']) . '",created = "'.time().'" where code = "BASE_URL"');
  osc_db_query("INSERT INTO `users` (`user_name`, `email`, `password`, `level`, `first_name`, `date_insert`, `last_login`) VALUES
('".trim($_POST['admin_name'])."', '".trim($_POST['site_admin_mail'])."', '".trim(md5($_POST['admin_password']))."', 1, '".trim($_POST['admin_name'])."',CURDATE(), CURDATE())");
  
  osc_db_query('update social_site_settings set value = "' . trim($_POST['facebook_fan_page']) . '" where name = "facebook_url"');
  osc_db_query('update social_site_settings set value = "' . trim($_POST['facebook_fan_page']) . '" where name = "fanbox_href"');
  osc_db_query('update social_site_settings set value = "' . trim($_POST['facebook_api_key']) . '" where name = "facebook_api_key"');
  osc_db_query('update social_site_settings set value = "' . trim($_POST['facebook_secret_key']) . '" where name = "facebook_secret_key"');
  
  osc_db_query('insert into admins set admin_name = "' . trim($_POST['admin_name']) . '", password = "' . trim(md5($_POST['admin_password'])) . '"');
  
  header('Location: complete.php');
  }
  elseif(isset($_POST['submit']) && $_POST['submit'] == 'Submit')
	{
		$site_title	= trim($_POST['site_title']);
		
		$site_admin_mail	= trim($_POST['site_admin_mail']);
		
		$admin_name	= trim($_POST['admin_name']);
		
		$admin_password	= trim($_POST['admin_password']);
		
		$facebook_fan_page=$_POST['facebook_fan_page'];
		
		$facebook_api_key=$_POST['facebook_api_key'];
		
		$facebook_secret_key=$_POST['facebook_secret_key'];
		
		$error = 'All the fields are required';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/common.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<title>SEPT 0.1 Step-3</title>
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
      <img src="images/step3.png" alt="Step-1" /> </div>
    <!--RC-->
  </div>
  <!--End Rc -->
  <!--RC-->
  <div id="main">
    <div class="clsSin_Top">
      <div class="clsSin_Bttm">
        <div class="clsSin_Mid">
          <!--RC-->
          <form name="settings" method="post" action="">
            <div id="selMain" class="clsclearfix">
              <h2>Site Settings</h2>
              <div class="clsContant">
                <div class="clsForm">
                  <?php
	if(isset($error))
	echo '<div id="error" class="error">' . $error . '</div><BR>';
	?>
                  <br>
                  <br>
                  <div>
                  	<table width="50%" cellpadding="5" cellspacing="0" border="0" style="float:left">
                    <tr>
                      <td width="25%"><span>Site Title:</span></td>
                    </tr>
                    <tr>
                      <td><p>
                          <input type="text" name="site_title" size="35" value="<?php if(	isset($site_title)) echo $site_title; ?>" />
                          &nbsp;<font>*</font></p></td>
                    </tr>
                    <tr>
                      <td width="25%"><span>Site Admin Email:</span></td>
                    </tr>
                    <tr>
                      <td><p>
                          <input type="text" name="site_admin_mail" size="35" value="<?php if(	isset($site_admin_mail)) echo $site_admin_mail; ?>" />
                          &nbsp;<font>*</font></p></td>
                    </tr>
                    <tr>
                      <td width="25%"><span>Admin Username:</span></td>
                    </tr>
                    <tr>
                      <td><p>
                          <input type="text" name="admin_name" size="35" value="<?php if(	isset($admin_name)) echo $admin_name; ?>" />
                          &nbsp;<font>*</font></p></td>
                    </tr>
                    <tr>
                      <td width="25%"><span>Admin Password:</span></td>
                    </tr>
                    <tr>
                      <td><p>
                          <input type="text" name="admin_password" size="35" value="<?php if(	isset($admin_password)) echo $admin_password; ?>" />
                          &nbsp;<font>*</font></p></td>
                    </tr>
                    <tr>
                      <td width="25%"><span>Facebook API Key:</span></td>
                    </tr>
                    <tr>
                      <td><p>
                          <input type="text" name="facebook_api_key" size="35" value="<?php if(	isset($facebook_api_key)) echo $facebook_api_key; ?>" />
                          &nbsp;<font>*</font></p></td>
                    </tr>
                    <tr>
                      <td width="25%"><span>Facebook API Secret Key:</span></td>
                    </tr>
                    <tr>
                      <td><p>
                          <input type="text" name="facebook_secret_key" size="35" value="<?php if(	isset($facebook_secret_key)) echo $facebook_secret_key; ?>" />
                          &nbsp;<font>*</font></p></td>
                    </tr>
                    <tr>
                      <td width="25%"><span>Facebook Fanpage:</span></td>
                    </tr>
                    <tr>
                      <td><p>
                          <input type="text" name="facebook_fan_page" size="35" value="<?php if(	isset($facebook_fan_page)) echo $facebook_fan_page; ?>" />
                          &nbsp;<font>*</font></p></td>
                    </tr>
                  </table>
                  <div style="clear:both"></div>
                  </div>
                  <br>
                  <br>
                  <table width="50%" cellpadding="5" cellspacing="0" border="0">
                    <tr>
                      <td width="25%"><p><font>* required</font></p></td>
                      <td>&nbsp;&nbsp;</td>
                    </tr>
                  </table>
                </div>
              </div>
              <p class="clsAlign">
                <input type="submit" name="submit" class="clsbtn" value="Submit" />
              </p>
            </div>
          </form>
        </div>
        <!--RC-->
      </div>
    </div>
  </div>
</div>
<!--end of RC-->
<div id="footer">
  <p>Copyright &copy; 2008 - <?php echo date("Y");?> SEPT 0.1 (Copyright Policy, Trademark Policy) </p>
</div>
</body>
</html>
